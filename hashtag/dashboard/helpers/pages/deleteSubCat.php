<?php
include '../../../config/config.php';
include '../dashboard_functions.php';

if (isset($_GET['id'])) {
    deleteSubCategory($_GET['id']);
}

?>

<script>
    window.location.href = '<?php url('dashboard/subCat.php') ?>';
</script>