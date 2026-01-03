<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Giỏ hàng của bạn</h2>

    <?php if (empty($items)): ?>
        <p>Giỏ hàng đang trống</p>
    <?php else: ?>

        <div class="mb-3">
    <a href="?url=cart&status=PENDING"
       class="btn btn-outline-warning <?= ($_GET['status'] ?? 'PENDING')==='PENDING' ? 'active' : '' ?>">
        Đang mua (PENDING)
    </a>

    <a href="?url=cart&status=PAID"
       class="btn btn-outline-success <?= ($_GET['status'] ?? '')==='PAID' ? 'active' : '' ?>">
        Đã thanh toán (PAID)
    </a>
</div>
        <form id="cart-form">
            
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Tạm tính</th>
                        <th>Ảnh</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): 
                        $isPaid = ($item['status']=='PAID');
                    ?>
                       <tr data-order-item-id="<?= $item['order_item_id'] ?>">
                            <td>
                                <input type="checkbox"
                                    class="item-checkbox"
                                    value="<?= $item['order_item_id'] ?>"
                                    <?= $item['status']==='PAID' ? 'disabled' : '' ?>>

                            </td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>
                                <div class="input-group" style="width:120px;">
                                    <button type="button" class="btn btn-outline-secondary btn-decrease" <?= $item['status']=='PAID' ? 'disabled' : '' ?>>-</button>
                                    <input type="text" class="form-control text-center quantity-input" value="<?= $item['quantity'] ?>" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-increase" <?= $item['status']=='PAID' ? 'disabled' : '' ?>>+</button>
                                </div>
                            </td>
                            <td class="price"><?= number_format($item['price'],0,',','.') ?>₫</td>
                            <td>
                                <span class="badge <?= $item['status']=='PAID' ? 'bg-success' : 'bg-warning' ?>">
                                    <?= $item['status'] ?>
                                </span>
                            </td>
                            <td class="subtotal"><?= number_format($item['price'] * $item['quantity'],0,',','.') ?>₫</td>
                            <td class="text-center">
                                <?php if(!empty($item['image'])): ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#imgModal<?= $item['product_id'] ?>">👁️</button>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="<?= $item['order_item_id'] ?>">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4>Tổng tiền: <span id="total-price">0₫</span></h4>
                <button type="button" id="checkout-btn" class="btn btn-success">Đặt hàng ngay</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceEl = document.getElementById('total-price');

    function formatCurrency(num){
        return num.toLocaleString('vi-VN') + '₫';
    }

    function calculateTotal(){
    let total = 0;
    document.querySelectorAll('tr[data-order-item-id]').forEach(tr=>{
        const checkbox = tr.querySelector('.item-checkbox');
        if(checkbox && checkbox.checked){
            const quantity = parseInt(tr.querySelector('.quantity-input').value);
            const price = parseInt(tr.querySelector('.price').textContent.replace(/\D/g,''));
            total += quantity * price;
        }
    });
    totalPriceEl.textContent = formatCurrency(total);
    }


    // Chọn tất cả
    selectAll.addEventListener('change', ()=>{
        checkboxes.forEach(cb => { if(!cb.disabled) cb.checked = selectAll.checked; });
        calculateTotal();
    });

    // Checkbox từng item
    checkboxes.forEach(cb=>{
        cb.addEventListener('change', ()=>{
            selectAll.checked = [...checkboxes].filter(c=>!c.disabled).every(c => c.checked);
            calculateTotal();
        });
    });

    // Nút tăng giảm
    document.querySelectorAll('tr[data-order-item-id]').forEach(tr=>{
    const decreaseBtn = tr.querySelector('.btn-decrease');
    const increaseBtn = tr.querySelector('.btn-increase');
    const qtyInput = tr.querySelector('.quantity-input');
    const priceEl = tr.querySelector('.price');
    const subtotalEl = tr.querySelector('.subtotal');

    const price = parseInt(priceEl.textContent.replace(/\D/g,''));
    
    if(decreaseBtn && increaseBtn){
        // GỌI AJAX TĂNG
        increaseBtn.addEventListener('click', ()=>{
            fetch('/GocCaPhe/public/index.php?url=cart/updateQuantity', {
                method:'POST',
                headers:{'Content-Type':'application/x-www-form-urlencoded'},
                body:`id=${tr.dataset.orderItemId}&type=inc`
            })
            .then(r=>r.json())
            .then(res=>{
                if(res.success){
                    qtyInput.value = res.quantity;
                    subtotalEl.textContent = formatCurrency(res.quantity * price);
                    calculateTotal();
                }
            });
        });
        decreaseBtn.addEventListener('click', ()=>{
            fetch('/GocCaPhe/public/index.php?url=cart/updateQuantity', {
                method:'POST',
                headers:{'Content-Type':'application/x-www-form-urlencoded'},
                body:`id=${tr.dataset.orderItemId}&type=dec`
            })
            .then(r=>r.json())
            .then(res=>{
                if(res.success){
                    qtyInput.value = res.quantity;
                    subtotalEl.textContent = formatCurrency(res.quantity * price);
                    calculateTotal();
                }
            });
            });
    }
});
    // Checkout button
    document.getElementById('checkout-btn').addEventListener('click', ()=>{
        const selectedIds = [...document.querySelectorAll('.item-checkbox:checked')].map(cb=>cb.value);
        if(selectedIds.length===0){
            alert('Vui lòng chọn ít nhất 1 sản phẩm');
            return;
        }

        // Redirect sang trang nhập địa chỉ & thanh toán
        window.location.href = '/GocCaPhe/public/index.php?url=cart/checkout&items='+selectedIds.join(',');
    });

   document.querySelectorAll('.btn-delete').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        const id = btn.dataset.id;
        if(!confirm('Bạn có chắc muốn xóa?')) return;

        fetch('/GocCaPhe/public/index.php?url=cart/delete', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'id=' + id
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.success){
                btn.closest('tr').remove();
                calculateTotal();
            }
        });
    });
});


// Tính tổng ngay khi load
    calculateTotal();

</script>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
