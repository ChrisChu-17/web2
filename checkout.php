<?php require('inc/header.php'); ?>
<?php require('inc/script.php'); ?>
<?php include 'classes/loginUser.php';  ?>
<?php
$user = new LoginUser();
$userId = Session::get('userId');
$userInfor = $user->getUserInfor($userId);
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
					<h4>Billing Details</h4>
					<form action="#">
						<div class="row">
							<?php
							if ($userInfor) {
								while ($result = $userInfor->fetch_assoc()) {
							?>
									<div class="col-md-6">
										<div class="form-group">
											<label for="firstName">First Name<span>*</span></label>
											<input type="text" class="form-control" id="firstName" value="<?= $result['name'] ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lastName">Phone<span>*</span></label>
											<input type="text" class="form-control" id="lastName" value="<?= $result['phone'] ?>" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email<span>*</span></label>
											<input type="email" class="form-control" id="email" value="<?= $result['email'] ?>" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address">Address<span>*</span></label>
											<input type="text" class="form-control" id="address" placeholder="Street Address" required>
											<input type="text" class="form-control mt-2" id="address2" placeholder="Apartment, suite, unit, etc. (optional)">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="city">Town/City<span>*</span></label>
											<input type="text" class="form-control" id="city" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="state">Country/State<span>*</span></label>
											<input type="text" class="form-control" id="state" required>
										</div>
									</div>
							<?php
								}
							}
							?>
						</div>
					</form>
				</div>
				<div class="col-lg-4">
					<div class="checkout__order">
						<h4>Your Order</h4>
						<div class="checkout__order__products d-flex justify-content-between">
							<span class="text-muted">Products</span>
							<span class="text-muted">Total</span>
						</div>
						<ul>
							<li class="d-flex justify-content-between mt-2">
								<span class="text-muted">Vegetable’s Package</span>
								<span class="text-muted">$75.99</span>
							</li>
							<li class="d-flex justify-content-between mt-2">
								<span class="text-muted">Fresh Vegetable</span>
								<span class="text-muted">$151.99</span>
							</li>
							<li class="d-flex justify-content-between mt-2">
								<span class="text-muted">Organic Bananas</span>
								<span class="text-muted">$53.99</span>
							</li>
						</ul>
						<hr>
						<div class="checkout__payment">
							<h4>Payment Method</h4>
							<div class="custom-control custom-radio">
								<input type="radio" id="onlinePayment" name="paymentMethod" class="custom-control-input">
								<label class="custom-control-label" for="onlinePayment">Online Payment</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="cashOnDelivery" name="paymentMethod" class="custom-control-input">
								<label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
							</div>
						</div>
						<div class="checkout__order__subtotal d-flex justify-content-between">
							<span class="text-muted">Subtotal</span>
							<span class="text-muted">$750.99</span>
						</div>
						<div class="checkout__order__total d-flex justify-content-between mt-2">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>
							<div class="size-109 ">
								<span class="mtext-110 cl2">
									$750.99
								</span>
							</div>
						</div>
						<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">PLACE ORDER</button>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Checkout Section End -->

	<!-- Js Plugins -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!-- Footer -->
<?php require('inc/footer.php'); ?>