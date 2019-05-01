<div class="modal bd-example-modal-lg fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Cart
            </div>
            <div class="modal-body" id='cartbody'>
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Subtotal</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php session_start();
                    if (!empty($_SESSION['cart'])) {
                        $total = 0;
                        foreach ($_SESSION['cart'] as $keys => $values) { ?>
                            <tr>
                                <td><?= $values["product_name"] ?></td>
                                <td><?= $values["product_quantity"] ?></td>
                                <td><?= $values["product_price"] ?></td>
                                <td><?= number_format($values["product_quantity"] * $values["product_price"], 2) ?></td>
                                <td><button name="delete" class="delete" id='<?= $values["product_id"] ?>'>Delete</button> </td>
                            </tr> <?php
                                    $total += number_format($values["product_quantity"] * $values["product_price"], 2);
                                } ?>
                        <tr>
                            <td>Total</td>
                            <td>€<?= number_format($total, 2) ?></td>
                        </tr>
                        <tr>
                        <td><a href="<?= BASE_DIR ?>/checkout">Process To Checkout Page</a><td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>Nothing is inside</td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
            <div class="modal-footer d-block">

            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    <script src="<?= BASE_DIR ?>/assets/js/cart.js"></script>