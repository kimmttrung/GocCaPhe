<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-primary mb-3">📦 Thông tin giao hàng & thanh toán</h2>
            
            <!-- Kiểm tra xem user có thiếu thông tin không -->
            <?php if (empty($currentUser['address']) || empty($currentUser['phone'])): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Bạn chưa cập nhật đầy đủ <strong>Địa chỉ</strong> hoặc <strong>Số điện thoại</strong>. 
                    Vui lòng nhập bên dưới để tiếp tục thanh toán và cập nhật hồ sơ.
                </div>
            <?php endif; ?>

            <form method="POST" action="/GocCaPhe/public/index.php?url=cart/payment">
                <!-- Truyền danh sách ID món hàng -->
                <input type="hidden" name="items" value="<?= implode(',', array_column($items,'id')) ?>">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <strong>1. Thông tin người nhận</strong>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-danger fw-bold">Họ và tên người nhận (*)</label>
                            <input type="text" name="receiver_name" class="form-control" 
                                value="<?= htmlspecialchars($currentUser['name']) ?>" 
                                placeholder="Nhập họ tên người nhận hàng"
                                required
                                oninvalid="this.setCustomValidity('Vui lòng nhập tên người nhận hàng')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-danger fw-bold">Địa chỉ nhận hàng (*)</label>
                            <input type="text" name="address" class="form-control" 
                                value="<?= htmlspecialchars($currentUser['address'] ?? '') ?>" 
                                placeholder="Ví dụ: 123 Đường ABC, Quận 1, TP.HCM" 
                                required
                                minlength="10"
                                oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ cụ thể (ít nhất 10 ký tự)')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-danger fw-bold">Số điện thoại (*)</label>
                            <input type="text" name="phone" class="form-control" 
                            value="<?= htmlspecialchars($currentUser['phone'] ?? '') ?>" 
                            placeholder="Ví dụ: 0912345678" 
                            required
                            maxlength="10"
                            pattern="^0[0-9]{9}$"
                            oninvalid="this.setCustomValidity('Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số')"
                            oninput="this.setCustomValidity(''); this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <strong>2. Phương thức thanh toán</strong>
                    </div>
                    <div class="card-body">
                        <select name="payment_method" class="form-select" required>
                            <option value="momo">Ví điện tử Momo</option>
                            <option value="bank">Chuyển khoản Ngân hàng (VietQR)</option>
                            <option value="vnpay">Cổng thanh toán VNPAY</option>
                            <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                        </select>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <strong>3. Kiểm tra đơn hàng</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                        <?php 
                        $total = 0;
                        foreach ($items as $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="my-0"><?= htmlspecialchars($item['name']) ?></h6>
                                    <small class="text-muted">Số lượng: <?= $item['quantity'] ?></small>
                                </div>
                                <span class="text-muted"><?= number_format($subtotal,0,',','.') ?>₫</span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Tổng thanh toán:</h4>
                            <h3 class="text-success fw-bold"><?= number_format($total,0,',','.') ?>₫</h3>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="?url=cart" class="btn btn-secondary me-2">Quay lại giỏ hàng</a>
                    <button type="submit" class="btn btn-success btn-lg px-5">XÁC NHẬN THANH TOÁN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>