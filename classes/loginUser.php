<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

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
    public function insertUser($data, $file)
    {
      
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        
        if (empty($name) || empty($email) || empty($password) || empty($phone)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        }else{

        $query = "INSERT INTO `users` ( 'name', 'email','password','phone') VALUES 
        ('$name','$email','$password','$phone')";

        $result = $this->db->insert($query);
        if ($result) {
            $alert = "Thêm thành công";
            return $alert;
        } else {
            $alert = "Thêm sản phẩm không thành công";
            return $alert;
        }
    }}
    }
?>