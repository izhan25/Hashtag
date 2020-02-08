<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';

    $productId = $_GET['id'];
    

    if(isset($productId)){
        getProduct($productId);
    }

    // for related products
    getProducts();

    
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Category Page</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('products.php') ?>">Shop</a>
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- product section -->
<section class="product-section">
    <div class="container">
        <div class="back-link">
            <a href="<?php url('products.php') ?>"> &lt;&lt; Back to Category</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="product-pic-zoom-none">
                    <img class="product-big-img" src="<?php url('assets/img/product/'.$product['image']) ?>" alt="">
                </div>
            </div>
            <div class="col-lg-6 product-details">
                <h2 class="p-title">
                    <?php echo $product['name']; ?>
                </h2>
                <h3 class="p-price">
                    Rs.<?php echo $product['price'] ?>
                </h3>
                <h4 class="p-stock">Available: <span>In Stock</span></h4>
                <div class="p-rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o fa-fade"></i>
                </div>
               
               <form method="post" action="<?php url('cart.php') ?>">
                    <input 
                        type="hidden" 
                        name="productId" 
                        value="<?php echo $productId ?>"
                    >
                    <div class="quantity">
                        <p>Quantity</p>
                        <div class="pro-qty">
                            <input
                                name="qty" 
                                type="text" 
                                value="1">
                        </div>
                    </div>
                    <input
                        name="submit" 
                        type="submit" 
                        value="SHOP NOW" 
                        class="site-btn" />
               </form>
                <div id="accordion" class="accordion-area">
                    <div class="panel">
                        <div class="panel-header" id="headingOne">
                            <button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <p>
                                    <?php echo $product['information'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-header" id="headingTwo">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="panel-body">
                                <p>At Hashtag, we take the business of beauty very seriously. The company was founded with the purpose of creating high quality cosmetics with an affordable price tag, but without ever compromising on ingredients or ethics.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-header" id="headingThree">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
                        </div>
                        <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="panel-body">
                                <h4>7 Days Returns</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-sharing">
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->



<?php 
    include './includes/footer.php';
?>