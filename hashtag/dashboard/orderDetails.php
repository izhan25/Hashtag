<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';


$order = array();

if (isset($_GET['id'])) {
    $order = getOrder($_GET['id']);
}

?>

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
                            <li><a href="<?php url('dashboard/order.php') ?>">Orders</a></li>
                            <li><a href="<?php url('dashboard/orderDetails.php') ?>">Details</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content" style="margin-bottom: 400px;">
    <div class="animated fadeIn">

        <div class="row mb-2">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col">
                        <a href="<?php url('dashboard/orders.php') ?>" class="text-success">
                            <i class="fa  fa-arrow-circle-left mr-1"></i>Back To Orders
                        </a>
                    </div>
                    <div class="col">
                        <?php if ($order['info']['dispatched'] === 'yes') : ?>

                            <?php if ($order['info']['delivered'] === 'yes') : ?>
                                <a href="<?php url('dashboard/helpers/pages/undeliver.php?id=' . $order['info']['id']) ?>" class="btn btn-warning float-right">
                                    Cancel Delivery
                                </a>
                            <?php else : ?>
                                <a href="<?php url('dashboard/helpers/pages/undispatch.php?id=' . $order['info']['id']) ?>" class="btn btn-warning float-right ml-2">
                                    Cancel Dispatch
                                </a>
                                <a href="<?php url('dashboard/helpers/pages/deliver.php?id=' . $order['info']['id']) ?>" class="btn btn-success float-right">
                                    Delivered
                                </a>
                            <?php endif ?>
                        <?php else : ?>
                            <a href="<?php url('dashboard/helpers/pages/dispatch.php?id=' . $order['info']['id']) ?>" class="btn btn-success float-right">
                                Dispatch
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Customer</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <span class="name"><?php echo $order['user']['name'] ?></span> </td>
                                    <td><?php echo $order['user']['email'] ?></td>
                                    <td><?php echo $order['user']['phone'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Delivery Information</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <span class="name"><?php echo $order['info']['name'] ?></span> </td>
                                    <td><?php echo $order['info']['email'] ?></td>
                                    <td><?php echo $order['info']['phone'] ?></td>
                                    <td><?php echo $order['info']['address'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ordered Products</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['products'] as $prod) : ?>
                                    <tr style="height: 100px">
                                        <td>
                                            <img src="<?php url('assets/img/product/' . $prod['prod']['image']) ?>" class="img-fluid" alt="">
                                        </td>
                                        <td> <span class="name"><?php echo $prod['prod']['name'] ?></span> </td>
                                        <td><?php echo $prod['info']['qty'] ?></td>
                                        <td>Rs.<?php echo $prod['info']['price'] ?></td>
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