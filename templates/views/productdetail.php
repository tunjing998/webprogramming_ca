<div class="container">
    <h3>Product Details</h3>
    <p><?= $locals['product']->getProductId() ?></p>
    <p><?= $locals['product']->getProductName() ?></p>
    <p><?= $locals['product']->getProductType() ?></p>
    <p><?= $locals['product']->getProductDetail() ?></p>
    <p><?= $locals['product']->getProductPrice() ?></p>
    <img src="<?= IMG_DIR . $locals['product']->getProductImageAddr() ?>" height="360px" width="360px">

    <h4>Other Reviews</h4>
    <?php foreach ($locals['review'] as $review) { ?>
        <div class="container">
            <h5><?=$review->getClientId()?></h5>
            <h5><?=$review->getReviewTitle()?></h5>
            <p><?=$review->getReviewTitle()?></p>
            <p><?=$review->getReviewText()?></p>
            <p><?=$review->getSuggest()?></p>
            <p><?=$review->getLastModified()?></p>
        </div>
    <?php } ?>
</div>