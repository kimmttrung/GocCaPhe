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

    // lọc theo trạng thái order
    $status = $_GET['status'] ?? 'PENDING';
    if (!in_array($status, ['PENDING', 'PAID', 'APPROVED', 'CANCELLED'])) {
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

            o.status AS order_status
        FROM order_items oi
        JOIN orders o ON o.id = oi.order_id
        JOIN products p ON p.id = oi.product_id
        WHERE o.user_id = ?
          AND o.status = ?
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
        JOIN orders o ON o.id = oi.order_id
        JOIN products p ON p.id = oi.product_id
        WHERE oi.id IN (" . implode(',', $ids) . ")
          AND o.status = 'PENDING'
    ");
    $stmt->execute();
    $items = $stmt->fetchAll();

    require __DIR__ . '/../views/user/checkout.php';
}


public function delete()
{
    $id = $_POST['id'] ?? 0;
    $userId = $_SESSION['user']['id'];

    if (!$id) {
        echo json_encode(['success'=>false]);
        exit;
    }

    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        DELETE oi
        FROM order_items oi
        JOIN orders o ON o.id = oi.order_id
        WHERE oi.id = ?
          AND o.user_id = ?
          AND o.status = 'PENDING'
    ");

    $stmt->execute([$id, $userId]);

    echo json_encode([
    'success' => $stmt->rowCount() > 0
]);
    exit;
}




public function payment()
{
    $userId = $_SESSION['user']['id'];
    $items = array_map('intval', explode(',', $_POST['items'] ?? ''));

    if (empty($items)) {
        header('Location: ?url=cart');
        exit;
    }
    
    $pdo = Database::connect();
    $pdo->beginTransaction();

    try {
        // 1️⃣ tạo order PAID
        $stmt = $pdo->prepare("
            INSERT INTO orders (user_id, status, total_price)
            VALUES (?, 'PAID', 0)
        ");
        $stmt->execute([$userId]);
        $newOrderId = $pdo->lastInsertId();

        // 2️⃣ chuyển item sang order mới
        $stmt = $pdo->prepare("
            UPDATE order_items
            SET order_id = ?
            WHERE id IN (" . implode(',', $items) . ")
        ");
        $stmt->execute([$newOrderId]);

        // 3️⃣ tính tổng tiền
        $stmt = $pdo->prepare("
            SELECT SUM(quantity * price)
            FROM order_items
            WHERE order_id = ?
        ");
        $stmt->execute([$newOrderId]);
        $totalPrice = $stmt->fetchColumn() ?? 0;

        // 4️⃣ update total_price
        $stmt = $pdo->prepare("
            UPDATE orders
            SET total_price = ?
            WHERE id = ?
        ");
        $stmt->execute([$totalPrice, $newOrderId]);

        $pdo->commit();

        require __DIR__ . '/../views/user/payment_success.php';

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Lỗi thanh toán";
    }
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
            WHERE oi.id=? AND o.status='PENDING' AND o.user_id=?
        ");
    } else {
        $stmt = $pdo->prepare("
            UPDATE order_items oi
            JOIN orders o ON o.id = oi.order_id
            SET oi.quantity = GREATEST(1, oi.quantity - 1)
            WHERE oi.id=? AND o.status='PENDING' AND o.user_id=?
        ");
    }

    $stmt->execute([$id, $userId]);

    $stmt = $pdo->prepare("SELECT quantity FROM order_items WHERE id=?");
    $stmt->execute([$id]);
    $qty = $stmt->fetchColumn();

    echo json_encode(['success'=>true, 'quantity'=>$qty]);
    exit;
}


}


