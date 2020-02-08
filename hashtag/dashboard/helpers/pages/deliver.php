<?php
include '../../../config/config.php';
include '../dashboard_functions.php';

if (isset($_GET['id'])) {
    deliverOrder($_GET['id']);
}
?>

<script>
    window.location.href = '<?php url('dashboard/orderDetails.php?id=' . $_GET['id']) ?>'
</script>