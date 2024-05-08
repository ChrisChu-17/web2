<?php
require('include/header.php');
?>
<?php include '../classes/carts.php';  ?>
<?php
// gọi class category
$cart = new Cart();
$showCart = $cart->showOrder();
?>
<div>
    <!-- <h3>Danh sách thương hiệu</h3> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thể loại</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Order Id</th>
                            <th>Username</th>
                            <th>orderdate</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Order Id</th>
                            <th>Username</th>
                            <th>orderdate</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if ($showCart) {
                            $stt = 0;
                            while ($result = $showCart->fetch_assoc()) {
                                $stt++;
                        ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $result['id']; ?></td>
                                    <td><?php echo $result['fullname']; ?></td>
                                    <td><?php echo $result['created_at']; ?></td>
                                    <td><?php echo $result['status']; ?></td>
                                    <td><a href="?delete=<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa brand này?');">Delete</a>
                                        <a href="viewOrder.php?id=<?php echo $result['id'];?>" class="btn btn-warning">View</a>
                                    </td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
