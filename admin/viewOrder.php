<?php include '../classes/carts.php';  ?>
<?php
// gọi class category
$order = new Cart();

if (isset($_GET['id']) && (!empty($_GET['id']))) {
    $orderId  = $_GET['id'];
    $orderInfo = $order->showOrderById($orderId);

    if (isset($_POST['btnUpdate']) && ($_POST['btnUpdate'])) {
        $status = $_POST['status'];
        $updateOrder = $order->updateOrder($orderId, $status);
        if ($updateOrder) {
            header('Location: listBrands.php');
            exit;
        }
    }

    if ($orderInfo) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Order Detail</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <style>
                /* Add custom styles here if needed */
            </style>
        </head>

        <body>
            <div class="container">
                <!-- <h3>Danh sách thương hiệu</h3> -->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
                    </div>
                    <?php
                    if (isset($viewOrder)) {
                        echo $viewOrder;
                    }
                    ?>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Customer Information
                                </div>
                                <div class="card-body">
                                    <form action="viewOrder.php?id=<?= $orderId ?>" method="post">
                                        <ul class="list-group">
                                            <?php
                                            while ($row = $orderInfo->fetch_assoc()) {
                                            ?>
                                                <li class="list-group-item"><strong>Name:</strong> <?= $row['fullname'] ?></li>
                                                <li class="list-group-item"><strong>Email:</strong> <?= $row['email'] ?></li>
                                                <li class="list-group-item"><strong>Phone:</strong> <?= $row['phone'] ?></li>
                                                <li class="list-group-item"><strong>Address:</strong> <?= $row['address'] ?>, <?= $row['district'] ?>, <?= $row['city'] ?></li>
                                                <li class="list-group-item"><strong>Status:</strong>
                                                    <select class="form-select" id="statusSelect" name="status">
                                                        <option value="Processing" <?= ($row['status'] == 'Processing' ? 'selected' : '') ?>>Processing</option>';
                                                        <option value="Confirmed" <?= ($row['status'] == 'Confirmed' ? 'selected' : '') ?>>Confirmed</option>';
                                                        <option value="Shipping" <?= ($row['status'] == 'Shipping' ? 'selected' : '') ?>>Shipping</option>';
                                                        <option value="Delivered" <?= ($row['status'] == 'Delivered' ? 'selected' : '') ?>>Delivered</option>';
                                                        <option value="Cancelled" <?= ($row['status'] == 'Cancelled' ? 'selected' : '') ?>>Cancelled</option>';
                                                    </select>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <input type="submit" class="btn btn-primary mt-3" name="btnUpdate" value="Update">
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Order Details
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $orderDetail = $order->showOrderDetailByOrderId($orderId);
                                        if ($orderDetail) {
                                            $stt = 0;
                                            $total = 0;
                                            while ($row = $orderDetail->fetch_assoc()) {
                                                $stt++;
                                                $total += $row['qty'] * $row['oprice'];
                                        ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $stt ?></td>
                                                        <td><?= $row['pname'] ?></td>
                                                        <td><?= $row['qty'] ?></td>
                                                        <td>$<?= $row['oprice'] ?></td>
                                                        <td>$<?= $row['total'] ?></td>
                                                    </tr>
                                                </tbody>

                                        <?php
                                            }
                                        }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                                <td>$<?= $total ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </body>
<?php
    }
}
?>