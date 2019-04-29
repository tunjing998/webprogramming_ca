<div class="container">
    <h3>Product Details</h3>
    <form action='<?= BASE_DIR ?>/productedit/<?= $locals['product']->getProductId() ?>' method='post' enctype="multipart/form-data">
        <div class="form-group row">
            <input type='hidden' value=<?= $locals['product']->getProductId() ?>>
            <label class="col-sm-2 col-form-label" for="product_name">Product Name:</label>
            <input class="col-sm-3" value=<?= $locals['product']->getProductName() ?>><br>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="product_type">Product Type:</label>
            <input class="col-sm-3" value=<?= $locals['product']->getProductType() ?>><br>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="product_detail">Product Details:</label>
            <input class="col-sm-3" value=<?= $locals['product']->getProductDetail() ?>><br>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="product_price">Product Price:</label>
            <input class="col-sm-3" value=<?= $locals['product']->getProductPrice() ?>><br>
        </div>
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
</div>

<script src="<?= BASE_DIR ?>/assets/js/previewImage.js"></script>