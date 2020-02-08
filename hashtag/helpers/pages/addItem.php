<?php
    include '../../config/config.php';
    include '../../helpers/functions.php';

    // Increment cart item
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $qty = 1;

        addToCart($id, $qty);
    }

?>

<script>
    window.location.href = '<?php url('cart.php') ?>';
</script>