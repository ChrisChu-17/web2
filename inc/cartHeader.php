	<!-- Cart -->
	<?php
	function showCartOnHeader()
	{
		$total = 0; // Khởi tạo biến $total

		// Kiểm tra xem giỏ hàng có tồn tại và không rỗng
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
			echo '<div class="header-cart flex-col-l p-l-65 p-r-25">
				<div class="header-cart-title flex-w flex-sb-m p-b-8">
					<span class="mtext-103 cl2">
						Your Cart
					</span>
	
					<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
						<i class="zmdi zmdi-close"></i>
					</div>
				</div>
	
				<div class="header-cart-content flex-w js-pscroll">
					<ul class="header-cart-wrapitem w-full">';

			// Lặp qua từng sản phẩm trong giỏ hàng
			foreach ($_SESSION['cart'] as $product) {
				// Chuyển đổi các giá trị thành số nguyên
				$price = intval($product[2]);
				$quantity = intval($product[3]);

				// Tính tổng giá tiền của sản phẩm
				$totalOnProduct = $price * $quantity;
				$total += $totalOnProduct; // Cộng tổng giá tiền của mỗi sản phẩm vào $total

				echo '<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="' . $product[0] . '" alt="IMG">
						</div>
	
						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								' . $product[1] . '
							</a>
	
							<span class="header-cart-item-info">
								' . $product[3] . ' x $' . $price . '
							</span>
						</div>
					</li>';
			}

			echo '</ul>
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $' . $total . '
					</div>
	
					<div class="header-cart-buttons flex-w w-full">
						<a href="" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>
	
						<a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>';
		} else {
			echo '<div class="header-cart flex-col-l p-l-65 p-r-25">
				<div class="header-cart-title flex-w flex-sb-m p-b-8">
					<span class="mtext-103 cl2">
						Your Cart
					</span>
	
					<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
						<i class="zmdi zmdi-close"></i>
					</div>
				</div>
	
				<div class="header-cart-content flex-w js-pscroll">
					<p>Your cart is empty</p>
				</div>
			</div>';
		}
	}


	?>
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<?php showCartOnHeader(); ?>
	</div>

	<?php
	require_once('script.php');
	?>