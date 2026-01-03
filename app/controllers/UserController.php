<?php
class UserController {
    
    public function profile() {
        // Chỉ cần lấy user và hiện trang profile duy nhất
        $user = $_SESSION['user'];
        require_once __DIR__ . '/../views/user/profile.php';
    }

    public function updateProfile() {
        // Xử lý cập nhật Tên, Email...
        header('Location: /GocCaPhe/public/index.php?url=profile');
    }

    public function updatePassword() {
        // Xử lý đổi mật khẩu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_pass = $_POST['old_password'];
            $new_pass = $_POST['new_password'];
            $confirm_pass = $_POST['confirm_password'];

            if ($new_pass !== $confirm_pass) {
                echo "<script>alert('Mật khẩu xác nhận không khớp!'); window.history.back();</script>";
                return;
            }

            // Code Update Database ở đây...
            
            header('Location: /GocCaPhe/public/index.php?url=profile&success=1');
        }
    }
}