<?php
require('/xampp/htdocs/websitebanhang/admin/db/conn.php');
//lấy dữ liệu từ form

$delete = $_GET['id'];

$sql = "delete from product where id = $delete";

mysqli_query($conn, $sql);
header('Location: listProduct.php');

