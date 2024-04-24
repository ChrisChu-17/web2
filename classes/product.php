<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php

class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insert_product($data, $file)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $summary = mysqli_real_escape_string($this->db->link, $data['summary']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $stock = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);

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

        if (empty($name) || empty($summary) || empty($description) || empty($stock) || empty($price) || empty($sale_price) || empty($category) || empty($brand)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            $query = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES 
                        (NULL, '$name', 
                        '$slug', 
                        '$description', '$summary', $stock, $price, $sale_price,'$imgs', $category, $brand, 'Active', NULL, NULL);";

            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>thêm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm sản phẩm không thành công: " . $this->db->link->error . "</span>";
                return $alert;
            }
        }
    }

    public function showProduct()
    {
        $sql = "SELECT 
        products.id as id,
        products.name as pname, 
        products.images as pimg,
        brands.name as bname,
        categories.name as cname,
        products.status as pstatus FROM `products` 
        JOIN categories ON products.category_id = categories.id 
        JOIN brands ON products.brand_id = brands.id 
        ORDER BY products.name;";
        $result = $this->db->select($sql);
        return $result;
    }

    public function updateProduct($data, $file, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $summary = mysqli_real_escape_string($this->db->link, $data['summary']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $stock = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);

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

        if (empty($name) || empty($summary) || empty($description) || empty($stock) || empty($price) || empty($sale_price) || empty($category) || empty($brand)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            $sql = "UPDATE products SET 
            name = '$name', slug = '$slug', 
            description = '$description', summary = '$summary',
            stock = $stock, price = $price,
            disscounted_price = $sale_price
            WHERE id = $id";
            $result = $this->db->update($sql);
            if ($result) {
                echo "<script>alert('cập nhật thành công.');</script>";
                header('Location: listProduct.php');
            } else {
                echo "<script>alert('cập nhật  khong thành công.');</script>";
            }
        }
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = $id";
        $result = $this->db->delete($sql);
        if ($result) {
            echo "<script>alert('Xóa thành công.');</script>";
        } else {
            echo "<script>alert('Xóa khong thành công.');</script>";
        }
    }
}
?>
