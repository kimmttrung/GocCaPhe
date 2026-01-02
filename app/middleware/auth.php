<?php

function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: /GocCaPhe/public/index.php?url=login");
        exit;
    }
}

function requireRole($role) {
    requireLogin();

    if ($_SESSION['user']['role'] !== $role) {
        http_response_code(403);
        echo "Bạn không có quyền truy cập";
        exit;
    }
}
