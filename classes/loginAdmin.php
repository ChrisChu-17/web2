
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../lib/session.php');

?>

<?php
class LoginAdmin
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

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
       

        if (empty($name) || empty($email) || empty($password) || empty($phone) ) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
       
        } else {

            $query = "INSERT INTO `admins` (`name`, `email`, `password`, `phone`)
             VALUES ('$name', '$email', '$password', '$phone')";


            $result = $this->db->insert($query);
            if ($result) {
                $alert = "Thêm thành công";
                header("Location: login.php");                
                return $alert;

            } else {
                $alert = "Thêm sản phẩm không thành công";
                return $alert;
            }
        }
    }

    public function login_admin($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if (empty($email) || empty($password)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {

            $query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('loginAdmin', true);
                Session::set('id', $value['id']);
                Session::set('name', $value['name']);
                header("Location: index.php");       
            } else {
                $alert = "<span>Tài khoản hoặc mật khẩu không đúng</span>";
                return $alert;
            }
        }
    }
    
}
?>