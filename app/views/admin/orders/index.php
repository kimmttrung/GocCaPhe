<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>

<div class="container mt-4">
    <h3>Quản lý đơn hàng</h3>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $o): ?>
            <tr>
                <td><?= $o['id'] ?></td>
                <td><?= htmlspecialchars($o['customer_name']) ?></td>
                <td><?= number_format($o['total_price'],0,',','.') ?>₫</td>
                <td>
                    <span class="badge bg-<?= match($o['status']){
                        'PAID'      => 'warning',
                        'APPROVED'  => 'success',
                        'CANCELLED' => 'danger',
                        default     => 'secondary'
                    } ?>">
                        <?= $o['status'] ?>
                    </span>
                </td>
                <td><?= $o['created_at'] ?></td>
                <td>
                    <?php if($o['status']=='PAID'): ?>
                        <form method="post" action="?url=admin/orders/approve" class="d-inline">
                            <input type="hidden" name="id" value="<?= $o['id'] ?>">
                            <button class="btn btn-sm btn-success">Duyệt</button>
                        </form>

                        <button class="btn btn-sm btn-danger"
                                onclick="rejectOrder(<?= $o['id'] ?>)">
                            Từ chối
                        </button>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>  

<script>
function rejectOrder(id){
    const reason = prompt('Lý do từ chối:');
    if(!reason) return;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '?url=admin/orders/reject';

    form.innerHTML = `
        <input type="hidden" name="id" value="${id}">
        <input type="hidden" name="reason" value="${reason}">
    `;

    document.body.appendChild(form);
    form.submit();
}
</script>

