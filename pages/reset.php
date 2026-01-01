<?php
include "db.php";
$token = $_GET['token'];

$rs = mysqli_query($conn,
    "SELECT * FROM users
     WHERE reset_token='$token'
     AND token_expire > NOW()"
);

if (mysqli_num_rows($rs) != 1) die("Link không hợp lệ");

if (isset($_POST['reset'])) {
    $pass = $_POST['password'];
    mysqli_query($conn,
        "UPDATE users SET password='$pass',
         reset_token=NULL, token_expire=NULL
         WHERE reset_token='$token'"
    );
    echo "Đổi mật khẩu thành công";
}
?>

<form method="post">
    <input type="password" name="password" required placeholder="Mật khẩu mới">
    <button name="reset">Xác nhận</button>
</form>
