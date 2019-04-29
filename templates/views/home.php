<div class="container mt-2">
    <div class="row d-flex justify-content-center">
        <?php foreach ($locals['products'] as $product) { ?>
            <div class="col-3 m-3 shadow bg-black border rounded product-item">
                <a href='<?= BASE_DIR ?>/product/<?= $product->getProductId() ?>'>
                    <img src="<?= IMG_DIR . $product->getProductImageAddr() ?>" width="250px" height="250px">
                    <p><?= $product->getProductName() ?></p>
                    <p><?= $product->getProductPrice() ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>