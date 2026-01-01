<?php
session_start();

/* Lấy trang hiện tại để quay lại, nếu không có thì về index.php */
$redirect = $_GET['redirect'] ?? 'index.php';

/* Xóa toàn bộ session */
session_unset();
session_destroy();

/* Quay về trang trước đó */
header("Location: $redirect");
exit;
?>
