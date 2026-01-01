<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý doanh thu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>HỆ THỐNG QUẢN LÝ BÁN HÀNG</h1>
</header>

<div class="menu">
    <a href="index.html">Trang chủ</a>
    <a href="nguyen_vat_lieu.php">Nguyên vật liệu</a>
    <a href="doanh_thu.php" class="active">Doanh thu</a>
    <a href="thong_ke.php">Thống kê</a>
</div>

<div class="container">

    <h2>Quản lý doanh thu</h2>

    <!-- FORM -->
    <div class="card">
        <form method="post" class="form-inline">
            <div class="form-group">
                <label>Ngày</label>
                <input type="date" name="ngay" required>
            </div>

            <div class="form-group">
                <label>Tổng tiền</label>
                <input type="number" name="tien" placeholder="Nhập doanh thu" required>
            </div>

            <button type="submit" name="add" class="btn">
                Thêm doanh thu
            </button>
        </form>
    </div>

    <?php
    if (isset($_POST['add'])) {
        $conn->query("INSERT INTO doanh_thu VALUES
        (NULL,'{$_POST['ngay']}',{$_POST['tien']})");
    }
    ?>

    <!-- BẢNG -->
    <div class="card">
        <table>
            <tr>
                <th>Ngày</th>
                <th>Doanh thu (VNĐ)</th>
            </tr>
            <?php
            $rs = $conn->query("SELECT * FROM doanh_thu ORDER BY ngay DESC");
            while ($r = $rs->fetch_assoc()) {
                echo "<tr>
                    <td>{$r['ngay']}</td>
                    <td>".number_format($r['tong_tien'])."</td>
                </tr>";
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
