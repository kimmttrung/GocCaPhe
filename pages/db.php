<?php
$conn = mysqli_connect("localhost", "root", "", "cafe_db");
if (!$conn) {
    die("Lỗi kết nối CSDL");
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

