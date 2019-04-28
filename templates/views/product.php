<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Search Filter</h3>
        </div>

        <ul class="list-unstyled components filter">
            <li class="active">
                <a href="#" class="dropdown-toggle">Categories</a>
                <ul class="list-unstyled" id="homeSubmenu">
                    <li>
                        <a id='type1' href="#">Cloth</a>
                    </li>
                    <li>
                        <a id='type2' href="#">Earring</a>
                    </li>
                    <li>
                        <a id='type3' href="#">Lens</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="dropdown-toggle">Prices</a>
                <ul class="list-unstyled" id="pageSubmenu">
                    <li>
                        Minimum
                        <input type="range" id='priceInputMin' name="min" min="0" max="1000" value="0">
                        Value : <span id='priceMin'>0</span>
                    </li>
                    <li>
                        Maximum
                        <input type="range" id='priceInputMax' name="max" min="0" max="1000" value='1000'>
                        Value : <span id='priceMax'>1000</span>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <div class="container" id='products'>
        <?php if (sizeof($locals['products']) != 0) { ?>
            <?php foreach ($locals['products'] as $product) { ?>
                <a href='<?= BASE_DIR ?>/product/<?= $product->getProductId() ?>'>
                    <div class='container col-6'>
                        <img src="<?= IMG_DIR . $product->getProductImageAddr() ?>" height="360px" width="360px">
                        <p><?= $product->getProductName() ?></p>
                        <p><?= $product->getProductPrice() ?></p>
                    </div>
                </a>
            <?php }
    } else { ?>
            <div class='conta iner col-6'>
                <p>No Result Found</p>
            </div>
        <?php } ?>
    </div>
</div>
<script src="<?= BASE_DIR ?>/assets/js/filter.js"></script>