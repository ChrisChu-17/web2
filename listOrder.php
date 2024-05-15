<?php
require('inc/header.php');
?>
<?php include 'classes/carts.php';  ?>
<?php include 'classes/loginUser.php';  ?>
<?php
$cart = new Cart();
$userId = Session::get('userId');
$showOrderHistory = $cart->showOrderDetailByUserId($userId);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- Header bảng -->
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiển</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kiểm tra nếu có dữ liệu lọc, hiển thị dữ liệu lọc
                    if ($showOrderHistory) {
                        $stt = 0;
                        while ($result = $showOrderHistory->fetch_assoc()) {
                            $stt++;
                    ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $result['product_name']; ?></td>
                                <td><?php echo $result['qty']; ?></td>
                                <td><?php echo $result['created_at']; ?></td>
                                <td><?php echo $result['total']; ?></td>
                                <td><?php echo $result['status']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        // Nếu không có dữ liệu lọc, hiển thị thông báo
                        echo "<tr><td colspan='6'>Không có đơn hàng nào được tìm thấy.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require('inc/footer.php');
?>
<?php
require('inc/script.php');
?>