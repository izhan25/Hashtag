<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$products = getProducts();
$refresh = false;

if (isset($_GET['del_id'])) {
    deleteProduct($_GET['del_id']);
    $refresh = true;
}

?>

<?php if ($refresh) : ?>
    <script>
        window.location.href = '<?php url('dashboard/products.php') ?>';
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
                            <li><a href="<?php url('dashboard/products.php') ?>">Products</a></li>
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
                <a href="<?php url('dashboard/products.php') ?>" class="btn btn-success text-light">Products</a>
                <a href="<?php url('dashboard/addProd.php') ?>" class="btn btn-outline-success">Add Product</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Products</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="serial">#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Information</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $key => $product) : ?>
                                    <tr style="height: 100px">
                                        <td>
                                            <img src="<?php url('assets/img/product/' . $product['image']) ?>" class="img-fluid">
                                        </td>
                                        <td class="serial"><?php echo ++$key ?></td>
                                        <td> <span class="name"><?php echo $product['name'] ?></span> </td>
                                        <td>Rs.<?php echo $product['price'] ?></td>
                                        <td><?php echo getCategory($product['catId'])['name'] ?></td>
                                        <td><?php echo getSubCat($product['subCatId'])['name'] ?></td>
                                        <td>
                                            <div class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo $product['information'] ?></div>
                                        </td>
                                        <td class="mt-2">
                                            <a href="<?php url('dashboard/editProd.php?edit_id=' . $product['id']) ?>" class="badge badge-complete">Edit</a>
                                            <a href="<?php url('dashboard/products.php?del_id=' . $product['id']) ?>" class="badge badge-danger ml-1 mr-3">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>



                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>

    </div>
</div>


<?php
include './include/footer.php';
?>