<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$refresh = false;
$catInput = '';
$updating = false;
$categories = getCategories();

if (isset($_POST['submit'])  && !empty($_POST['name'])) {
    createCategory($_POST['name']);
    $refresh = true;
}

if (isset($_GET['id'])) {
    $catInput = getCategory($_GET['id'])['name'];
    $updating = true;
}

if (isset($_POST['update']) && !empty($_POST['name']) && $_POST['id'] > 2) {

    $updCat = array(
        'id' => $_POST['id'],
        'name' => $_POST['name']
    );

    updateCategory($updCat);
    $refresh = true;
}

?>

<?php if ($refresh) : ?>
    <script>
        window.location.href = '<?php url('dashboard/categories.php') ?>';
    </script>
<?php endif ?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php url('dashboard/index.php') ?>">Dashboard</a></li>
                            <li><a href="<?php url('dashboard/categories.php') ?>">Categories</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content" style="margin-bottom: 400px;">
    <div class="animated fadeIn">

        <div class="row mb-4">
            <div class="col-lg-10">
                <a href="<?php url('dashboard/categories.php') ?>" class="btn btn-success text-light">Main Categories</a>
                <a href="<?php url('dashboard/subCat.php') ?>" class="btn btn-outline-success">Sub Categories</a>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Main Category Form</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php url('dashboard/categories.php') ?>" class="form-inline">
                            <input name="name" type="text" value="<?php echo $catInput ?>" class="form-control col" placeholder="Name of new main category">
                            <?php if ($updating) : ?>
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                <a href="<?php url('dashboard/categories.php') ?>" class="btn btn-secondary ml-1">Cancel</a>
                                <button name="update" type="submit" class="btn btn-success ml-1">Update</button>
                            <?php else : ?>
                                <button name="submit" type="submit" class="btn btn-success ml-1">Submit</button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Main Categories</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $key => $category) : ?>
                                    <tr>
                                        <td class="serial"><?php echo ++$key ?></td>
                                        <td> <span class="name"><?php echo $category['name'] ?></span> </td>
                                        <td class="d-flex justify-content-center">
                                            <?php if ($category['id'] < 3) : ?>
                                                <div>(Default)</div>
                                            <?php else : ?>
                                                <a href="<?php url('dashboard/categories.php?id=' . $category['id']) ?>" class="badge badge-complete">Edit</a>
                                                <a href="<?php url('dashboard/helpers/pages/deleteCat.php?id=' . $category['id']) ?>" class="badge badge-danger ml-1">Delete</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->




<?php
include './include/footer.php';
?>