<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$catInput = "";
$updating = false;
$refresh = false;
$subCat = null;
$cats = getCategories();
$subCats = getSubCats();


if (isset($_POST['submit'])  && !empty($_POST['name'])) {
    $subCat = array(
        'name' => $_POST['name'],
        'parentId' => $_POST['parent']
    );

    createSubCat($subCat);
    $refresh = true;
}

if (isset($_GET['id'])) {
    $subCat = getSubCat($_GET['id']);
    $catInput = $subCat['name'];
    $updating = true;
}

if (isset($_POST['update']) && !empty($_POST['name'])) {
    $updSubCat = array(
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'parentId' => $_POST['parent']
    );

    updateSubCategory($updSubCat);
    $refresh = true;
}

function option($cat)
{
    global $subCat;

    if ($cat['id'] === $subCat['parentId']) {
        echo '<option selected value="' . $cat['id'] . '" class="text-capitalize">' . $cat['name'] . '</option>';
        return;
    }

    echo '<option value="' . $cat['id'] . '" class="text-capitalize">' . $cat['name'] . '</option>';
    return;
}

?>

<?php if ($refresh) : ?>
    <script>
        window.location.href = '<?php url('dashboard/subCat.php') ?>';
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
                            <li><a href="<?php url('dashboard/subCat.php') ?>">Sub Categories</a></li>
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
                <a href="<?php url('dashboard/categories.php') ?>" class="btn btn-outline-success">Main Categories</a>
                <a href="<?php url('dashboard/subCat.php') ?>" class="btn btn-success text-light">Sub Categories</a>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Sub Category Form</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php url('dashboard/subCat.php') ?>" class="form-inline">
                            <input name="name" value="<?php echo $catInput ?>" type="text" class="form-control col" id="name" placeholder="Name of new sub category">

                            <?php if ($updating) : ?>
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                <select name="parent" class="form-control col ml-1 text-capitalize">
                                    <?php foreach ($cats as $cat) : ?>
                                        <?php option($cat) ?>
                                    <?php endforeach ?>
                                </select>
                                <a href="<?php url('dashboard/subCat.php') ?>" class="btn btn-secondary ml-1">Cancel</a>
                                <input name="update" type="submit" value="Submit" class="btn btn-success  ml-1">
                            <?php else : ?>
                                <select name="parent" class="form-control col ml-1 text-capitalize">
                                    <?php foreach ($cats as $cat) : ?>
                                        <option value="<?php echo $cat['id'] ?>" class="text-capitalize"><?php echo $cat['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input name="submit" type="submit" value="Submit" class="btn btn-success  ml-1">
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
                        <strong class="card-title">Sub Categories</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subCats as $key => $cat) : ?>
                                    <tr>
                                        <td class="serial"><?php echo ++$key ?></td>
                                        <td> <span class="name"><?php echo $cat['subCat']['name'] ?></span> </td>
                                        <td><?php echo $cat['parent']['name'] ?></td>
                                        <td class="d-flex justify-content-center">
                                            <a href="<?php url('dashboard/subCat.php?id=' . $cat['subCat']['id']) ?>" class="badge badge-complete">Edit</a>
                                            <a href="<?php url('dashboard/helpers/pages/deleteSubCat.php?id=' . $cat['subCat']['id']) ?>" class="badge badge-danger ml-1">Delete</a>
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