<?php
require('include/header.php');

function imgProcess($arrstr, $height) {
  //arrstr la mang chua cac hinh anh vd anh1, anh2, anh3...
  $arr = explode(";", $arrstr);
  return "<img src='$arr[0]' height = '$height'/>";
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
            //ket noi database fetch data từ database ra bảng html
            require('db/conn.php');
            $sql = "SELECT 
            products.name as pname, 
            products.images as pimg,
            brands.name as bname,
            categories.name as cname,
            products.status as pstatus FROM `products` 
            JOIN categories ON products.category_id = categories.id 
            JOIN brands ON products.brand_id = brands.id 
            ORDER BY products.name;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $row['pname']; ?></td>
                <td><?= imgProcess($row['pimg'], "100px"); ?></td>
                <td><?= $row['bname']; ?></td>
                <td><?= $row['cname']; ?></td>
                <td><?= $row['pstatus']; ?></td>
                <td><a href="deleteProduct.php?" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa brand này?');">Delete</a>    <a href="" class="btn btn-warning">Edit</a></td>
              </tr>
            <?php
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