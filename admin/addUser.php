<?php
require('include/header.php');
?>
<?php include '../classes/loginUser.php';  ?>
<?php
// gọi class category
$user = new LoginUser();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertUser = $user->insertUser($_POST); // hàm check catName khi submit lên
}
?>
<div>
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add User!</h1>
                                </div>
                                <?php
                                if (isset($insertUser)) {
                                    echo $insertUser;
                                }
                                ?>
                                <form class="user" action="addUser.php" method="post" >
                                    <div class="form-group">
                                        <label class="form-label">Fullname:</label>
                                        <input type="text" class="form-control" id="name" name="fullName" placeholder="Enter Your Fullname..." value="<?php if(isset($_POST['fullName'])) { echo $_POST['fullName']; } ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email..." value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your PhoneNumber..." value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password..." value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password:</label>
                                        <input type="password" class="form-control" id="Confirmpassword" name="confirmPassword" placeholder="Confirm Your Password..." required>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit" name="submit" class="form-control">
                                        Save
                                    </button>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
require('include/footer.php');
?>