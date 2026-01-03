<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?><!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa doanh thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>✏️ Sửa Doanh Thu</h3>

    <form method="POST" action="?url=admin/revenue/update">
        <input type="hidden" name="id" value="<?= $revenue['id'] ?>">

        <div class="mb-3">
            <label>Ngày</label>
            <input type="date" name="revenue_date" class="form-control"
                   value="<?= $revenue['revenue_date'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Số tiền</label>
            <input type="number" name="amount" class="form-control"
                   value="<?= $revenue['amount'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control"><?= htmlspecialchars($revenue['note']) ?></textarea>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="?url=admin/revenue" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

</body>
</html>
