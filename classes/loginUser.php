<?php
$filepath = realpath(dirname(__FILE__));
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

    public function insertUser($data, $file)
    {
      
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

       

        $query = "INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`) VALUES (NULL, '$name', '$email', '$password', '$phone') ";

        $result = $this->db->insert($query);
        if ($result) {
            $alert = "Thêm thành công";
            header("Location:login.php");
            return $alert;
        } else {
            $alert = "Thêm sản phẩm không thành công";
            return $alert;
        }
    }


    public function login_User($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        var_dump($data);

    
    if (empty($email) || empty($password)) {
        $alert = "<span class='error'>Không được để trống</span>";
        return $alert;
    } else {
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
       
        
        $result = $this->db->select($query);
        var_dump($result);
            
        if($result != false){
            $value = $result->fetch_assoc();
            Session::set('custopmerlogin',true);
            Session::set('id',$value['id']);
            Session::set('name',$value['name']);
            header("Location:../index.php");
        }else{
            $alert = "<span class='error'>nhap khong dung</span>";
        return $alert;
        }






    }
    }
}
                                                                           
?>