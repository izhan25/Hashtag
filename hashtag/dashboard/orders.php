<?php
include '../config/config.php';
include './helpers/dashboard_functions.php';
include './include/header.php';

$orders = getOrders();
$refresh = false;

if (isset($_GET['del']) && $_GET['del'] === 'yes' && isset($_GET['id'])) {
    deleteOrder($_GET['id']);
    $refresh = true;
}

?>

<?php if ($refresh) : ?>
    <script>
        window.location.href = '<?php url('dashboard/orders.php') ?>'
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
                            <li><a href="<?php url('dashboard/order.php') ?>">Orders</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content" style="margin-bottom: 400px;">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Orders</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Phone</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $key => $order) : ?>
                                    <tr style="height: 100px">
                                        <td><?php echo ++$key ?></td>
                                        <td> <span class="name"><?php echo $order['user']['name'] ?></span> </td>
                                        <td><?php echo $order['info']['total'] ?></td>
                                        <td><?php echo $order['user']['phone'] ?></td>
                                        <td class="mt-2">
                                            <a href="<?php url('dashboard/orderDetails.php?id=' . $order['info']['id']) ?>" class="badge badge-success ml-1 mr-3">Details</a>
                                            <a href="<?php url('dashboard/orders.php?del=yes&id=' . $order['info']['id']) ?>" class="btn btn-outline-danger btn-sm ml-1 mr-3">Delete</a>
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