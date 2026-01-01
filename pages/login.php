<?php
session_start();
include "db.php";

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_GET['redirect'])) {
    $_SESSION['redirect_after_login'] = $_GET['redirect'];
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $rs = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email' AND password='$password'"
    );

    if (mysqli_num_rows($rs) == 1) {
        $u = mysqli_fetch_assoc($rs);
        $_SESSION['user'] = $u['email'];
        $_SESSION['role'] = $u['role'];

        // Redirect về trang trước nếu có
        if (isset($_SESSION['redirect_after_login'])) {
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit();
        }

        // Phân quyền
        if ($u['role'] === 'admin') header("Location: admin.php");
        elseif ($u['role'] === 'staff') header("Location: staff.php");
        else header("Location: index.php");
        exit();
    } else {
        $error = "❌ Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - Góc Cafe</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
<div class="auth-box">
    <h2>☕ Đăng nhập</h2>

    <?php if (!empty($message)) : ?>
        <p style="color: orange; text-align:center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mật khẩu</label>
        <input type="password" name="password" required>

        <button name="login">Đăng nhập</button>
    </form>

    <div class="links">
        <a href="register.php">Đăng ký</a> |
        <a href="forgot.php">Quên mật khẩu?</a>
    </div>
</div>
</body>
</html>
