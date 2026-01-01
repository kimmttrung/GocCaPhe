<?php
session_start();
include "db.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
$msg = "";
if (isset($_POST['send'])) {
    $email = $_POST['email'];
    $token = md5(rand());
    $expire = date("Y-m-d H:i:s", strtotime("+15 minutes"));
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) == 0) {
        $msg = "Email không tồn tại!";
    } else {
        mysqli_query($conn,
            "UPDATE users SET reset_token='$token',
             token_expire='$expire' WHERE email='$email'"
        );
        $link = "http://localhost/cafe/reset.php?token=$token";
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "yourgmail@gmail.com";
        $mail->Password = "APP_PASSWORD";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("yourgmail@gmail.com","Góc Cafe");
        $mail->addAddress($email);
        $mail->Subject = "Đặt lại mật khẩu - Góc Cafe";
        $mail->Body = "Xin chào,\n\nClick vào link sau để đặt lại mật khẩu:\n$link\n\nLink có hiệu lực 15 phút.";

        $mail->send();

        $msg = "Đã gửi link đặt lại mật khẩu vào email!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu - Góc Cafe</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
<div class="auth-box">
    <h2>☕ Quên mật khẩu</h2>

    <?php if ($msg): ?>
        <p style="color:#6f4e37; text-align:center; font-weight:bold">
            <?= $msg ?>
        </p>
    <?php endif; ?>

    <form method="post">
        <label>Email đã đăng ký</label>
        <input type="email" name="email" required placeholder="Nhập email">

        <button name="send">Gửi email đặt lại</button>
    </form>

    <div class="links">
        <a href="login.php">← Quay lại đăng nhập</a>
    </div>
</div>
</body>
</html>
