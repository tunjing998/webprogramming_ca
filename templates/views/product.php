<div class="wrapper text-center">
    <!-- Sidebar -->
    <nav id="sidebar" class="border-1">
        <div>
            <p class="h5 bg-grey">Categories</p>
            <ul class="list-unstyled" id="pageSubmenu">
                <li>
                    <p class="dropdown-item m-0" id='type4'>All</p>
                </li>
                <li>
                    <p class="dropdown-item m-0" id='type1'>Cloth</p>
                </li>
                <li>
                    <p class="dropdown-item m-0" id='type2'>Earring</p>
                </li>
                <li>
                    <p class="dropdown-item m-0" id='type3'>Lens</p>
                </li>
            </ul>
        </div>
        <div>
            <p class="h5 bg-grey">Prices</p>
            <ul class="list-unstyled" id="pageSubmenu">
                <li>
                    Minimum
                    <input type="range" id='priceInputMin' name="min" min="0" max="1000" value="0">
                    <br>
                    <span id='priceMin'>0</span>
                </li>
                <li>
                    Maximum
                    <input type="range" id='priceInputMax' name="max" min="0" max="1000" value='1000'>
                    <br>
                    <span id='priceMax'>1000</span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-2">
        <div class="row d-flex justify-content-center" id='products'>
            <?php if (sizeof($locals['products']) != 0) { ?>
                <?php foreach ($locals['products'] as $product) { ?>
                    <div class="col-3 m-3 shadow bg-black border rounded product-item">
                        <img src="<?= IMG_DIR . $product->getProductImageAddr() ?>" width="250px" height="250px">
                        <p>Name : <?= $product->getProductName() ?></p>
                        <p>Price : <?= $product->getProductPrice() ?></p>
                        <a href='<?= BASE_DIR ?>/product/<?= $product->getProductId() ?>'>More Details </a>
                        <input type="hidden" id='product-name<?= $product->getProductId() ?>' value='<?= $product->getProductName() ?>'>
                        <input type="hidden" id='product-price<?= $product->getProductId() ?>' value='<?= $product->getProductPrice() ?>'>
                        <button class='item' value='<?= $product->getProductId() ?>'>Add to Cart</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div class='container col-6'>
            <p>No Result Found</p>
        </div>
    <?php } ?>
</div>
</div>
<script src="<?= BASE_DIR ?>/assets/js/filter.js"></script>