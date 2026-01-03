<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Thông tin giao hàng & thanh toán</h2>

    <form method="POST" action="/GocCaPhe/public/index.php?url=cart/payment">
        <input type="hidden" name="items" value="<?= implode(',', array_column($items,'id')) ?>">

        <div class="mb-3">
            <label>Địa chỉ nhận hàng</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phương thức thanh toán</label>
            <select name="payment_method" class="form-select" required>
                <option value="momo">Momo</option>
                <option value="bank">Tài khoản ngân hàng</option>
                <option value="vnpay">VN Pay</option>
            </select>
        </div>

        <h4>Đơn hàng</h4>
        <ul class="list-group mb-3">
        <?php 
        $total = 0;
        foreach ($items as $item): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?>
                <span><?= number_format($subtotal,0,',','.') ?>₫</span>
            </li>
        <?php endforeach; ?>
        </ul>

        <h4 class="text-end">
            Tổng tiền:
            <span class="text-success fw-bold">
                <?= number_format($total,0,',','.') ?>₫
            </span>
        </h4>


        <button type="submit" class="btn btn-success mt-3">Thanh toán</button>
    </form>
</div>
