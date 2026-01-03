<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Doanh thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>📊 Quản lý Doanh Thu</h2>
        <a href="?url=admin/revenue/create" class="btn btn-primary">➕ Thêm Doanh Thu</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Ngày</th>
                <th>Số tiền</th>
                <th>Ghi chú</th>
                <th width="160">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($revenues as $r): ?>
                <?php $total += $r['amount']; ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['revenue_date'] ?></td>
                    <td><?= number_format($r['amount']) ?> ₫</td>
                    <td><?= htmlspecialchars($r['note']) ?></td>
                    <td>
                        <a href="?url=admin/revenue/edit&id=<?= $r['id'] ?>" class="btn btn-sm btn-success">Sửa</a>
                        <a href="?url=admin/revenue/delete&id=<?= $r['id'] ?>"
                           onclick="return confirm('Xoá doanh thu này?')"
                           class="btn btn-sm btn-danger">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-warning fw-bold">
                <td colspan="2">TỔNG</td>
                <td colspan="3"><?= number_format($total) ?> ₫</td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
