<?php
session_start();
$products = [
    ["id" => 1, "name" => "Cà phê Sữa Đá", "price" => 33000, "img" => "../assets/img/caphesuada.jpg", "type" => "Cà phê"],
["id" => 2, "name" => "Sinh tố Xoài", "price" => 40000, "img" => "../assets/img/sinhtoxoai.jpg", "type" => "Sinh tố"],
["id" => 3, "name" => "Sinh tố Sữa Chua", "price" => 30000, "img" => "../assets/img/sinhtosuachua.jpg", "type" => "Sinh tố"],
["id" => 4, "name" => "Trà Đào", "price" => 39000, "img" => "../assets/img/tradao.jpg", "type" => "Trà"],
["id" => 5, "name" => "Trà Sen Kem Cheese", "price" => 39000, "img" => "../assets/img/cheese.jpg", "type" => "Trà"],
["id" => 6, "name" => "Cà Phê Muối", "price" => 35000, "img" => "../assets/img/caphemuoi.jpg", "type" => "Cà phê"],
["id" => 7, "name" => "Bơ Già Dừa Non", "price" => 45000, "img" => "../assets/img/bogiaduanon.jpg", "type" => "Sinh tố"],
["id" => 8, "name" => "Trà Dâu", "price" => 30000, "img" => "../assets/img/tradau.jpg", "type" => "Trà"],
["id" => 9, "name" => "Trà Sữa Trân Châu", "price" => 35000, "img" => "../assets/img/trasua.jpg", "type" => "Trà"],
["id" => 10, "name" => "Bánh Muffin", "price" => 25000, "img" => "../assets/img/banh.jpg", "type" => "Bánh"],
["id" => 11, "name" => "Espresso", "price" => 35000, "img" => "../assets/img/espro.jpg", "type" => "Cà phê"],
["id" => 12, "name" => "Trà Cúc", "price" => 25000, "img" => "../assets/img/tracuc.jpg", "type" => "Trà"],
["id" => 13, "name" => "Bánh Kem Socola", "price" => 25000, "img" => "../assets/img/banhkemsocola.jpg", "type" => "Bánh"],
["id" => 14, "name" => "Bánh Tiramisu", "price" => 25000, "img" => "../assets/img/tiramisu.jpg", "type" => "Bánh"],
["id" => 15, "name" => "Trà Chanh", "price" => 30000, "img" => "../assets/img/trachanhs.jpg", "type" => "Trà"],
["id" => 16, "name" => "Trà Mãng Cầu", "price" => 39000, "img" => "../assets/img/tramangcau.jpg", "type" => "Trà"],
["id" => 17, "name" => "Trà Ô Long", "price" => 39000, "img" => "../assets/img/traolong.jpg", "type" => "Trà"],
["id" => 18, "name" => "Trà Ôi Hồng", "price" => 39000, "img" => "../assets/img/traoihong.jpg", "type" => "Trà"],
["id" => 19, "name" => "Matcha Latte", "price" => 35000, "img" => "../assets/img/matchalatte.jpg", "type" => "Matcha"],
["id" => 20, "name" => "Matcha Kem Cheese", "price" => 35000, "img" => "../assets/img/matchakemcheese.jpg", "type" => "Matcha"],
["id" => 21, "name" => "Matcha Đá Xay", "price" => 48000, "img" => "../assets/img/matchadaxay.jpg", "type" => "Matcha"],
["id" => 22, "name" => "Sữa Tươi Trân Châu Đường Đen", "price" => 30000, "img" => "../assets/img/suatuoitranchauduongden.jpg", "type" => "Trà"],
["id" => 23, "name" => "Hướng Dương", "price" => 15000, "img" => "../assets/img/huongduong.jpg", "type" => "Topping"],
["id" => 24, "name" => "Khô heo / Khô gà", "price" => 30000, "img" => "../assets/img/khoheo.jpg", "type" => "Topping"],
["id" => 25, "name" => "Hạt Dẻ To / Bé", "price" => 35000, "img" => "../assets/img/hatde.jpg", "type" => "Topping"],
["id" => 26, "name" => "Hoa Quả Đầm", "price" => 30000, "img" => "../assets/img/hoaqua.jpg", "type" => "Topping"],
["id" => 27, "name" => "Trà Vải", "price" => 40000, "img" => "../assets/img/travai.jpg", "type" => "Trà"],
["id" => 28, "name" => "Trà Nhiệt Đới", "price" => 42000, "img" => "../assets/img/tranhietdoi.jpg", "type" => "Trà"],
["id" => 29, "name" => "Nước Ép Cam", "price" => 35000, "img" => "../assets/img/nuocepcam.jpg", "type" => "Nước Ép"],
["id" => 30, "name" => "Nước Ép Dứa", "price" => 35000, "img" => "../assets/img/nuocepdua.jpg", "type" => "Nước Ép"],
["id" => 31, "name" => "Nước Ép Cà Rốt", "price" => 35000, "img" => "../assets/img/nuocepcarot.jpg", "type" => "Nước Ép"],
["id" => 32, "name" => "Nước Ép Táo", "price" => 35000, "img" => "../assets/img/nuoceptao.jpg", "type" => "Nước Ép"],
["id" => 33, "name" => "Nước Ép Dưa hấu", "price" => 35000, "img" => "../assets/img/nuocepduahau.jpg", "type" => "Nước Ép"],
["id" => 34, "name" => "Nước Ép Ổi", "price" => 35000, "img" => "../assets/img/nuocepoi.jpg", "type" => "Nước Ép"]
];

