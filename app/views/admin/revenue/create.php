
<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>

<div class="container mt-4">
<h3>➕ Thêm Doanh Thu</h3>

<form method="POST" action="?url=admin/revenue/store">
    <div class="mb-3">
        <label>Ngày</label>
        <input type="date" name="revenue_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Số tiền</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Ghi chú</label>
        <textarea name="note" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Lưu</button>
    <a href="?url=admin/revenue" class="btn btn-secondary">Quay lại</a>
</form>
</div>
