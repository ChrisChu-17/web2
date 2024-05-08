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

    public function showProductOnCheckout()
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (sizeof($_SESSION['cart']) > 0) {
                echo '<div class="checkout__order">
                <h4>Your Order</h4>
                    <div class="checkout__order__products d-flex justify-content-between">
                        <span class="text-muted">Products</span>
                        <span class="text-muted">Total</span>
                    </div>';
                foreach ($_SESSION['cart'] as $product) {
                    // Chuyển đổi các giá trị thành số nguyên
                    $price = intval($product[2]);
                    $quantity = intval($product[3]);
                    $productName = $product[1];
                    // Tính tổng giá tiền của sản phẩm
                    $totalOnProduct = $price * $quantity;
                    global $total;
                    $total += $totalOnProduct;
                    echo '
                    <ul>
                        <li class="d-flex justify-content-between mt-2">
                            <span class="text-muted">' . $productName . '</span>
                            <span class="text-muted">$' . $totalOnProduct . '</span>
                        </li>
                    </ul>';
                }
                echo '<hr>
                <div class="checkout__order__subtotal d-flex justify-content-between">
                    <span class="text-muted">Subtotal</span>
                    <span class="text-muted">$' . $total . '</span>
                </div>
                <div class="checkout__order__total d-flex justify-content-between mt-2">
                    <div class="size-208">
                        <span class="mtext-101 cl2">
                            Total:
                        </span>
                    </div>
                    <div class="size-100 ">
                        <span class="mtext-110 cl2">
                            $' . $total . '
                        </span>
                    </div>
                </div>
                <input type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer mt-3" name="placeOrder" value="PLACE ORDER">';
            }
        }
    }

    public function createOrder($data, $userId)
    {
        //lấy thông tin khách hàng
        $fullname = mysqli_real_escape_string($this->db->link, $data['fullname']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $district = mysqli_real_escape_string($this->db->link, $data['district']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);

        if (empty($fullname) || empty($phone) || empty($email) || empty($address) || empty($city)) {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {

            $query = "INSERT INTO `orders`(`id`, `user_id`, `fullname`, `phone`, `email`, `address`, `district`, `city`, `status`, `created_at`, `updated_at`)
             VALUES (0, $userId,'$fullname','$phone','$email','$address','$district','$city','Processing', now(), now())";
            $result = $this->db->insert($query);
            if ($result) {
                $lastId = $this->db->link->insert_id;
                return $lastId;
            } else {
                return false;
            }
        }
    }

    public function createOrderDetail($product, $idUserCart)
    {
        $price = mysqli_real_escape_string($this->db->link, intval($product[2]));
        $quantity = mysqli_real_escape_string($this->db->link, intval($product[3]));
        $productId = mysqli_real_escape_string($this->db->link, $product[4]);
        $total = $price * $quantity;

        $query = "INSERT INTO `order_details`(`id`, `order_id`, `product_id`, `price`, `qty`, `total`, `created_at`, `updated_at`) 
        VALUES (0, $idUserCart, $productId, $price, $quantity, $total, now(), now())";
        $result = $this->db->insert($query);
    }

    public function showOrder()
    {
        $sql = "select * from orders order by created_at";
        $result = $this->db->select($sql);
        return $result;
    }

    public function showOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = $id";
        $result = $this->db->select($sql);
        return $result;
    }

    public function showOrderDetailByOrderId($id)
    {
        $sql = "select *, products.name as pname, order_details.price as oprice  from products, order_details where products.id=order_details.product_id and order_id=$id";
        $result = $this->db->select($sql);
        return $result;
    }

}