if (isset($_POST["add"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    $_SESSION["cart"][] = [
        "id" => $id,
        "name" => $name,
        "price" => $price,
        "qty" => 1
    ];
    header("Location: menu.php?status=added");
    exit;
}
$loai = $_GET["loai"] ?? "Tất cả";
$filtered = ($loai == "Tất cả")
    ? $products
    : array_filter($products, fn($p) => $p["type"] == $loai);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
    <title>Góc Cafe - Menu</title>
</head>
<body>
<div class="nav">
    <a href="../pages/index.php">Trang chủ</a>
    <a href="menu.php">Menu</a>
    <a href="gioithieu.php">Giới thiệu</a>
    <a href="datban.php">Đặt bàn</a>

    <?php if(isset($_SESSION['user'])): ?>
        <span style="margin-left:20px;">
            Xin chào <?= htmlspecialchars($_SESSION['user']) ?>
        </span>
        <a href="logout.php">Đăng xuất</a>
    <?php else: ?>
        <a href="login.php">Đăng nhập</a>
        <a href="register.php">Đăng ký</a>
    <?php endif; ?>
</div>
<div class="section">
    <h2>Menu của chúng tôi</h2>
    <div class="filter-bar">
        <a href="menu.php?loai=Tất cả"><button class="<?= ($loai=='Tất cả'?'active':'') ?>">Tất cả</button></a>
        <a href="menu.php?loai=Cà phê"><button class="<?= ($loai=='Cà phê'?'active':'') ?>">Cà phê</button></a>
        <a href="menu.php?loai=Trà"><button class="<?= ($loai=='Trà'?'active':'') ?>">Trà</button></a>
        <a href="menu.php?loai=Bánh"><button class="<?= ($loai=='Bánh'?'active':'') ?>">Bánh</button></a>
        <a href="menu.php?loai=Sinh tố"><button class="<?= ($loai=='Sinh tố'?'active':'') ?>">Sinh tố</button></a>
        <a href="menu.php?loai=Matcha"><button class="<?= ($loai=='Matcha'?'active':'') ?>">Matcha</button></a>
        <a href="menu.php?loai=Nước Ép"><button class="<?= ($loai=='Nước Ép'?'active':'') ?>">Nước Ép</button></a>
        <a href="menu.php?loai=Topping"><button class="<?= ($loai=='Topping'?'active':'') ?>">Topping</button></a>
    </div>
    <div class="menu-grid">
        <?php foreach ($filtered as $p): ?>
        <div class="menu-card">
            <img src="<?= $p['img'] ?>">
            <div class="menu-content">
                <div class="menu-title"><?= $p['name'] ?></div>
                <div class="menu-desc"><?= $p['type'] ?></div>
                <div class="menu-bottom">
                    <div class="price"><?= number_format($p['price']) ?>₫</div>
                    <form action="menu.php" method="post">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <input type="hidden" name="name" value="<?= $p['name'] ?>">
                        <input type="hidden" name="price" value="<?= $p['price'] ?>">
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div> <!-- LIÊN HỆ -->
    <section class="contact-section">
      <div class="contact-container">
        <div class="contact-info">
          <h2>Liên hệ</h2>

          <p>
            <b>Địa chỉ:</b> Căn liền kề LK1-27 Chung cư Hoàng Huy, An Đồng, An
            Dương, Hải Phòng
          </p>
          <p><b>Hotline:</b> 0839331102</p>
          <p><b>Email:</b> banam0503@gmail.com</p>

          <p>
            📍
            <a href="https://maps.app.goo.gl/NV9a5nx6WNSSrYyn9" target="_blank">
              Xem vị trí trên Google Maps
            </a>
          </p>
        </div>

        <div class="contact-map">
          <iframe
            src="https://maps.google.com/maps?q=G%C3%B3c%20-%20Tr%C3%A0%20%26%20Cafe,%20An%20D%C6%B0%C6%A1ng,%20H%E1%BA%A3i%20Ph%C3%B2ng&t=&z=15&ie=UTF8&iwloc=&output=embed"
          >
          </iframe>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      © 2025 Quán Cafe Góc Cafe. Mọi quyền được bảo lưu.
    </footer>
</body>
</html>
