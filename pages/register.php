<?php
session_start();
include "db.php";

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,
        "INSERT INTO users(email,password,role)
         VALUES('$email','$password','user')"
    );

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký - Góc Cafe</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-box">
    <h2>☕ Đăng ký tài khoản</h2>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required placeholder="Nhập email">

        <label>Mật khẩu</label>
        <input type="password" name="password" required placeholder="Nhập mật khẩu">

        <button name="register">Đăng ký</button>
    </form>

    <div class="links">
        <a href="login.php">← Quay lại đăng nhập</a>
    </div>
</div>
</body>
</html>
