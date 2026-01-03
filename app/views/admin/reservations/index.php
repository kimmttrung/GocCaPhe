<?php require_once __DIR__ . '/../../layouts/admin_header.php'; ?>

<h2 style="text-align: center; font-family: Arial, sans-serif; color: #333; margin-top: 20px;">Quản lý đặt bàn</h2>

<div style="overflow-x:auto; padding: 20px;">
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
        <tr style="background-color: #333; color: white; text-align: center;">
            <th>ID</th>
            <th>Họ tên</th>
            <th>Phone</th>
            <th>Số người</th>
            <th>Ngày & Giờ</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($reservations)): ?>
            <tr><td colspan="8" style="text-align: center;">Chưa có dữ liệu đặt bàn.</td></tr>
        <?php else: ?>
            <?php foreach ($reservations as $r): ?>
            <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                <td><strong>#<?= $r['id'] ?></strong></td>
                <td style="text-align: left;"><?= htmlspecialchars($r['hoten']) ?></td>
                <td><?= htmlspecialchars($r['phone']) ?></td>
                <td><?= $r['songuoi'] ?></td>
                <td>
                    <?= date('d/m/Y', strtotime($r['ngay'])) ?><br>
                    <small style="color: #666;"><?= $r['gio'] ?></small>
                </td>
                <td style="max-width: 200px; font-style: italic; color: #555;">
                    <?= htmlspecialchars($r['ghichu'] ?? '---') ?>
                </td>
                <td>
                    <?php
                    switch ($r['trangthai']) {
                        case 'DA_DUYET':
                            echo '<span style="color:white; background:green; padding:3px 8px; border-radius:4px; font-size:12px;">Đã duyệt</span>';
                            break;
                        case 'HUY':
                            echo '<span style="color:white; background:red; padding:3px 8px; border-radius:4px; font-size:12px;">Đã huỷ</span>';
                            break;
                        default:
                            echo '<span style="color:black; background:yellow; padding:3px 8px; border-radius:4px; font-size:12px;">Chờ duyệt</span>';
                    }
                    ?>
                </td>
                <td>
                <?php if ($r['trangthai'] === 'CHO_DUYET'): ?>
                    <a href="index.php?url=admin/reservations/approve&id=<?= $r['id'] ?>"
                        style="color: green; font-weight: bold; text-decoration: none;"
                        onclick="return confirm('Xác nhận duyệt cho khách: <?= htmlspecialchars($r['hoten']) ?>?')">Duyệt</a>
                    |
                    <a href="index.php?url=admin/reservations/cancel&id=<?= $r['id'] ?>"
                        style="color: red; font-weight: bold; text-decoration: none;"
                        onclick="return confirm('Xác nhận hủy đơn đặt bàn này?')">Huỷ</a>
                <?php else: ?>
                    <span style="color: #999;">---</span>
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>