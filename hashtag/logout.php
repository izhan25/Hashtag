<?php
    include './config/config.php';
    include './helpers/functions.php';

    session_start();

    session_destroy();
?>

<script>
    window.location.href = '<?php echo url('index.php') ?>'
</script>