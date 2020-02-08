<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$categories = getCategories();



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
                            <li><a href="<?php url('dashboard/addProd.php') ?>">Add New Products</a></li>
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
                <a href="<?php url('dashboard/addProd.php') ?>" class="btn btn-success text-light">Add Product</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php
                if (isset($_POST['submit']) && isset($_FILES['image'])) {
                    $prod = array(
                        "catId" => $_POST['catId'],
                        "subCatId" => $_POST['subCatId'],
                        "name" => $_POST['name'],
                        "price" => $_POST['price'],
                        "info" => $_POST['info'],
                        "image" => $_FILES['image']['name']
                    );

                    addProductAndImage($prod, $_FILES);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Product Form</strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php url('dashboard/addProd.php') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Main Category</label>
                                        <select name="catId" class="form-control" onchange="fetchSubCats(this)">
                                            <option selected>Choose..</option>
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
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input name="price" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Information</label>
                                <textarea name="info" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control">
                            </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-success float-right">
                        </form>
                    </div>
                </div>
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