

<?php include_once('../classes/LoginUSer.php'); ?>
<?php
$user = new LoginUser();
if (!isset($_GET['id'])) {
    echo "<script> window.location = 'listProduct.php' </script>";
} else {
    $userId = $_GET['id'];
    echo $userId;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateUser = $user->updateUser($_POST, $userId);
    if($updateUser) {
        echo "<script> window.location = 'listUser.php' </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update User</h1>
                                    </div>
                                    <!-- PHP Code -->
                                    <?php
                                    if (isset($updateUser)) {
                                        echo $updateUser;
                                    }
                                    ?>
                                    <?php
                                    $getUserName = $user->getUserById($userId);
                                    if ($getUserName) {
                                        while ($result = $getUserName->fetch_assoc()) {
                                    ?>
                                            <!-- Update User Form -->
                                            <form class="user" action="" method="post">
                                                <div class="form-group">
                                                    <label class="form-label">Fullname:</label>
                                                    <input type="text" class="form-control" id="name" name="fullName" placeholder="Enter Your Fullname..." value="<?php echo $result['name']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email..." value="<?php echo $result['email']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Phone:</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your PhoneNumber..." value="<?php echo $result['phone']; ?>" required>
                                                </div>
                                                <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                                                    Save
                                                </button>
                                                <hr>
                                            </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
require('include/footer.php');
?>