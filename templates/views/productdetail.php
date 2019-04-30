<div class="container text-center">
    <h3>Product Details</h3>
    <p class="mb-1">ID      :<?= $locals['product']->getProductId() ?></p>
    <p class="mb-1">Name    :<?= $locals['product']->getProductName() ?></p>
    <p class="mb-1">Type    :<?= $locals['product']->getProductType() ?></p>
    <p class="mb-1">Details :<?= $locals['product']->getProductDetail() ?></p>
    <p class="mb-1">Price   :<?= $locals['product']->getProductPrice() ?></p>
    <img src="<?= IMG_DIR . $locals['product']->getProductImageAddr() ?>" height="360px" width="360px">

    <h5>Write A Review</h5>
    <br>
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