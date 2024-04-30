<?php include 'classes/loginUser.php';  ?>
<?php
$user = new LoginUser();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
  $insertUser = $user->insertUser($_POST); // hàm check catName khi submit lên
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <!-- Link CSS của Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #212529;
      color: #fff;
      border-radius: 10px 10px 0 0;
    }

    .btn-primary {
      background-color: #212529;
      border-color: #212529;
    }

    .btn-primary:hover {
      background-color: #212529;
      border-color: #212529;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Đăng ký</h4>
          </div>
          <?php
            if(isset($insertUser)) {
              echo $insertUser;
            }
          ?>
          <div class="card-body">
            <form action="register.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Họ và tên" value="<?php if(isset($_POST['fullName'])) { echo $_POST['fullName']; } ?>" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required>
              </div>
              <div class="form-group">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } ?>" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Nhập lại mật khẩu" required>
              </div>
              <button type="submit" name="submit" class="btn btn-primary btn-block">Đăng ký</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>