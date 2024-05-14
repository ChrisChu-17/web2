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
        products.price as price,
     
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

    public function getProductDetails($id)
    {
        $sql =
            "SELECT products.*, categories.name as cname


			 FROM products INNER JOIN categories ON products.category_id = categories.id
								
			 WHERE products.id = '$id'
			 ";

        $result = $this->db->select($sql);
        return $result;
    }

    public function getProductBreadcrumb($id)
    {
        $sql =
            "SELECT products.name as pname, 
            products.category_id as pcats,
            products.id as pid, categories.name as cname,

            categories.id as cid

			 FROM products INNER JOIN categories ON products.id = categories.id
								
			 WHERE products.id = '$id'
			 ";

        $result = $this->db->select($sql);
        return $result;
    }

    function imgProcess($arrstr, $width)
    {
        //arrstr la mang chua cac hinh anh vd anh1, anh2, anh3...
        $arr = explode(";", $arrstr);
        return "<img src= '$arr[0]' width = '$width'/>";
    }

    function imgProcessForUser($arrstr, $width, $height, $class)
    {
        $arr = explode(";", $arrstr);
        return "<img src='admin/$arr[0]' width='$width' height='$height' class='$class' />";
    }

    public function searchProductByName($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
        $result = $this->db->select($sql);
        return $result;
    }

    // public function showProductByCategory($category_id)
    // {
    //     $sql = "SELECT products.id as pid, products.name as pname, products.images as pimg, products.price as price
    //             FROM products
    //             WHERE products.category_id = $category_id";

    //     $result = $this->db->select($sql);
    //     return $result;
    // }

    public function showProductByCategory($category_slug)
    {
        $category_slug = $this->db->link->real_escape_string($category_slug);
        $query = "SELECT * FROM products WHERE category_id IN (SELECT id FROM categories WHERE slug LIKE '%$category_slug%')";
        $result = $this->db->select($query);
        return $result;
    }
    // Phương thức lấy sản phẩm cho trang hiện tại
    public function getProductsForPage($limit, $offset,)
    {
        $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset ";
        $result = $this->db->select($sql);
        return $result;
    }

    // Phương thức lấy tổng số lượng sản phẩm
    public function getTotalProductsCount()
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function searchProductByNameForPage($keyword, $limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' LIMIT $limit OFFSET $offset";
        $result = $this->db->select($sql);
        return $result;
    }
    public function getTotalProductsCountBySearch($keyword)
    {
        $query = "SELECT COUNT(*) as total FROM products WHERE name LIKE '%$keyword%'";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();

        return $row['total'];
    }
}
?>
