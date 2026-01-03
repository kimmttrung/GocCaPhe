<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/Reservation.php';

class ReservationController {

    public function store() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
        // === LẤY ĐÚNG TÊN FIELD TỪ FORM ===
        $hoten   = trim($_POST['hoten'] ?? '');
        $phone   = trim($_POST['phone'] ?? '');
        $songuoi = (int)($_POST['songuoi'] ?? 0);
        $ngay    = $_POST['ngay'] ?? '';
        $gio     = $_POST['gio'] ?? '';
        $ghichu  = trim($_POST['ghichu'] ?? '');

        // === VALIDATE ===
        if ($hoten === '' || $phone === '' || $songuoi <= 0 || $ngay === '' || $gio === '') {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
            header("Location: index.php?url=datban");
            exit;
        }

        if (!preg_match('/^0\d{9}$/', $phone)) {
            $_SESSION['error'] = "Số điện thoại không hợp lệ";
            header("Location: index.php?url=datban");
            exit;
        }

        if ($songuoi > 500) {
            $_SESSION['error'] = "Số người tối đa là 500";
            header("Location: index.php?url=datban");
            exit;
        }

        // === LƯU DB ===
        Reservation::create([
            'hoten'   => $hoten,
            'phone'   => $phone,
            'songuoi' => $songuoi,
            'ngay'    => $ngay,
            'gio'     => $gio,
            'ghichu'  => $ghichu
        ]);

        $_SESSION['success'] = "Đặt bàn thành công!";
        header("Location: index.php?url=datban");
        exit;
    }
}
