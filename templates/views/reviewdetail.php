<div class="container">
    <h3>Review Details</h3>
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