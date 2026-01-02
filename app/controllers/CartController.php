<?php
class CartController {
    public function add() {
        $product_id = $_POST['product_id'];
        $cart = $_SESSION['cart'] ?? [];
        if (isset($cart[$product_id])) {
            $cart[$product_id] += 1;
        } else {
            $cart[$product_id] = 1;
        }
        $_SESSION['cart'] = $cart;
        header('Location: /GocCaPhe/public/index.php?url=cart');
        exit;
    }
}
