<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';

session_start();
session_destroy();


?>

<script>
    window.location.href = '<?php echo url('dashboard/login.php') ?>'
</script>