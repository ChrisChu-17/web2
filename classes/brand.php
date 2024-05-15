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

    public function insertBrand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $brandName)));

        if (empty($brandName)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            $query = "INSERT INTO `brands` (`name`, `slug`, `status`) VALUES 
                        ('$brandName', 
                        '$slug', 
                        'Active');";

            $result = $this->db->insert($query);
            if ($result) {
                echo "<script>alert('Thêm thành công.');</script>";
            } else {
                $alert = "<span class='error'>Thêm sản phẩm không thành công: " . $this->db->link->error . "</span>";
                return $alert;
            }
        }
    }

    public function showBrand()
    {
        $sql = "select * from brands order by name";
        $result = $this->db->select($sql);
        return $result;
    }

    public function deleteBrand($id)
    {
        $check_brand = "select * from products where brand_id = $id";
        $check_result = $this->db->select($check_brand);
        if ($check_result) {
            if (mysqli_num_rows($check_result) > 0) {
                // Nếu có sản phẩm thuộc thương hiệu này, hiển thị thông báo
                echo "<script>alert('Không thể xóa thương hiệu này vì còn sản phẩm thuộc thương hiệu này.');</script>";
            }
        } else {
            $sql = "delete from brands where id = $id";

            $result = $this->db->delete($sql);
            if ($result) {
                echo "<script>alert('Xóa thành công.');</script>";
            } else {
                echo "<script>alert('Xóa khong thành công.');</script>";
            }
        }
    }

    public function updateBrand($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $brandName)));

        if (empty($brandName)) {
            $alert = "<span class='error'>không được để trống</span>";
            return $alert;
        } else {
            $sql = "UPDATE brands SET name = '$brandName', slug = '$slug' WHERE id = '$id'";
            $result = $this->db->update($sql);
            if ($result) {
                $alert = "<span class='success'>đã cập nhật thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>chưa được cập nhật </span>";
                return $alert;
            }
        }
    }

    public function getBrandById($id)
    {
        $sql = "SELECT * FROM brands WHERE id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
}
?>