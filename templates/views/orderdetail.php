<div class="container">
    <!-- <h3><?= $locals['order'][0]['order_id'] ?></h3> -->
    <p class="mt-2">OrderDate: <?= $locals['order'][0]['order_date'] ?></p>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <!-- <th>clientid</th> -->
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Show Product</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($locals['order'] as $product) { ?>

                <tr class='bg-light'>
                    <td><?= $product['product_id'] ?></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['product_price'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td><a href='<?= BASE_DIR ?>/product/<?= $product['product_id'] ?>'>Show Product</a>
                    <!-- <td>待发货</td> -->
                </tr>
                <?php
                $total += $product['product_price'];
            } ?>
        </tbody>
    </table>
            <p>Total Price : <?=$total?></p>
</div>