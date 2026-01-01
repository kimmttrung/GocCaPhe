<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylegt.css">
    <title>Góc Cafe - Giới thiệu</title>
</head>
<body>
<!-- NAV -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="stylegt.css">
    <title>Góc Cafe - Giới thiệu</title>
</head>
<body>

<!-- NAV -->
<div class="nav">
    <a href="index.php">Trang chủ</a>
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
<!-- GIỚI THIỆU QUÁN -->
<section class="intro-section">
    <div class="intro-wrapper">
        <!-- Text bên trái -->
        <div class="intro-text">
            <h2>Giới thiệu quán Góc Cafe</h2>

            <p>Góc Cafe được thành lập với mong muốn mang lại một không gian thư giãn,
              nhẹ nhàng và gần gũi cho mọi khách hàng. Chúng tôi luôn chú trọng vào chất lượng từng ly 
              cà phê rang xay nguyên chất, kết hợp cùng không gian được thiết kế ấm cúng.</p>

            <p>Với phương châm “Chất lượng tạo nên trải nghiệm”, Góc Cafe cam kết mang đến hương vị 
              cà phê mộc mạc, thơm nồng, cùng với sự phục vụ chu đáo từ đội ngũ 
              nhân viên thân thiện.</p>

            <p>Ngoài cà phê, quán còn phục vụ trà trái cây, nước ép tươi và bánh ngọt homemade. Chúng tôi hy vọng Góc Cafe sẽ trở thành nơi bạn thư giãn và tận hưởng từng khoảnh khắc.</p>
        </div>

        <!-- Ảnh bên phải -->
        <div class="intro-image">
            <img src="bgg-coffee.jpg" alt="">
        </div>
    </div>
</section>
<!-- DỊCH VỤ -->
<section class="service-section">
    <h2>Dịch vụ của Góc Cafe</h2>
    <div class="service-container">
        <div class="service-box">
            <img src="icon-coffee.png" alt="">
            <h3>Cà phê rang xay nguyên chất</h3>
            <p>Cung cấp cà phê được rang mới mỗi ngày, giữ trọn hương vị tự nhiên.</p>
        </div>
        <div class="service-box">
            <img src="icon-machine.png" alt="">
            <h3>Pha chế bằng máy hiện đại</h3>
            <p>Sử dụng máy pha chuyên nghiệp tạo nên hương vị chuẩn quốc tế.</p>
        </div>
        <div class="service-box">
            <img src="icon-dessert.png" alt="">
            <h3>Đồ ngọt & trà trái cây</h3>
            <p>Nhiều loại bánh homemade và nước trái cây tươi mát.</p>
        </div>
        <div class="service-box">
            <img src="icon-delivery.png" alt="">
            <h3>Giao hàng tận nơi</h3>
            <p>Hỗ trợ giao hàng nhanh trong khu vực Hải Phòng.</p>
        </div>
    </div>
</section>
<!-- THÀNH TỰU -->
<section class="achievement-section">
    <h2>Thành tựu đạt được</h2>
    <div class="achievement-container">

        <div class="achievement-box">
            <h3>2023</h3>
            <p>Top 10 quán cà phê phong cách nhất quận An Dương.</p>
        </div>

        <div class="achievement-box">
            <h3>2024</h3>
            <p>Phục vụ hơn 100.000 khách hàng mỗi năm.</p>
        </div>

        <div class="achievement-box">
            <h3>2021</h3>
            <p>Ra mắt dòng cà phê rang mộc độc quyền nhà làm.</p>
        </div>

        <div class="achievement-box">
            <h3>2022</h3>
            <p>Đạt chứng nhận vệ sinh an toàn thực phẩm chuẩn 5 sao.</p>
        </div>

    </div>
</section>

<!-- VIDEO -->
<section class="coffee-video">
    <div class="media-container">
        <div class="video-box">
            <h2>Quy trình pha cà phê bằng máy</h2>
            <video controls>
                <source src="video-pha-may.mp4" type="video/mp4">
                Trình duyệt của bạn không hỗ trợ video.
            </video>
        </div>
    </div>
</section>
<div class="section-divider"></div>
<!-- ROBUSTA SECTION -->
<section class="coffee-robusta">
    <div class="media-container">
        <div class="robusta-box">
            <h2>Hạt cà phê Robusta</h2>
            <p>
                Hạt cà phê Robusta (Cà phê vối - Coffea canephora) là loại cà phê
                phổ biến thứ hai thế giới, nổi bật với hạt tròn, hàm lượng caffeine
                cao (2-4%), vị đắng mạnh, đậm đà, ít chua hơn Arabica, có mùi gỗ và
                đất đặc trưng. Loại cà phê này khỏe, kháng bệnh tốt, dễ trồng ở vùng
                nhiệt đới thấp, năng suất cao. Việt Nam hiện là một trong những nhà
                sản xuất Robusta lớn nhất thế giới.
            </p>

            <img src="robusta.jpg" alt="Hạt cà phê Robusta rang xay" />
        </div>
    </div>
</section>


<!-- LIÊN HỆ -->
<section class="contact-section">
    <div class="contact-container">
        <div class="contact-info">
            <h2>Liên hệ</h2>

            <p><b>Địa chỉ:</b> Căn liền kề LK1-27 Chung cư Hoàng Huy, An Đồng, An Dương, Hải Phòng</p>
            <p><b>Hotline:</b> 0839331102</p>
            <p><b>Email:</b> banam0503@gmail.com</p>

            <p>
                📍 <a href="https://maps.app.goo.gl/NV9a5nx6WNSSrYyn9" target="_blank">
                    Xem vị trí trên Google Maps
                </a>
            </p>
        </div>

        <div class="contact-map">
            <iframe
                src="https://maps.google.com/maps?q=G%C3%B3c%20-%20Tr%C3%A0%20%26%20Cafe,%20An%20D%C6%B0%C6%A1ng,%20H%E1%BA%A3i%20Ph%C3%B2ng&t=&z=15&ie=UTF8&iwloc=&output=embed">
            </iframe>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    © 2025 Quán Cafe Góc Cafe. Mọi quyền được bảo lưu.
</footer>
</body>
</html>
