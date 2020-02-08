<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';

    getProducts();
?>

<!-- Hero section -->
<section class="hero-section">
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="<?php url('assets/img/bg.jpg') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">
                        <span>New Arrivals</span>
                        <h2>Cosmetics</h2>
                        <p>Shop new cosmetic brands & products as soon as they come out! Whether you're a Pro Artist, Makeup Enthusiast or Beauty Lover, we've got something for you! </p>
                        <a href="#" class="site-btn sb-line">DISCOVER</a>
                        <a href="#" class="site-btn sb-white">ADD TO CART</a>
                    </div>
                </div>
                <div class="offer-card text-white">
                    <span style="padding-top: 10px;">from</span>
                    <h3 style="padding-top: 10px; padding-bottom: 10px;">Rs.999</h3>
                    <p>SHOP NOW</p>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="<?php url('assets/img/bg-2.jpg') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">
                        <h2>Immitation Jewellery</h2>
                        <p>HashTag brings you unique collection of jewellery made out of silver, including bridal collection, tops & earrings, necklaces, rings for girls. </p>
                        <a href="#" class="site-btn sb-line">DISCOVER</a>
                        <a href="#" class="site-btn sb-white">ADD TO CART</a>
                    </div>
                </div>
                <div class="offer-card text-white">
                    <span style="padding-top: 10px;">from</span>
                    <h3 style="padding-top: 10px; padding-bottom: 10px;">Rs.4999</h3>
                    <p>SHOP NOW</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="slide-num-holder" id="snh-1"></div>
    </div>
</section>
<!-- Hero section end -->





<!-- letest product section -->
<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>LATEST PRODUCTS</h2>
        </div>
        <div class="product-slider owl-carousel">
            <?php foreach($products as $product): ?>
                <div class="product-item">
                    <div class="pi-pic">
                        <!-- <div class="tag-sale">ON SALE</div> -->
                        <a href="<?php url('singleProduct.php?id='.$product['id']) ?>">
                            <img src="<?php url('assets/img/product/'.$product['image']) ?>" alt="">
                        </a>
                        <div class="pi-links">
                            <a href="<?php url('helpers/pages/addItem.php?id='.$product['id']) ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
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
            <?php endforeach ?>
            
        </div>
    </div>
</section>
<!-- letest product section end -->

<!-- Product filter section -->
<section class="product-filter-section">
    <div class="container">
        <div class="section-title">
            <h2>BROWSE TOP SELLING PRODUCTS</h2>
        </div>
        <ul class="product-filter-menu">
            <?php $i = 1 ?>
            <?php foreach($categories as $category): ?>
                <?php foreach($category['sub_cats'] as $sub_cat): ?>
                    <li>
                        <a href="<?php url('products.php') ?>" class="text-uppercase text-truncate text-center">
                            <?php echo $sub_cat['name'] ?>
                        </a>
                    </li>

                    <?php 
                        ++$i;

                        if($i >= 8) {
                            break;
                        }
                    ?>
                <?php endforeach ?>
            <?php endforeach ?>
        </ul>

        <div class="row">
            <?php foreach($products as $product): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <!-- <div class="tag-sale">ON SALE</div> -->
                            <a href="<?php url('singleProduct.php?id='.$product['id']) ?>">
                                <img src="<?php url('assets/img/product/'.$product['image']) ?>" alt="">
                            </a>
                            <div class="pi-links">
                                <a href="<?php url('helpers/pages/addItem.php?id='.$product['id']) ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
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
        <div class="text-center pt-5">
            <a href="<?php url('products.php') ?>" class="site-btn sb-line sb-dark">LOAD MORE</a>
        </div>
    </div>
</section>
<!-- Product filter section end -->


<!-- Banner section -->
<section class="banner-section" >
    <div class="container">
        <div class="banner set-bg" data-setbg="<?php url('assets/img/banner-bg.jpg') ?>" style="border-radius: 50px;">
            <div class="tag-new">NEW</div>
            <span>New Arrivals</span>
            <h2 style="padding-bottom: 0px">MAC Lipsticks</h2>
            <h6 style="padding-bottom: 20px">A superb range of lipsticks categorized with colors and finishes, MAC is a worldwide winner</h6>
            <a href="#" class="site-btn">SHOP NOW</a>
        </div>
    </div>
</section>
<!-- Banner section end  -->



<?php
    include './includes/footer.php';
?>