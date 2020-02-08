<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';

    // $submit = $_POST['submit'];
    
    if(isset($_POST['submit'])) {
        $qty = $_POST['qty'];
        $productId = $_POST['productId'];

        addToCart($productId, $qty);
    }


    $cart = array();
    $cartTotal = 0;

    if(!cartIsEmpty()) {
        $cart = getCart();
        $cartTotal = getCartTotal();
    }

?>



<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Your cart</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('cart.php') ?>">Your cart</a>
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    <div class="cart-table-warp">
                        <table>
                        <thead>
                            <tr>
                                <th class="product-th">Product</th>
                                <th class="quy-th">Quantity</th>
                                <th class="total-th">Price</th>
                                <th class="total-th">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart as $item): ?>
                                <tr>
                                    <td class="product-col">
                                        <img src="<?php url('assets/img/product/'.$item['product']['image']) ?>" alt="">
                                        <div class="pc-title">
                                            <h4><?php echo $item['product']['name'] ?></h4>
                                            <p><?php echo $item['product']['price'] ?></p>
                                        </div>
                                    </td>
                                    <td class="quy-col">
                                        <div class="quantity">
                                            <div>
                                                <a href="<?php url('helpers/pages/decItem.php?id='.$item['product']['id'].'&qty='.$item['qty']) ?>" style="font-size: 30px">-</a>
                                                <input 
                                                    disabled
                                                    type="text" 
                                                    value="<?php echo $item['qty'] ?>"
                                                    min="1"
                                                    max="5"
                                                    style="width: 50px; border-radius: 20px; border: none; background-color: white; padding: 10px; text-align: center"
                                                />
                                                <a href="<?php url('helpers/pages/incItem.php?id='.$item['product']['id'].'&qty='.$item['qty']) ?>" style="font-size: 30px">+</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-col"><h4><?php echo $item['product']['price'] * $item['qty'] ?></h4></td>
                                    <td>
                                        <a href="<?php url('helpers/pages/rmItem.php?id='.$item['product']['id']) ?>" class="ml-1">
                                            <small>Remove</small>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                           
                        </tbody>
                    </table>
                    </div>
                    <div class="total-cost">
                        <h6>Total <span>Rs<?php echo $cartTotal ?></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <form class="promo-code-form">
                    <input type="text" placeholder="Enter promo code">
                    <button>Submit</button>
                </form>
                <a href="<?php url('checkout.php') ?>" class="site-btn">Proceed to checkout</a>
                <a href="<?php url('products.php') ?>" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->



<?php 
    include './includes/footer.php';
?>