<div class="container mt-2">
    <div class="row d-flex justify-content-center">
        <?php foreach ($locals['products'] as $product) { ?>
            <div class="col-3 m-3 shadow bg-black border rounded product-item">
                    <img src="<?= IMG_DIR . $product->getProductImageAddr() ?>" width="250px" height="250px">
                    <p>Name  : <?= $product->getProductName() ?></p>
                    <p>Price :<?= $product->getProductPrice() ?></p>
                    <a href='<?= BASE_DIR ?>/product/<?= $product->getProductId() ?>'>More Details </a>
            </div>
        <?php } ?>
    </div>
</div>