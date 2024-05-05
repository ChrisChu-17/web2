
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

            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('userLogin', true);
                Session::set('userId', $value['id']);
                Session::set('userName', $value['name']);
            } else {
                $alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng</span>";
                return $alert;
            }
        }
    }

    public function getUserInfor($id) {
        $userId = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>