<?php
require_once dirname(__DIR__, 2) . '/config/Database.php';


try {
    $db = Database::connect();
    echo "Kết nối database thành công";
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
