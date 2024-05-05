<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showCart()
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (sizeof($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $product) {
                    // Chuyển đổi các giá trị thành số nguyên
                    $price = intval($product[2]);
                    $quantity = intval($product[3]);

                    // Tính tổng giá tiền của sản phẩm
                    $totalOnProduct = $price * $quantity;
                    global $total;
                    $total += $totalOnProduct;
                    echo '<tr class="table_row">
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="' . $product[0] . '" alt="IMG">
                        </div>
                    </td>
                    <td class="column-2">' . $product[1] . '</td>
                    <td class="column-3">' . $price . '</td>
                    <td class="column-4">
                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                <i class="fs-16 zmdi zmdi-minus"></i>
                            </div>
                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity[' . $product[4] . ']"  value="' . $quantity . '">
                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                <i class="fs-16 zmdi zmdi-plus"></i>
                            </div>
                        </div>
                    </td>
                    <td class="column-5">' . $totalOnProduct . '</td>
                    <td class="column-6">
                        <a href="cart.php?delete=' . $product[4] . '">Delete</a>
                    </td>
                </tr>';
                }

                // Hiển thị tổng giá tiền của các sản phẩm trong giỏ hàng
                echo '<div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">  
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                $' . $total . '
                            </span>
                        </div>
                    </div>';
            }
        }
    }
}
