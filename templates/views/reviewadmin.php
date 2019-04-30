<div class="container">
    <h3>Review List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Review ID</th>
                <th>Product ID</th>
                <th>Client ID</th>
                <th>Review Title</th>
                <th>Review Suggest</th>
                <th>Last Modified Date</th>
                <th>Show</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($locals['reviews'] as $review) { ?>
                <tr class='bg-light'>
                    <td><?= $review->getReviewId() ?></td>
                    <td><?= $review->getProductId() ?></td>
                    <td><?= $review->getClientId() ?></td>
                    <td><?= $review->getReviewTitle() ?></td>
                    <td><?= $review->getSuggest() ?></td>
                    <td><?= $review->getLastModified() ?></td>
                    <td><a href='<?= BASE_DIR ?>/reviewedit/<?= $review->getProductId() ?>'>Show Details</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>