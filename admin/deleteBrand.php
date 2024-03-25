<?php
require('/xampp/htdocs/websitebanhang/admin/db/conn.php');
//lấy dữ liệu từ form

$delete = $_GET['id'];

//ktra xem có sản phẩm nào của brand này kh
$check_pro = "select * from products where brand_id = $delete";
$check_result = mysqli_query($conn, $check_pro);

if (mysqli_num_rows($check_result) > 0) {
    // Nếu có sản phẩm thuộc thương hiệu này, hiển thị thông báo
    echo "<script>alert('Không thể xóa thương hiệu này vì còn sản phẩm thuộc thương hiệu này.');</script>";
} else {
    // Nếu không có sản phẩm thuộc thương hiệu này, tiến hành xóa
    $sql_str = "delete from brands where id = $delete";
    //xóa thành công trả về listbrand
    if (mysqli_query($conn, $sql_str)) {
        header("Location: listBrands.php");
    } else {
        // Xảy ra lỗi khi xóa, hiển thị thông báo lỗi
        echo "Đã xảy ra lỗi khi xóa thương hiệu.";
        header("Location: listBrands.php");
    }
}
