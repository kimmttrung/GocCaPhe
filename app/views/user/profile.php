<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="/GocCaPhe/public/assets/css/profile.css">

<section class="profile-container">
    <div class="profile-header">
        <h2>Hồ sơ của tôi</h2>
        <p>Quản lý thông tin hồ sơ và bảo mật tài khoản</p>
    </div>

    <div class="profile-body">
        <div class="profile-info">
            <h3 style="color: #4b2e1f; margin-bottom: 20px;">Thông tin cá nhân</h3>
            <form action="/GocCaPhe/public/index.php?url=profile/update" method="POST">
                <div class="form-group-row">
                    <label>Tên đăng nhập</label>
                    <input type="text" value="<?= htmlspecialchars($user['username'] ?? '') ?>" readonly class="readonly-input">
                </div>
                
                <div class="form-group-row">
                    <label>Họ và tên</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                </div>

                <div class="form-group-row">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                </div>

                <button type="submit" class="btn-save-profile">Lưu thông tin</button>
            </form>

            <hr style="margin: 40px 0; border: 0; border-top: 1px solid #eee;">

            <h3 style="color: #4b2e1f; margin-bottom: 20px;">Đổi mật khẩu</h3>
            <form action="/GocCaPhe/public/index.php?url=profile/update-password" method="POST">
                <div class="form-group-row">
                    <label>Mật khẩu cũ</label>
                    <input type="password" name="old_password" required placeholder="Nhập mật khẩu hiện tại">
                </div>
                
                <div class="form-group-row">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="new_password" required placeholder="Mật khẩu từ 6 ký tự">
                </div>

                <div class="form-group-row">
                    <label>Xác nhận</label>
                    <input type="password" name="confirm_password" required placeholder="Nhập lại mật khẩu mới">
                </div>

                <button type="submit" class="btn-save-profile" style="background-color: #28a745;">Cập nhật mật khẩu</button>
            </form>
        </div>

        <div class="profile-avatar">
            <div class="avatar-wrapper">
                <img src="/GocCaPhe/public/assets/img/default-avatar.png" alt="Avatar">
            </div>
            <button class="btn-upload-img">Chọn ảnh</button>
            <p>Dung lượng tối đa 1 MB <br> Định dạng: .JPEG, .PNG</p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>