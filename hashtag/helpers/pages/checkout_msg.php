<?php
include '../../config/config.php';
include '../../helpers/functions.php';
include '../../includes/header.php';

$showMsg = false;

if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'success') {
        $showMsg = true;
    }
}
?>

<?php if (!$showMsg) : ?>
    <script>
        window.location.href = '<?php url('checkout.php') ?>';
    </script>
<?php endif ?>

<?php if ($showMsg) : ?>

    <section class="container">
        <div class="card ml-5 mr-5 mt-5 mb-5">
            <div class="card-header text-center">
                <h3>Order Placed</h3>
            </div>
            <div class="card-body text-center" style="font-size: 20px;">
                Your order has been placed our representative will shortly call you for order confirmation.
            </div>
        </div>
    </section>

<?php endif ?>

<?php
include '../../includes/footer.php';
?>