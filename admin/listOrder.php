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
        <?php
        if (isset($delCat)) {
            echo $delCat;
        }
        ?>
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

    <!-- Form lọc -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lọc người dùng</h6>
        </div>
        <div class="card-body">
            <form method="get" action="">
                <!-- Dropdown tình trạng -->
                <div class="form-group">
                    <label for="status">Tình trạng:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">-- Chọn tình trạng --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <!-- Trường nhập ngày từ ngày -->
                <div class="form-group">
                    <label for="fromDate">Từ ngày:</label>
                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                </div>
                <!-- Trường nhập ngày đến ngày -->
                <div class="form-group">
                    <label for="toDate">Đến ngày:</label>
                    <input type="date" class="form-control" id="toDate" name="toDate">
                </div>
                <!-- Trường nhập địa điểm -->
                <div class="form-group">
                    <label for="deliveryLocation">Địa điểm giao hàng:</label>
                    <input type="text" class="form-control" id="deliveryLocation" name="deliveryLocation">
                </div>
                <!-- Nút lọc -->
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>
        </div>
    </div>
</div>

<?php
require('include/footer.php');
?>