<?php
require('/xampp/htdocs/websitebanhang/admin/db/conn.php');
//lấy dữ liệu từ form
$name = $_POST['name'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$summary = $_POST['summary'];
$description = $_POST['description'];
$stock = $_POST['quantity'];
$price = $_POST['price'];
$sale_price = $_POST['sale_price'];
$category = $_POST['category'];
$brand = $_POST['brand'];

//xu ly hinh anh
$countfiles = count($_FILES['anhs']['name']);

$imgs = '';
for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['anhs']['name'][$i];

    ## Location
    $location = "uploads/" . uniqid() . $filename;
    //pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] ) : mixed
    $extension = pathinfo($location, PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    ## File upload allowed extensions
    $valid_extensions = array("jpg", "jpeg", "png");

    $response = 0;
    ## Check file extension
    if (in_array(strtolower($extension), $valid_extensions)) {

        // them vao CSDL - them thah cong moi upload anh len
        ## Upload file
        //$_FILES['file']['tmp_name']: $_FILES['file']['tmp_name'] - The temporary filename of the file in which the uploaded file was stored on the server.
        if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {

            $imgs .= $location . ";";
        }
    }
}
$imgs = substr($imgs, 0, -1);

$sql_str = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES 
    (NULL, '$name', 
    '$slug', 
    '$description', '$summary', $stock, $price, $sale_price,'$imgs', $category, $brand, 'Active', NULL, NULL);";

//thuc thi cau lenh
mysqli_query($conn, $sql_str);
header('Location: listProduct.php');
?>