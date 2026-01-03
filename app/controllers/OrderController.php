<?php

class OrderController
{
    public function index()
    {
        $pdo = Database::connect();

        $stmt = $pdo->query("
            SELECT o.*, u.name AS customer_name
            FROM orders o
            JOIN users u ON o.user_id = u.id
            WHERE o.status IN ('PAID')
            ORDER BY o.created_at DESC
        ");

        $orders = $stmt->fetchAll();

        require __DIR__ . '/../views/admin/orders/index.php';
    }

    public function approve()
    {
        $orderId = $_POST['id']; 
        $staffId = $_SESSION['user']['id'];

        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE orders
            SET status = 'APPROVED',
                approved_by = ?,
                approved_at = NOW() 
            WHERE id = ?
        ");

        $stmt->execute([$staffId, $orderId]);

        header('Location: ?url=admin/orders');
exit;
    }

    public function reject()
    {
        $orderId = $_POST['id']; 
        $reason = $_POST['reject_reason'] ?? '';
        $staffId = $_SESSION['user']['id'];

        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE orders
            SET status = 'CANCELLED',
                approved_by = ?,
                approved_at = NOW(),
                reject_reason = ?
            WHERE id = ?
        ");

        $stmt->execute([$staffId, $reason, $orderId]);

        header('Location: ?url=admin/orders');
exit;
    }
}
