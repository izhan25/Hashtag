<?php
include './config/config.php';
include './helpers/functions.php';
include './includes/header.php';


// for cart
$cart = array();
$cartTotal = 0;

if (!cartIsEmpty()) {
    $cart = getCart();
    $cartTotal = getCartTotal();
}

// for placing order
if (isset($_POST['submit'])) {
    $order = array(
        'name'       =>   $_POST['name'],
        'address'    =>   $_POST['address'],
        'email'      =>   $_POST['email'],
        'phone'      =>   $_POST['phone'],
        'userId'     =>   $_SESSION['user']['id'],
        'total'  =>   $cartTotal,
    );

    placeOrder($order);
}
?>

<?php if ($msg === 'Order is Placed') : ?>
    <script>
        window.location.href = '<?php url('helpers/pages/checkout_msg.php?msg=success') ?>';
    </script>
<?php endif ?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Checkout</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('cart.php') ?>">Your cart</a>
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- checkout section  -->
<section class="checkout-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 order-2 order-lg-1">
                <?php if ($isError) : ?>
                    <div class="alert alert-danger">
                        <?php echo $msg ?>
                    </div>
                <?php endif ?>
                <form method="post" action="<?php url('checkout.php') ?>" class="checkout-form">
                    <div class="cf-title">Information</div>

                    <input type="text" name="name" placeholder="The name of person who will receive order" required maxlength="20" minlength="5">

                    <input type="text" name="address" placeholder="Delivery address" required>
                    <input type="text" name="email" placeholder="E-mail for order verification" required>


                    <input type="text" name="phone" placeholder="Cell number for order verification" required>


                    <ul class="payment-list">
                        <li class="text-center">Pay when you get the package</li>
                    </ul>

                    <?php if (userLoggedIn()) : ?>
                        <input type="submit" name="submit" value="Place Order" class="site-btn submit-order-btn">
                    <?php else : ?>
                        <div class="site-btn submit-order-btn" style="background-color: gray; color: white">Place Order</div>
                        <p class="text-danger text-center">
                            You need to login to place the order.
                            <span class="text-mute text-center">
                                You can login by clicking <a href="<?php url('login.php') ?>" style="color: #f51167">Here</a>
                            </span>
                        </p>
                    <?php endif ?>
                </form>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Your Cart</h3>
                    <ul class="product-list">
                        <?php foreach ($cart as $item) : ?>
                            <li>
                                <div class="pl-thumb"><img src="<?php url('assets/img/product/' . $item['product']['image']) ?>" alt=""></div>
                                <h6><?php echo $item['product']['name'] ?></h6>
                                <p><?php echo $item['cartItemPrice'] ?></p>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <ul class="price-list">
                        <li>Total<span>Rs<?php echo $cartTotal ?></span></li>
                        <li>Shipping<span>free</span></li>
                        <li class="total">Total<span><?php echo $cartTotal ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout section end -->




<?php
include './includes/footer.php';
?>