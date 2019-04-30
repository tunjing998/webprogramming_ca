<div class="container text-center">
    <h3>Product Details</h3>
    <p class="mb-1">ID      :<?= $locals['product']->getProductId() ?></p>
    <p class="mb-1">Name    :<?= $locals['product']->getProductName() ?></p>
    <p class="mb-1">Type    :<?= $locals['product']->getProductType() ?></p>
    <p class="mb-1">Details :<?= $locals['product']->getProductDetail() ?></p>
    <p class="mb-1">Price   :<?= $locals['product']->getProductPrice() ?></p>
    <img src="<?= IMG_DIR . $locals['product']->getProductImageAddr() ?>" height="360px" width="360px">

    <p><a href='<?= BASE_DIR ?>/reviewedit/<?=$locals['product']->getProductId() ?>'>Write A Review</a></p>
    <br>
    <h4>Other Reviews</h4>
    <?php foreach ($locals['review'] as $review) { ?>
        <div class="container">
            <p>Client ID          : <?=$review->getClientId()?></p>
            <p>Title              : <?=$review->getReviewTitle()?></p>
            <p>Content            : <?=$review->getReviewText()?></p>
            <p>Rating             : <?=$review->getSuggest()?></p>
            <p>Last Modified Date : <?=$review->getLastModified()?></p>
        </div>
    <?php } ?>
</div>