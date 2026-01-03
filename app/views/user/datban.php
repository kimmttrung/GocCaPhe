<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<link rel="stylesheet" href="/GocCaPhe/public/assets/css/datban.css">

<h2 class="datban-title">Đặt bàn</h2>

<div class="datban-wrapper">
    <form method="POST" action="/GocCaPhe/public/index.php?url=reservation/store">

        <label>Họ tên</label>
        <input type="text" name="hoten" required>

        <label>Số điện thoại</label>
        <input type="text" name="phone" pattern="0[0-9]{9}" required>

        <label>Số người</label>
        <input type="number" name="songuoi" min="1" max="500" required>

        <label>Ngày</label>
        <input type="date" name="ngay" required>

        <label>Giờ</label>
        <input type="time" name="gio" required>

        <label>Ghi chú</label>
        <textarea name="ghichu"></textarea>

        <button type="submit">Đặt bàn</button>
    </form>

    <?php if (!empty($_SESSION['success'])): ?>
        <p class="datban-success">✔ <?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p class="datban-error">❌ <?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
