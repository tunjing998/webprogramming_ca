<div class="container">
    <h3>Product List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Product Price</th>
                <th>Show</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($locals['products'] as $product) { ?>

                <tr class='bg-light'>
                    <td><?= $product->getProductId() ?></td>
                    <td><?= $product->getProductName() ?></td>
                    <td><?= $product->getProductType() ?></td>
                    <td><?= $product->getProductPrice() ?></td>
                    <td><a href='<?= BASE_DIR ?>/productedit/<?= $product->getProductId()?>'>Show Details</a></td>
                    <td>Delete Product</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Add New Product</p>
</div>