<?php
    include '../../config/config.php';
    include '../../helpers/functions.php';

    // Increment cart item
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $qty = $_GET['qty'];

        getProduct($id); // gets a product and store in $product (global variable) in functions.php

        $cartItem = array(
            "product" => $product, 
            "qty" => $qty, 
            "cartItemPrice" => $product['price'] * $qty
        );

        incrementCartItem($cartItem);
    }

?>

<script>
    window.location.href = '<?php url('cart.php') ?>';
</script>