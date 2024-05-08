<?php
require('inc/header.php');
?>
<?php include 'classes/product.php';  ?>
<?php include 'classes/category.php';  ?>
<?php
$product = new Product();
$show_product = $product->showProduct();

?>
<!-- Product -->

<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <div class="row">
                    <div id="categoryForm">
                        <a href="products.php">
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
                                All Products
                            </button>
                        </a>

                        <?php
                        $category = new category();
                        $show_category = $category->showCategory();
                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) {
                        ?>
                                <!-- Thêm category_id vào URL khi bấm vào nút danh mục -->
                                <a href="products.php?category_slug=<?php echo $result['slug'] ?>">
                                    <button class="filter-btn stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="category" data-filter=".<?php echo $result['slug'] ?>">
                                        <?php echo $result['name']; ?>
                                    </button>
                                </a>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Filter
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>
        </div>
        <!-- Search product -->
        <div class="dis-none panel-search w-full p-t-10 p-b-15">
            <form method="get" id="searchForm">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search" id="searchInput">
                </div>
            </form>
        </div>

        <!-- Filter oke-->
        <div class="dis-none panel-filter w-full p-t-10">
            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                <div class="filter-col1 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Sort By
                    </div>

                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Default
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Popularity
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Average rating
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                Newness
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Price: Low to High
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Price: High to Low
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col2 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Price
                    </div>

                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                All
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $0.00 - $50.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $50.00 - $100.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $100.00 - $150.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $150.00 - $200.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $200.00+
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col3 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Color
                    </div>

                    <ul>
                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                                <i class="zmdi zmdi-circle"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04">
                                Black
                            </a>
                        </li>

                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
                                <i class="zmdi zmdi-circle"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                Blue
                            </a>
                        </li>

                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
                                <i class="zmdi zmdi-circle"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04">
                                Grey
                            </a>
                        </li>

                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
                                <i class="zmdi zmdi-circle"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04">
                                Green
                            </a>
                        </li>

                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
                                <i class="zmdi zmdi-circle"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04">
                                Red
                            </a>
                        </li>

                        <li class="p-b-6">
                            <span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
                                <i class="zmdi zmdi-circle-o"></i>
                            </span>

                            <a href="#" class="filter-link stext-106 trans-04">
                                White
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col4 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Tags
                    </div>

                    <div class="flex-w p-t-4 m-r--5">
                        <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                            Fashion
                        </a>

                        <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                            Lifestyle
                        </a>

                        <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                            Denim
                        </a>

                        <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                            Streetstyle
                        </a>

                        <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                            Crafts
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Biến để đánh dấu xem có kết quả tìm kiếm hay không
        $hasSearchResult = false;

        // Lấy giá trị của tham số category_slug từ URL
        $category_slug = isset($_GET['category_slug']) ? $_GET['category_slug'] : '';
        $productsPerPage = 4;

        // Số trang hiện tại, mặc định là 1 nếu không có
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Tính toán độ lệch cho câu truy vấn
        $offset = ($page - 1) * $productsPerPage;

        // Truy vấn sản phẩm dựa trên thể loại chỉ định
        $showProductByCats = $product->showProductByCategory($category_slug, $productsPerPage, $offset);

        // Nếu có kết quả từ việc tìm kiếm sản phẩm theo thể loại
        if ($showProductByCats && $showProductByCats->num_rows > 0) {
            $hasSearchResult = true;
        ?>

            <div class="row">
                <?php
                while ($result = $showProductByCats->fetch_assoc()) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="block2-pic hov-img0">
                            <?= $product->imgProcessForUser($result['images'], 200, 200, 'img-fluid') ?>
                            <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">Quick View</a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="details.php?proid=<?php echo $result['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"><?= $result['name'] ?></a>
                                <span class="stext-105 cl3"><?= $result['price'] ?></span>
                            </div>
                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        <?php
        } // Kết thúc kiểm tra kết quả tìm kiếm

        // Nếu không có kết quả từ việc tìm kiếm sản phẩm theo thể loại
        if (!$hasSearchResult) {
        ?>
            <div class="row">
                <?php if (!$hasSearchResult) {

                    $product = new Product();
                    $productsPerPage = 4; // Số lượng sản phẩm trên mỗi trang

                    // Lấy số trang hiện tại, mặc định là 1 nếu không được đặt
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Tính toán độ lệch cho câu truy vấn
                    $offset = ($page - 1) * $productsPerPage;

                    // Tìm kiếm sản phẩm nếu có
                    $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';

                    if (!empty($search_keyword)) {
                        $search_result = $product->searchProductByNameForPage($search_keyword, $productsPerPage, $offset);
                        $totalProducts = $product->getTotalProductsCountBySearch($search_keyword);
                        $limit = 4;
                        $totalPages = ceil($totalProducts / $limit); // Tính tổng số trang

                    } else {
                        $search_result = $product->getProductsForPage($productsPerPage, $offset);
                        $totalProducts = $product->getTotalProductsCount();
                        $totalPages = ceil($totalProducts / $productsPerPage);
                    }

                    if ($search_result && $search_result->num_rows > 0) {
                        while ($result = $search_result->fetch_assoc()) {
                            // Hiển thị sản phẩm ở đây
                            echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12 '>";
                            // Hiển thị thông tin sản phẩm
                            echo "<div class='block2-pic hov-img0'>";
                            echo "<h2 a href='details.php?proid={$result['id']}'>{$product->imgProcessForUser($result['images'], 200, 200, 'img-fluid')}</h2>";
                            echo "<a href='details.php?proid={$result['id']}' class='block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04'>Quick view</a>";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>{$result['name']}</h5>";
                            echo "<p class='card-text'>Price: {$result['price']} VND</p>";
                            echo "{$result['category_id']}";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<script>alert('Không có sản phẩm nào được tìm thấy.');</script>";
                    }
                } ?>
            </div>
        <?php } ?>
    </div>

</div>

</div>


<div class="flex-w flex-c-m m-tb-10">
    <?php
    if (empty($totalPages)) {
        echo '    ádadada      ';
    } else
    if ($totalPages > 1) {
        echo '<ul class="pagination justify-content-center">'; // Thêm lớp justify-content-center để căn giữa

        if ($page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($page < $totalPages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
        }

        echo '</ul>';
    }
    ?>

</div>


</div>



<?php
require('inc/footer.php');
?>

<?php
require('inc/script.php');
?>