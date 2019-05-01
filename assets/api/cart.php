<?php
//https://www.youtube.com/watch?v=uRlC721mn8Y
session_start();
$cart = '';
$message = '';
$action = $_POST['action'] ?? null;
if ($action != null) {
    if ($action == 'add') {
        if (isset($_SESSION['cart'])) {
            $is_available = 0;
            foreach ($_SESSION['cart'] as $keys => $values) {
                if ($_SESSION['cart'][$keys]['product_id'] == $_POST['product_id']) {
                    $is_available++;
                    $_SESSION['cart'][$keys]['product_quantity'] =  $_SESSION['cart'][$keys]['product_quantity'] + 1;
                }
            }
            if ($is_available < 1) {
                $item_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_quantity' => 1
                );
                $_SESSION['cart'][] = $item_array;
            }
        } else {
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_quantity' => 1
            );
            $_SESSION['cart'][] = $item_array;
        }
    } else if ($action == 'delete') {
        foreach ($_SESSION['cart'] as $keys => $values) {
            if ($values['product_id'] == $_POST['product_id']) {
                unset($_SESSION['cart'][$keys]);
            }
        }
    }
    $cart .= '<table class="table table-bordered">
    <tr>
     <th width="40%">Product Name</th>
     <th width="10%">Quantity</th>
     <th width="20%">Price</th>
     <th width="15%">Subtotal</th>
     <th width="5%">Action</th>
    </tr>';
    if (!empty($_SESSION["cart"])) {
        $total = 0;
        foreach ($_SESSION['cart'] as $keys => $values) {
            $cart .= '
            <tr>
            <td>' . $values["product_name"] . '</td>
            <td>' . $values["product_quantity"] . '</td>
            <td>' . $values["product_price"] . '</td>
            <td>' . number_format($values["product_quantity"] * $values["product_price"], 2) . '</td>
            <td><button name = "delete" class="delete" id="' . $values["product_id"] . '">Delete</button></td>
            </tr>
            ';
            $total += number_format($values["product_quantity"] * $values["product_price"], 2);
        }
        $cart .= '<tr>
         <td>Total</td>
         <td>€' . number_format($total, 2) . '</td>
         </tr>
         <tr>
         <td><a href="/wp_ca4_tunjingAng_xingnuoCen_emiliaCzubaj/checkout">Process To Checkout Page</a><td>
         </tr>
         '
         ;
    }
    $cart .= '</table>';
    echo $cart;
}
?>