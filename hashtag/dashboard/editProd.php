<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$categories = getCategories();

if (isset($_GET['edit_id'])) {
    $product = getProduct($_GET['edit_id']);
}



?>



<?php foreach ($categories as $cat) : ?>
    <?php $subCats = getSubCatsFromCat($cat['id']);  ?>
    <select id="parent-<?php echo $cat['id'] ?>" class="form-control" hidden>
        <?php foreach ($subCats as $subCat) : ?>
            <option value="<?php echo $subCat['id'] ?>">
                <?php echo $subCat['name'] ?>
            </option>
        <?php endforeach ?>
    </select>
<?php endforeach ?>



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
                            <li><a href="<?php url('dashboard/editProd.php') ?>">Edit Products</a></li>
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
                <a href="<?php url('dashboard/products.php') ?>" class="btn btn-outline-success ">Products</a>
                <a href="<?php url('dashboard/editProd.php') ?>" class="btn btn-success text-light">Edit Product</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php

                $redirect = false;
                if (isset($_POST['submit'])) {
                    $prod = array(
                        "id" => $_POST['id'],
                        "catId" => getProduct($_POST['id'])['catId'],
                        "subCatId" => getProduct($_POST['id'])['catId'],
                        "name" => $_POST['name'],
                        "price" => $_POST['price'],
                        "info" => $_POST['info'],
                        "image" => isset($_FILES['image']) && $_FILES['image']['name'] !== ''  ? $_FILES['image']['name'] : getProduct($_POST['id'])['image']
                    );

                    updateProduct($prod);
                    $redirect = true;
                }

                if (isset($_POST['updCat'])) {
                    $prod = array(
                        "id" => $_POST['id'],
                        "catId" => $_POST['catId'],
                        "subCatId" => $_POST['subCatId'],
                        "name" => getProduct($_POST['id'])['name'],
                        "price" => getProduct($_POST['id'])['price'],
                        "info" => getProduct($_POST['id'])['information'],
                        "image" => getProduct($_POST['id'])['image']
                    );

                    updateProduct($prod);
                    $redirect = true;
                }
                ?>
                <?php if ($redirect) : ?>
                    <script>
                        window.location.href = '<?php url('dashboard/products.php') ?>';
                    </script>
                <?php endif ?>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Product Form</strong>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['updCat'])) : ?>
                            <form method="post" action="<?php url('dashboard/editProd.php') ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit_id'] ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Main Category</label>
                                            <select name="catId" class="form-control" onchange="fetchSubCats(this)">
                                                <?php foreach ($categories as $cat) : ?>
                                                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <select name="subCatId" id="dropdown" class="form-control">
                                                <option selected value="0">Choose...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" name="updCat" value="Submit" class="btn btn-success btn-sm float-right ml-1">
                                    <a href="<?php url('dashboard/editProd.php?edit_id=' . $_GET['edit_id']) ?>" class="btn btn-warning btn-sm float-right ml-1">Cancel</a>
                                </div>
                            </form>
                        <?php else : ?>
                            <form method="post" action="<?php url('dashboard/editProd.php') ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit_id'] ?>">
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Main Category</label>
                                            <br>
                                            <label class="text-capitalize">
                                                <?php echo getCategory($product['catId'])['name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Sub Category</label>
                                            <br>
                                            <label class="text-capitalize">
                                                <?php echo getSubCat($product['catId'])['name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="<?php url('dashboard/editProd.php?edit_id=' . $_GET['edit_id'] . '&updCat=true') ?>" class="btn btn-success btn-sm float-right mt-3">Change</a>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" value="<?php echo $product['name'] ?>" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input name="price" value="<?php echo $product['price'] ?>" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Information</label>
                                    <textarea name="info" class="form-control" cols="30" rows="5"> <?php echo $product['information'] ?></textarea>
                                </div>

                                <input type="submit" name="submit" value="Submit" class="btn btn-success float-right">
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <?php if (!isset($_GET['updCat'])) : ?>
                    <img src="<?php url('assets/img/product/' . $product['image']) ?>" class="img-fluid ml-3" />
                    <a href="<?php url('dashboard/editProd.php?edit_id=' . $_GET['edit_id'] . 'updImg=true') ?>" class="btn btn-success float-right mt-1 btn-sm">Change</a>
                <?php endif ?>
            </div>
        </div>

    </div>
</div>


<script>
    function fetchSubCats(el) {
        let parentId = el.value;

        let select = document.querySelector('#parent-' + parentId);
        let dropdown = document.querySelector('#dropdown');


        dropdown.innerHTML = select.innerHTML;

    }
</script>


<?php
include './include/footer.php';
?>