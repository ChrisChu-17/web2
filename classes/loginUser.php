
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../lib/session.php');

?>

<?php
class LoginUser
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

        $name = mysqli_real_escape_string($this->db->link, $data['fullName']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $confirmPassword = mysqli_real_escape_string($this->db->link, md5($data['confirmPassword']));

        if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($confirmPassword)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } elseif ($password != $confirmPassword) {
            $alert = "<span class='error'>Mật khẩu không khớp</span>";
            return $alert;
        } else {

            $query = "INSERT INTO `users` (`name`, `email`, `password`, `phone`)
             VALUES ('$name', '$email', '$password', '$phone')";


            $result = $this->db->insert($query);
            if ($result) {
                $alert = "Thêm thành công";
                return $alert;
            } else {
                $alert = "Thêm sản phẩm không thành công";
                return $alert;
            }
        }
    }

    public function loginUser($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if (empty($email) || empty($password)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 'Active'"; // Thêm điều kiện kiểm tra trạng thái tài khoản
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('userLogin', true);
                Session::set('userId', $value['id']);
                Session::set('userName', $value['name']);
            } else {
                $alert = "<script>alert('Tài khoản hoặc mật khẩu không đúng hoặc tài khoản đã bị chặn')</script>"; // Thông báo tài khoản đã bị chặn
                return $alert;
            }
        }
    }


    public function getUserInfor($id)
    {
        $userId = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showListUser()
    {
        $sql = "SELECT * FROM USERS ORDER BY id ";
        $result = $this->db->select($sql);
        return $result;
    }

    public function toggleUserStatus($id)
    {
        $userId = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT status FROM users WHERE id = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $currentStatus = $row['status'];
            $newStatus = $currentStatus == 'Active' ? 'Inactive' : 'Active';
            $updateQuery = "UPDATE users SET status = '$newStatus' WHERE id = '$userId'";
            $this->db->update($updateQuery);
        }
    }

    public function updateUser($data, $id)
    {
        $userId = mysqli_real_escape_string($this->db->link, $id);
        $fullname = mysqli_real_escape_string($this->db->link, $data['fullname']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if (empty($fullname) || empty($email) || empty($phone) || empty($password)) {
            $alert = "<span class='error'>không được để trống</span>";
            return $alert;
        } else {
            $sql = "UPDATE users SET name = '$fullname', email = '$email', password = '$password', phone = '$phone' WHERE id = '$id'";
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

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->select($sql);
        return $result;
    }
}
?>