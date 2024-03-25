<?php
require('/xampp/htdocs/websitebanhang/admin/db/conn.php');
//lấy dữ liệu từ form
$name = $_POST['name'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

$sql_str = "INSERT INTO `categories` (`name`, `slug`, `status`) VALUES 
    ('$name', 
    '$slug', 
    'Active');";

//thuc thi cau lenh
mysqli_query($conn, $sql_str);

header("Location: listCats.php");
?>