<?php
session_start();

/* CHECK LOGIN */
if(!isset($_SESSION['user'])){
    $_SESSION['datban_temp'] = $_POST;
    $_SESSION['redirect_after_login'] = "datban.php";
    $_SESSION['message'] = "Bạn cần đăng nhập để đặt bàn!";
    header("Location: login.php");
    exit();
}

/* LẤY dữ liệu form */
$user   = $_SESSION['user'];
$hoten  = $_POST['hoten'] ?? '';
$sdt    = $_POST['sdt'] ?? '';
$time   = $_POST['thoigian'] ?? '';
$people = $_POST['songuoi'] ?? '';
$note   = $_POST['ghichu'] ?? '';
$date   = date("d/m/Y H:i");

// Lưu tạm nếu lỗi
$_SESSION['datban_temp'] = $_POST;

/* VALIDATE */
// Số điện thoại: bắt đầu 0 và 10 chữ số
if (!preg_match('/^0\d{9}$/', $sdt)) {
    $_SESSION['error'] = "Số điện thoại không hợp lệ! Phải bắt đầu bằng 0 và đủ 10 chữ số.";
    header("Location: datban.php");
    exit;
}

// Họ tên (chữ có dấu)
if (!preg_match('/^[\p{L}\s]+$/u', $hoten)) {
    $_SESSION['error'] = "Họ tên chỉ được chứa chữ cái và khoảng trắng!";
    header("Location: datban.php");
    exit;
}

// Số người: 1-500
if (!is_numeric($people) || $people < 1 || $people > 500) {
    $_SESSION['error'] = "Số người phải từ 1 đến 500!";
    header("Location: datban.php");
    exit;
}

/* FILE XLS */
$file = "du-lieu-quan.xls";

/* TẠO FILE NẾU CHƯA CÓ */
if(!file_exists($file)){
    $header = "Người đặt\tHọ tên\tSĐT\tThời gian\tSố người\tGhi chú\tNgày đặt\n";
    file_put_contents($file, $header);
}

/* GHI DỮ LIỆU */
$sdt = "'" . $sdt; // Excel sẽ hiểu là text, giữ số 0 đầu
$line = "$user\t$hoten\t$sdt\t$time\t$people\t$note\t$date\n";
file_put_contents($file, $line, FILE_APPEND);

// Xóa dữ liệu tạm
unset($_SESSION['datban_temp']);

// Thông báo thành công
echo "<script>alert('Đặt bàn thành công!'); window.location='datban.php';</script>";
exit();
?>
