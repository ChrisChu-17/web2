<?php
// Kết nối tới cơ sở dữ liệu và import các file cần thiết
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../classes/category.php');
include_once($filepath . '/../classes/product.php');
// Kiểm tra xem category_id đã được gửi từ phía client chưa
if(isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    // Truy vấn cơ sở dữ liệu để lấy các sản phẩm thuộc danh mục đã chọn
    $product = new Product();
    $products = $product->searchProductByCategories($category_id);

    // Hiển thị các sản phẩm trong HTML
    if($products && $products->num_rows > 0) {
        while($product = $products->fetch_assoc()) {
            // Hiển thị thông tin sản phẩm
            echo '<div class="product">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<p>' . $product['description'] . '</p>';
            // Thêm các thông tin khác về sản phẩm nếu cần
            echo '</div>';
        }
    } else {
        echo 'Không có sản phẩm nào trong danh mục này.';
    }
} else {
    echo 'Không có danh mục nào được chọn.';
}
?>
