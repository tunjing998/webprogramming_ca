<?php foreach ($locals['products'] as $product) { ?>
    <a href='<?= BASE_DIR ?>/product/<?= $product->getProductId() ?>'>
        <div class="container">
            <p><?= $product->getProductName() ?></p>
            <p><?= $product->getProductType() ?></p>
            <p><?= $product->getProductDetail() ?></p>
            <p><?= $product->getProductPrice() ?></p>
            <img src="<?= IMG_DIR . $product->getProductImageAddr() ?>" height="560px">
        </div>
    </a>
<?php } ?>