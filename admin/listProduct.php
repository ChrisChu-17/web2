<?php
require('include/header.php');

function imgProcess($arrstr, $height)
{
  //arrstr la mang chua cac hinh anh vd anh1, anh2, anh3...
  $arr = explode(";", $arrstr);
  return "<img src='$arr[0]' height = '$height'/>";
}
?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$product = new product();
$fm = new Format();
if (!isset($_GET['delete']) || $_GET['delete'] == NULL) {
  // echo "<script> window.location = 'catlist.php' </script>";

} else {
  $id = $_GET['delete']; // Lấy catid trên host
  $deleteProduct = $product->deleteProduct($id); // hàm check delete Name khi submit lên
}
?>
<div>
  <!-- <h3>Danh sách thương hiệu</h3> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Images</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Status</th>
              <th>Operation</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Product name</th>
              <th>Images</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Status</th>
              <th>Operation</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $showProduct = $product->showProduct();
            if ($showProduct) {
              while ($result = $showProduct->fetch_assoc()) {
            ?>
                <tr>
                  <td><?php echo $result['pname']; ?></td>
                  <td><img src="<?php echo $result['pimg'] ?>" width="100"></td>
                  <td><?php echo $result['bname']; ?></td>
                  <td><?php echo $result['cname']; ?></td>
                  <td><?php echo $result['pstatus']; ?></td>
                  <td><a href="?delete=<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa <?php echo $result['pname']; ?> ?');">Delete</a>
                    <a href="updateProduct.php?proId=<?php echo $result['id']; ?>" class="btn btn-warning">Edit</a>
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