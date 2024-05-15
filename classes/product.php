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
            disscounted_price = $sale_price,
            images = '$imgs'
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

    public function showProductByCategory($category_slug)
    {
        $category_slug = $this->db->link->real_escape_string($category_slug);
        $query = "SELECT * FROM products WHERE category_id IN (SELECT id FROM categories WHERE slug = '$category_slug')";
        $result = $this->db->select($query);
        return $result;
    }   
    // Phương thức lấy sản phẩm cho trang hiện tại
    public function getProductsForPage($limit, $offset)
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

    public function getTotalProductsCountByResult($keyword)
    {
        $query = "SELECT COUNT(*) as total FROM products WHERE name LIKE '%$keyword%'";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function getFilteredProducts($category_slug, $search_keyword, $price_range, $sort_by, $brand_id, $offset, $limit)
    {
        $query = "SELECT * FROM products WHERE 1=1";
        $bindParams = [];
        $bindParamsType = '';

        if (!empty($category_slug)) {
            $query .= " AND category_slug = ?";
            $bindParams[] = $category_slug;
            $bindParamsType .= 's';
        }
        if (!empty($search_keyword)) {
            $query .= " AND name LIKE ?";
            $bindParams[] = '%' . $search_keyword . '%';
            $bindParamsType .= 's';
        }
        if (!empty($price_range)) {
            if ($price_range == '0_50') {
                $query .= " AND price BETWEEN 0 AND 50";
            } elseif ($price_range == '50_100') {
                $query .= " AND price BETWEEN 50 AND 100";
            } elseif ($price_range == '100_150') {
                $query .= " AND price BETWEEN 100 AND 150";
            } elseif ($price_range == '150_200') {
                $query .= " AND price BETWEEN 150 AND 200";
            } elseif ($price_range == '200') {
                $query .= " AND price > 200";
            }
        }
        if (!empty($brand_id)) {
            $query .= " AND brand_id = ?";
            $bindParams[] = $brand_id;
            $bindParamsType .= 'i';
        }
        if (!empty($sort_by)) {
            if ($sort_by == 'low_to_high') {
                $query .= " ORDER BY price ASC";
            } elseif ($sort_by == 'high_to_low') {
                $query .= " ORDER BY price DESC";
            }
        }
        $query .= " LIMIT ?, ?";
        $bindParams[] = $offset;
        $bindParams[] = $limit;
        $bindParamsType .= 'ii';

        $stmt = $this->db->prepare($query);

        if ($bindParamsType) {
            $stmt->bind_param($bindParamsType, ...$bindParams);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        return $products;
    }


    public function getTotalProducts($category_slug, $search_keyword, $price_range, $brand_id)
    {
        $query = "SELECT COUNT(*) as total FROM products WHERE 1=1";
        $bindParams = [];
        $bindParamsType = '';

        if (!empty($category_slug)) {
            $query .= " AND category_slug = ?";
            $bindParams[] = $category_slug;
            $bindParamsType .= 's';
        }
        if (!empty($search_keyword)) {
            $query .= " AND name LIKE ?";
            $bindParams[] = '%' . $search_keyword . '%';
            $bindParamsType .= 's';
        }
        if (!empty($price_range)) {
            if ($price_range == '0_50') {
                $query .= " AND price BETWEEN 0 AND 50";
            } elseif ($price_range == '50_100') {
                $query .= " AND price BETWEEN 50 AND 100";
            } elseif ($price_range == '100_150') {
                $query .= " AND price BETWEEN 100 AND 150";
            } elseif ($price_range == '150_200') {
                $query .= " AND price BETWEEN 150 AND 200";
            } elseif ($price_range == '200') {
                $query .= " AND price > 200";
            }
        }
        if (!empty($brand_id)) {
            $query .= " AND brand_id = ?";
            $bindParams[] = $brand_id;
            $bindParamsType .= 'i';
        }

        $stmt = $this->db->prepare($query);

        if ($bindParamsType) {
            $stmt->bind_param($bindParamsType, ...$bindParams);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->fetch_assoc()['total'];

        return $total;
    }
}
?>
