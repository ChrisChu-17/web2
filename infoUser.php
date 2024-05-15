<?php
require('inc/header.php');
require('inc/script.php');

include 'classes/loginUser.php';

$user = new LoginUser();

$userId = Session::get('userId');
$userInfo = $user->getUserInfor($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom CSS for input border color -->
    <style>
        .checkout__input input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<body>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4>Your Information</h4>
                    <form method="post">
                        <?php
                        if ($userInfo) {
                            while ($result = $userInfo->fetch_assoc()) {
                        ?>
                                <div class="form-group">
                                    <label for="firstName">First Name<span>*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="fullname" value="<?= $result['name'] ?>" readonly>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $result['phone'] ?>" readonly>
                                    <a href="updateinfo.php?userId=<?php echo $result['id']; ?>" class="btn btn-warning">Edit</a>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email<span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $result['email'] ?>" readonly>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="password">Password<span>*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" value="<?= $result['password'] ?>" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                                        </div>
                                    </div>
                                </div>
                                <a href="updateinfo.php?userId=<?php echo $result['id']; ?>" class="btn btn-warning">Charge</a>
                        <?php
                            }
                        }
                        ?>
                       
                    </form>
                </div>
                <div class="col-lg-4">
                    <p>ch</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <div></div>
    <!-- Js Plugins -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<!-- Sau thẻ </body> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.getAttribute('type');
            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.textContent = 'Hide';
            } else {
                passwordField.setAttribute('type', 'password');
                this.textContent = 'Show';
            }
        });

        // Lặp qua tất cả các nút chỉnh sửa và gán sự kiện click
        var editBtns = document.querySelectorAll('.editBtn');
        editBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var parentDiv = btn.closest('.form-group');
                var inputField = parentDiv.querySelector('input');
                if (inputField) {
                    inputField.removeAttribute('readonly');
                }
            });
        });
    });
</script>

<?php require('inc/footer.php'); ?>