<?php
require_once __DIR__ . '/../../config/Database.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Reservation {

    private static function db() {
        $connection = Database::connect();
        if (!$connection) {
            die("Lỗi: Không thể kết nối cơ sở dữ liệu. Hãy kiểm tra lại file config/Database.php");
        }
        return $connection;
    }

    private static function excelPath() {
        return __DIR__ . '/../../storage/reservations.xlsx';
    }

    /* ================= CREATE ================= */
    public static function create($data) {
        $conn = self::db();

        $sql = "INSERT INTO reservations
                (hoten, phone, songuoi, ngay, gio, ghichu, trangthai)
                VALUES (?, ?, ?, ?, ?, ?, 'CHO_DUYET')";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['hoten'],
            $data['phone'],
            $data['songuoi'],
            $data['ngay'],
            $data['gio'],
            $data['ghichu']
        ]);

        $id = $conn->lastInsertId();
        self::appendExcel($id, $data, 'CHO_DUYET');
    }

    /* ================= READ ================= */
    public static function all() {
        return self::db()
            ->query("SELECT * FROM reservations ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ================= APPROVE ================= */
    public static function approve($id) {
        self::db()
            ->prepare("UPDATE reservations SET trangthai='DA_DUYET' WHERE id=?")
            ->execute([$id]);

        self::updateExcelStatus($id, 'DA_DUYET');
    }

    /* ================= CANCEL ================= */
    public static function cancel($id) {
        self::db()
            ->prepare("UPDATE reservations SET trangthai='HUY' WHERE id=?")
            ->execute([$id]);

        self::updateExcelStatus($id, 'HUY');
    }

    /* ================= EXCEL LOGIC ================= */
    private static function appendExcel($id, $data, $status) {
        $path = self::excelPath();

        // Kiểm tra nếu file tồn tại và không rỗng thì Load, ngược lại tạo mới
        if (file_exists($path) && filesize($path) > 0) {
            try {
                $spreadsheet = IOFactory::load($path);
                $sheet = $spreadsheet->getActiveSheet();
            } catch (Exception $e) {
                $spreadsheet = self::createNewSpreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
            }
        } else {
            $spreadsheet = self::createNewSpreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
        }

        $row = $sheet->getHighestRow() + 1;
        $sheet->fromArray([
            $id,
            $data['hoten'],
            $data['phone'],
            $data['songuoi'],
            $data['ngay'],
            $data['gio'],
            $data['ghichu'],
            $status
        ], null, "A{$row}");

        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }

    private static function updateExcelStatus($id, $status) {
        $path = self::excelPath();
        if (!file_exists($path) || filesize($path) == 0) return;

        try {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $found = false;

            foreach ($sheet->getRowIterator(2) as $row) {
                $rowIndex = $row->getRowIndex();
                if ($sheet->getCell("A{$rowIndex}")->getValue() == $id) {
                    $sheet->setCellValue("H{$rowIndex}", $status);
                    $found = true;
                    break;
                }
            }

            if ($found) {
                $writer = new Xlsx($spreadsheet);
                $writer->save($path);
            }
        } catch (Exception $e) {
            // Bỏ qua nếu không load được file
        }
    }

    private static function createNewSpreadsheet() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            ['ID','Họ tên','Phone','Số người','Ngày','Giờ','Ghi chú','Trạng thái']
        ]);
        return $spreadsheet;
    }
}