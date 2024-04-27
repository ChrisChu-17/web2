<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insertUser($data)
    {
        $first_name = mysqli_real_escape_string($this->db->link, $data['first_name']);
        $last_name = mysqli_real_escape_string($this->db->link, $data['last_name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        $query = "INSERT INTO `register` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES 
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
?>