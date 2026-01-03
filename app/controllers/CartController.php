<?php
class CartController
{
    public static function getCartCount($userId)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            SELECT SUM(oi.quantity)
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            WHERE o.user_id = ? AND o.status = 'PENDING'
        ");
        $stmt->execute([$userId]);

        return $stmt->fetchColumn() ?? 0;
    }

    public function add() {
        $pdo = Database::connect();
        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'];

        // tìm order PENDING
        $stmt = $pdo->prepare("SELECT id FROM orders WHERE user_id=? AND status='PENDING' LIMIT 1");
        $stmt->execute([$userId]);
        $order = $stmt->fetch();

        $orderId = $order ? $order['id'] : null;
        if (!$orderId) {
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, 0)");
            $stmt->execute([$userId]);
            $orderId = $pdo->lastInsertId();
        }

        // kiểm tra sản phẩm
        $stmt = $pdo->prepare("SELECT id, quantity FROM order_items WHERE order_id=? AND product_id=?");
        $stmt->execute([$orderId, $productId]);
        $item = $stmt->fetch();

        if($item){
            $stmt = $pdo->prepare("UPDATE order_items SET quantity = quantity + 1 WHERE id=?");
            $stmt->execute([$item['id']]);
        } else {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE id=?");
            $stmt->execute([$productId]);
            $price = $stmt->fetchColumn();

            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, 1, ?)");
            $stmt->execute([$orderId, $productId, $price]);
        }

        // trả số lượng giỏ hàng
        $stmt = $pdo->prepare("SELECT SUM(oi.quantity) FROM orders o JOIN order_items oi ON o.id=oi.order_id WHERE o.user_id=? AND o.status='PENDING'");
        $stmt->execute([$userId]);
        $cartCount = $stmt->fetchColumn() ?? 0;

        header('Content-Type: application/json');
        echo json_encode(['success'=>true, 'cartCount'=>$cartCount]);
        exit;
    }


public function index()
{
    $pdo = Database::connect();
    $userId = $_SESSION['user']['id'];

    // mặc định PENDING
    $status = $_GET['status'] ?? 'PENDING';
    if (!in_array($status, ['PENDING', 'PAID'])) {
        $status = 'PENDING';
    }

    $stmt = $pdo->prepare("
        SELECT 
            oi.id AS order_item_id,
            p.id AS product_id,
            p.name,
            p.image,
            oi.quantity,
            oi.price,
            oi.status
        FROM order_items oi
        JOIN orders o ON o.id = oi.order_id
        JOIN products p ON p.id = oi.product_id
        WHERE o.user_id = ?
          AND oi.status = ?
        ORDER BY oi.id DESC
    ");
    $stmt->execute([$userId, $status]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once __DIR__ . '/../views/user/cart.php';
}



    // Trang nhập địa chỉ + chọn phương thức thanh toán
  public function checkout()
{
    $ids = $_GET['items'] ?? '';
    if (!$ids) {
        header('Location: ?url=cart');
        exit;
    }

    $ids = array_map('intval', explode(',', $ids));

    $pdo = Database::connect();
    $stmt = $pdo->prepare("
        SELECT 
            oi.id,
            p.name,
            oi.quantity,
            oi.price
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        WHERE oi.id IN (" . implode(',', $ids) . ")
          AND oi.status='PENDING'
    ");
    $stmt->execute();
    $items = $stmt->fetchAll();

    require __DIR__ . '/../views/user/checkout.php';
}


public function delete()
{
    $ids = $_POST['id'] ?? '';
    $userId = $_SESSION['user']['id'];

    if (!$ids) {
        echo json_encode(['success'=>false]);
        exit;
    }

    $ids = array_map('intval', explode(',', $ids));
    $in = implode(',', array_fill(0, count($ids), '?'));

    $pdo = Database::connect();
    $stmt = $pdo->prepare("
        DELETE oi FROM order_items oi
        JOIN orders o ON o.id = oi.order_id
        WHERE oi.id IN ($in)
          AND oi.status='PENDING'
          AND o.user_id=?
    ");
    $stmt->execute([...$ids, $userId]);

    echo json_encode(['success'=>true]);
    exit;
}

public function payment()
{
    $userId = $_SESSION['user']['id'];
    $items = array_map('intval', explode(',', $_POST['items'] ?? ''));

    if (!$items) {
        header('Location: ?url=cart');
        exit;
    }

    $pdo = Database::connect();
    $pdo->beginTransaction();

    // 1️⃣ tạo order mới
    $stmt = $pdo->prepare("
        INSERT INTO orders (user_id, status)
        VALUES (?, 'PAID')
    ");
    $stmt->execute([$userId]);
    $newOrderId = $pdo->lastInsertId();

    // 2️⃣ copy item sang order mới
    $stmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price, status)
        SELECT ?, product_id, quantity, price, 'PAID'
        FROM order_items
        WHERE id IN (" . implode(',', $items) . ")
          AND status='PENDING'
    ");
    $stmt->execute([$newOrderId]);

    // 3️⃣ xóa item khỏi cart cũ
    $stmt = $pdo->prepare("
        DELETE FROM order_items
        WHERE id IN (" . implode(',', $items) . ")
          AND status='PENDING'
    ");
    $stmt->execute();

    $pdo->commit();

    require __DIR__ . '/../views/user/payment_success.php';
}

public function count()
{
    if (!isset($_SESSION['user'])) {
        echo json_encode(['count' => 0]);
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $count = self::getCartCount($userId);

    echo json_encode(['count' => $count]);
    exit;
}

public function updateQuantity()
{
    $id = $_POST['id'] ?? 0;
    $type = $_POST['type'] ?? '';
    $userId = $_SESSION['user']['id'];

    if (!$id || !in_array($type, ['inc','dec'])) {
        echo json_encode(['success'=>false]);
        exit;
    }

    $pdo = Database::connect();

    if ($type === 'inc') {
        $stmt = $pdo->prepare("
            UPDATE order_items oi
            JOIN orders o ON o.id = oi.order_id
            SET oi.quantity = oi.quantity + 1
            WHERE oi.id=? AND oi.status='PENDING' AND o.user_id=?
        ");
    } else {
        $stmt = $pdo->prepare("
            UPDATE order_items oi
            JOIN orders o ON o.id = oi.order_id
            SET oi.quantity = GREATEST(1, oi.quantity - 1)
            WHERE oi.id=? AND oi.status='PENDING' AND o.user_id=?
        ");
    }

    $stmt->execute([$id, $userId]);

    // lấy quantity mới
    $stmt = $pdo->prepare("SELECT quantity FROM order_items WHERE id=?");
    $stmt->execute([$id]);
    $qty = $stmt->fetchColumn();

    echo json_encode(['success'=>true, 'quantity'=>$qty]);
    exit;
}

}


