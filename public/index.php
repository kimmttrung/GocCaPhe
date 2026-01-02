<?php
require_once __DIR__ . '/../core/bootstrap.php';

$url = $_GET['url'] ?? '';

switch ($url) {

    case '':
        (new HomeController)->index();
        break;

    /* AUTH — KHÔNG ĐƯỢC CHẶN */
    case 'login':
        (new AuthController)->login();
        break;

    case 'login-handle':
        (new AuthController)->handleLogin();
        break;

    case 'logout':
        (new AuthController)->logout();
        break;

    /* USER */
    case 'menu':
        requireLogin();
        (new ProductController)->list();
        break;

    /* STAFF */
    case 'staff':
        requireRole('STAFF');
        echo "Trang nhân viên";
        break;

    /* ADMIN */
    case 'admin':
        requireRole('ADMIN');
        echo "Trang admin";
        break;

    default:
        http_response_code(404);
        echo "404 - Không tìm thấy trang";
}
