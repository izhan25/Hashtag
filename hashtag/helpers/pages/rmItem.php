<?php
    include '../../config/config.php';
    include '../../helpers/functions.php';

    // Remove cart item
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        getProduct($id); // gets a product and store in $product (global variable) in functions.php

        $cartItem = array(
            "product" => $product, 
            "qty" => 1, 
            "cartItemPrice" => 3500
        );

        removeItemFromCart($cartItem);
    }

?>

<script>
    window.location.href = '<?php url('cart.php') ?>';
</script>