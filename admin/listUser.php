<?php
require('include/header.php');
?>
<?php include '../classes/brand.php';  ?>
<?php
// gọi class category
$brand = new Brand();
if (!isset($_GET['delete']) || $_GET['delete'] == NULL) {
    // echo "<script> window.location = 'catlist.php' </script>";
} else {
    $id = $_GET['delete']; // Lấy catid trên host
    $deleteBrand = $brand->deleteBrand($id); // hàm check delete Name khi submit lên
}
?>
<div>
    <!-- <h3>Danh sách thương hiệu</h3> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
        </div>
        <?php
        if (isset($deleteBrand)) {
            echo $deleteBrand;
        }
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Brand</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $showBrand = $brand->showBrand();
                        if ($showBrand) {
                            while ($result = $showBrand->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['name']; ?></td>
                                    <td><?php echo $result['slug']; ?></td>
                                    <td><?php echo $result['status']; ?></td>
                                    <td><a href="?delete=<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa <?php echo $result['name']?> ?');">Delete</a>
                                        <a href="updateBrand.php?brandId=<?php echo $result['id']; ?>" class="btn btn-warning">Edit</a>
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

<?php
require('include/footer.php');
?>