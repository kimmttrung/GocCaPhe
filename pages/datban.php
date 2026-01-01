<?php
session_start();

/* ===== LẤY dữ liệu form tạm nếu có ===== */
$datban_temp = $_SESSION['datban_temp'] ?? [];

if(isset($_SESSION['error'])): ?>
    <div class="error">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="datban.css">
    <title>Góc Cafe - Đặt bàn</title>
</head>
<body>
<div class="nav">
    <a href="index.php">Trang chủ</a>
    <a href="menu.php">Menu</a>
    <a href="gioithieu.php">Giới thiệu</a>
    <a href="datban.php" class="active">Đặt bàn</a>

    <?php if(isset($_SESSION['user'])): ?>
        <span style="margin-left:20px;">
            Xin chào <?= htmlspecialchars($_SESSION['user']) ?>
        </span>
        <a href="logout.php?redirect=datban.php">Đăng xuất</a>
    <?php else: ?>
        <a href="login.php?redirect=datban.php">Đăng nhập</a>
        <a href="register.php">Đăng ký</a>
    <?php endif; ?>
</div>
<div class="section">
    <h2>Đặt bàn trước</h2>

    <form action="save_excel.php" method="post" class="../assets/css/datban.css">
        <input type="hidden" name="dat_ban" value="1">

        <label>Họ tên</label>
        <input type="text" name="hoten" required
               value="<?= htmlspecialchars($datban_temp['hoten'] ?? '') ?>">

        <label>Số điện thoại</label>
        <input type="text" name="sdt" required
                pattern="0\d{9}" 
                title="Số điện thoại bắt đầu bằng 0 và có 10 chữ số"
                value="<?= htmlspecialchars($datban_temp['sdt'] ?? '') ?>">



        <label>Ngày giờ</label>
        <input type="datetime-local" name="thoigian" required
               value="<?= htmlspecialchars($datban_temp['thoigian'] ?? '') ?>">

        <label>Số người</label>
        <input type="number" name="songuoi" required min="1" max="500"
                value="<?= htmlspecialchars($datban_temp['songuoi'] ?? '') ?>">


        <label>Ghi chú</label>
        <input type="text" name="ghichu"
               value="<?= htmlspecialchars($datban_temp['ghichu'] ?? '') ?>">

        <button type="submit" class="button" name="dat_ban">Đặt bàn</button>
    </form>
</div>
</body>
</html>
