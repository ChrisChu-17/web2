<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
//làm rỗng giỏ hàng
if (isset($_GET['deleteCart']) && ($_GET['deleteCart'] == 1)) {
    unset($_SESSION['cart']);
    header("Location:cart.php");
}
//xóa sp trong cart 
if (isset($_GET['delete']) && ($_GET['delete'] >= 0)) {
    $productIdToDelete = $_GET['delete'];
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][4] == $productIdToDelete) {
            array_splice($_SESSION['cart'], $i, 1);
            header("Location:cart.php");
            break;
        }
    }
}


if (isset($_POST['addToCart']) && ($_POST['addToCart'])) {
    $productId = $_POST['id'];
    $productName = $_POST['pname'];
    $productImg = $_POST['pimg'];
    $productPrice = $_POST['price'];
    $quantity = $_POST['quantity'];

    $follow = 0; // kiểm tra sản phẩm có trùng trong giỏ hàng hông?

    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][4] == $productId) {
            $follow = 1;
            $newQuantity = $quantity + $_SESSION['cart'][$i][3];
            $_SESSION['cart'][$i][3] = $newQuantity;
            break;
        }
    }
    //neu không trùng thì thêm mới
    if ($follow == 0) {
        $product = [$productImg, $productName, $productPrice, $quantity, $productId];
        $_SESSION['cart'][] = $product;
    }
}
$total = 0;

// Xử lý cập nhập giỏ hàng
if (isset($_POST['updateCart'])) {
    foreach ($_POST['quantity'] as $productId => $newQuantity) {
        // Đảm bảo số lượng là số nguyên dương
        $newQuantity = max(0, intval($newQuantity));

        // Tìm sản phẩm trong giỏ hàng và cập nhập số lượng
        foreach ($_SESSION['cart'] as &$product) {
            if ($product[4] == $productId) {
                $product[3] = $newQuantity;
                break;
            }
        }
    }
    // Chuyển hướng người dùng đến trang giỏ hàng sau khi cập nhập
    header("Location: cart.php");
    exit();
}


?>
<?php require('inc/header.php'); ?>
<?php require('inc/script.php'); ?>
<?php include 'classes/carts.php';  ?>
<?php
    $cart = new Cart();
   
?>
<!DOCTYPE html>
<html lang="en">

<body class="animsition">

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <form action="cart.php" method="post">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5">Total</th>
                                        <th class="column-6">Delete</th>
                                    </tr>

                                    <?php  $showCart = $cart->showCart();?>

                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">

                                    <a href="products.php" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Continue shopping
                                    </a>
                                    <a href="cart.php?deleteCart=1" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Clear Cart
                                    </a>
                                </div>
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" type="submit" value="Update Cart" name="updateCart">

                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <!-- Hiển thị tổng giá tiền của giỏ hàng -->
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                $<?php echo $total; ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                There are no shipping methods available. Please double check your address, or contact us if you need any help.
                            </p>

                            <div class="p-t-15">
                                <span class="stext-112 cl8">
                                    Calculate Shipping
                                </span>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time">
                                        <option>Select a country...</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                </div>

                                <div class="flex-w">
                                    <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                        Update Totals
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                $<?php echo $total; ?>
                            </span>
                        </div>
                    </div>

                    <a href="checkout.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        </div>
    </form>




    <!-- Footer -->
    <?php require('inc/footer.php'); ?>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>