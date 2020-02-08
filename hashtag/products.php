<?php
include './config/config.php';
include './helpers/functions.php';
include './includes/header.php';

getProducts();

if (isset($_POST['searchBtn'])) {
    $query = $_POST['query'];

    searchProducts($query);
}

if (isset($_GET['cat'])) {
    getProductsFromCat($_GET['cat']);
}

?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Products</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('cosmetics.php') ?>">Products</a> /
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- Category section -->
<section class="category-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <?php foreach ($categories as $category) : ?>
                    <div class="filter-widget">
                        <h2 class="fw-title">
                            <?php echo $category['parent']['name']; ?>
                        </h2>
                        <ul class="category-menu">
                            <?php foreach ($category['sub_cats'] as $sub_cat) : ?>
                                <li>
                                    <a href="<?php url('products.php?cat=' . $category['parent']['id']) ?>" class="text-capitalize">
                                        <?php echo $sub_cat['name'] ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endforeach ?>



            </div>

            <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row">

                    <?php foreach ($products as $product) : ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <!-- <div class="tag-sale">ON SALE</div> -->
                                    <a href="<?php url('singleProduct.php?id=' . $product['id']) ?>">
                                        <img src="<?php url('assets/img/product/' . $product['image']) ?>" alt="">
                                    </a>
                                    <div class="pi-links">
                                        <a href="<?php url('helpers/pages/addItem.php?id=' . $product['id']) ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>
                                        <?php echo $product['price'] ?>
                                    </h6>
                                    <p>
                                        <?php echo $product['name'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category section end -->


<?php
include './includes/footer.php';
?>