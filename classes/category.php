<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertCategory($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $catName)));

        if (empty($catName)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            $query = "INSERT INTO `categories` (`name`, `slug`, `status`) VALUES 
                    ('$catName', 
                    '$slug', 
                    'Active');";

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

    public function showCategory()
    {
        $sql = "select * from categories order by name";
        $result = $this->db->select($sql);
        return $result;
    }

    public function deleteCategory($id)
    {
        $check_cat = "select * from products where category_id = $id";
        $check_result = $this->db->select($check_cat);
        if ($check_result) {
            if (mysqli_num_rows($check_result) > 0) {
                // Nếu có sản phẩm thuộc thương hiệu này, hiển thị thông báo
                echo "<script>alert('Không thể xóa danh mục này vì còn sản phẩm thuộc danh mục này.');</script>";
            }
        } else {
            $sql = "delete from categories where id = '$id'";

            $result = $this->db->delete($sql);
            if ($result) {
                echo "<script>alert('Xóa thành công.');</script>";
            } else {
                echo "<script>alert('Xóa khong thành công.');</script>";
            }
        }
    }

    public function updateCategory($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $catName)));

        if (empty($catName)) {
            $alert = "<span class='error'>không được để trống</span>";
            return $alert;
        } else {
            $sql = "UPDATE categories SET name = '$catName', slug = '$slug' WHERE id = '$id'";
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

    public function getCatById($id) {
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        $result = $this->db->select($sql);
        return $result;
    }
}
?>