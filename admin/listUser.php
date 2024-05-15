<?php
require('include/header.php');
?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/loginUser.php';  ?>
<?php
// gọi class category
$user = new LoginUser();
if (!isset($_GET['block']) || $_GET['block'] == NULL) {
    // echo "<script> window.location = 'catlist.php' </script>";
} else {
    $userId = $_GET['block']; 
    $blockUser = $user->toggleUserStatus($userId); 
}
?>
<div>
    <!-- <h3>Danh sách thương hiệu</h3> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>
                    <?php
                    $listUser = $user->showListUser();
                    if ($listUser) {
                        while ($result = $listUser->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $result['status']; ?></td>
                                <td>
                                <a href="?block=<?php echo $result['id']; ?>" class="btn btn-<?php echo $result['status'] == 'Active' ? 'danger' : 'success'; ?>" onclick="return confirm('Bạn có muốn <?php echo $result['status'] == 'Active' ? 'khoá' : 'mở khóa'; ?> <?php echo $result['name'] ?> ?');"><?php echo $result['status'] == 'Active' ? 'Block' : 'Unblock'; ?></a>
                                    <a href="updateUser.php?id=<?= $result['id']; ?>" class="btn btn-warning">Edit</a>
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