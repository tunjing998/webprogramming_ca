<div class="container">
    <h3>Product Details</h3>
    <form action='<?= BASE_DIR ?>/productedit/<?= $locals['product']->getProductId() ?>' method='post' enctype="multipart/form-data">
        <input type='hidden' value=<?= $locals['product']->getProductId() ?>>
        <label for="product_name">Product Name:</label>
        <input value=<?= $locals['product']->getProductName() ?>><br>
        <label for="product_type">Product Type:</label>
        <input value=<?= $locals['product']->getProductType() ?>><br>
        <label for="product_detail">Product Details:</label>
        <input value=<?= $locals['product']->getProductDetail() ?>><br>
        <label for="product_price">Product Price:</label>
        <input value=<?= $locals['product']->getProductPrice() ?>><br>
        <img id='image' src="<?= IMG_DIR . $locals['product']->getProductImageAddr() ?>" height="360px" width="360px">
        <input type='file' name='image' id='files'>
        <input type="submit" value='Submit'>
    </form>
    <h4>Other Reviews</h4>
    <?php foreach ($locals['review'] as $review) { ?>
        <div class="container">
            <h5><?= $review->getClientId() ?></h5>
            <h5><?= $review->getReviewTitle() ?></h5>
            <p><?= $review->getReviewTitle() ?></p>
            <p><?= $review->getReviewText() ?></p>
            <p><?= $review->getSuggest() ?></p>
            <p><?= $review->getLastModified() ?></p>
        </div>
    <?php } ?>
</div>

<script src="<?=BASE_DIR?>/assets/js/previewImage.js"></script>