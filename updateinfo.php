<?php
ob_start(); // Bắt đầu bộ đệm đầu ra
// Include các file và khởi tạo đối tượng LoginUser
require('inc/header.php');
require('inc/script.php');
include 'classes/loginUser.php';

// Khởi tạo đối tượng LoginUser
$user = new LoginUser();

// Lấy userId từ session
$userId = Session::get('userId');

// Lấy thông tin người dùng từ database
$userInfor = $user->getUserInfor($userId);

// Xử lý khi người dùng gửi biểu mẫu cập nhật thông tin
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ biểu mẫu và gán vào mảng dữ liệu
    $newName = $_POST['newName'];
    $newEmail = $_POST['newEmail'];
    $newPhone = $_POST['newPhone'];
    $newPassword = $_POST['newPassword']; // Lấy mật khẩu mới từ biểu mẫu

    // Kiểm tra xem người dùng đã nhập mật khẩu mới hay chưa
    if (!empty($newPassword)) {
        // Nếu có mật khẩu mới, cập nhật thông tin người dùng kèm theo mật khẩu mới
        $result = $user->updateUser(array('name' => $newName, 'email' => $newEmail, 'phone' => $newPhone, 'password' => $newPassword), $userId);
    } else {
        // Nếu không có mật khẩu mới, chỉ cập nhật thông tin người dùng
        $result = $user->updateUser(array('name' => $newName, 'email' => $newEmail, 'phone' => $newPhone), $userId);
    }

    // Kiểm tra kết quả cập nhật và hiển thị thông báo tương ứng
    if ($result) {
        echo "<div class='alert alert-success'>$result</div>";
        header("Location:infoUser.php"); // Chuyển hướng người dùng sau khi cập nhật thành công
    } else {
        echo "<div class='alert alert-danger'>Cập nhật thông tin người dùng không thành công</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Info</title>
</head>

<body>
    <div class="container">
        <h2>Update User Information</h2>
        <?php if ($user) : ?>
            <form method="post">
                <div class="form-group">
                    <label for="newName">New Name:</label>
                    <input type="text" class="form-control" id="newName" name="newName" value="">

                </div>
                <div class="form-group">
                    <label for="newEmail">New Email:</label>
                    <input type="email" class="form-control" id="newEmail" name="newEmail" value="">

                </div>
                <div class="form-group">
                    <label for="newPhone">New Phone:</label>
                    <input type="text" class="form-control" id="newPhone" name="newPhone" value="">
                    <button type="submit" class="btn btn-primary" name="updatePhone">Update Phone</button>

                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" value="">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
        <?php else : ?>
            <p>User information not found!</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
ob_end_flush();
?>