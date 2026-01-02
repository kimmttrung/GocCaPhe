<?php

class AuthController {

    // HIỂN THỊ FORM LOGIN (GET)
    public function login() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // XỬ LÝ LOGIN (POST)
    public function handleLogin() {

        // chặn truy cập GET
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /GocCaPhe/public/index.php?url=login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ email và mật khẩu';
            header('Location: /GocCaPhe/public/index.php?url=login');
            exit;
        }

        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Email hoặc mật khẩu không đúng';
            header('Location: /GocCaPhe/public/index.php?url=login');
            exit;
        }

        // LOGIN OK
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];

        // redirect theo role
        switch ($user['role']) {
            case 'ADMIN':
                header("Location: /GocCaPhe/public/index.php?url=admin");
                break;
            case 'STAFF':
                header("Location: /GocCaPhe/public/index.php?url=staff");
                break;
            default:
                header("Location: /GocCaPhe/public/index.php");
        }
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: /GocCaPhe/public/index.php?url=login");
        exit;
    }
}
    