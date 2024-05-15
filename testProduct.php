<?php
require('inc/header.php');
?>
<?php include 'classes/product.php';  ?>
<?php include 'classes/category.php';  ?>
<?php include 'classes/brand.php';  ?>
<?php
$product = new Product();
$brand = new Brand();
$show_product = $product->showProduct();
$showBrand = $brand->showBrand();

// Lấy giá trị từ URL
$category_slug = isset($_GET['category_slug']) ? $_GET['category_slug'] : '';
$search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
$price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';
$brand_id = isset($_GET['brand']) ? $_GET['brand'] : '';


// Gọi hàm để lấy sản phẩm và tổng số sản phẩm
$products = $product->getFilteredProducts($category_slug, $search_keyword, $price_range, $sort_by, $brand_id, $offset, $productsPerPage);
$totalProducts = $product->getTotalProducts($category_slug, $search_keyword, $price_range, $brand_id);
$totalPages = ceil($totalProducts / $productsPerPage);
?>

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
                        $category = new Category();
                        $show_category = $category->showCategory();
                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) {
                        ?>
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

        <!-- Filter -->
        <div class="dis-none panel-filter w-full p-t-10">
            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                <div class="filter-col1 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Sort By
                    </div>
                    <ul>
                        <li class="p-b-6">
                            <a href="?sort_by=low_to_high" class="filter-link stext-106 trans-04">
                                Price: Low to High
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?sort_by=high_to_low" class="filter-link stext-106 trans-04">
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
                            <a href="products.php" class="filter-link stext-106 trans-04">
                                All
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?price_range=0_50" class="filter-link stext-106 trans-04">
                                $0.00 - $50.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?price_range=50_100" class="filter-link stext-106 trans-04">
                                $50.00 - $100.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?price_range=100_150" class="filter-link stext-106 trans-04">
                                $100.00 - $150.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?price_range=150_200" class="filter-link stext-106 trans-04">
                                $150.00 - $200.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="?price_range=200" class="filter-link stext-106 trans-04">
                                $200.00+
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="filter-col3 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Brand
                    </div>
                    <?php
                    if ($showBrand) {
                        while ($result = $showBrand->fetch_assoc()) {
                    ?>
                            <ul>
                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>
                                    <a href="?brand=<?= $result['id'] ?>" class="filter-link stext-106 trans-04">
                                        <?= $result['name'] ?>
                                    </a>
                                </li>
                            </ul>
                    <?php
                        }
                    }
                    ?>
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
                            <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                View details
                            </a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="details.php?proid=<?php echo $result['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    <?php echo $result['name'] ?>
                                </a>
                                <span class="stext-105 cl3">
                                    $<?php echo $fm->format_currency($result['price']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="pagination flex-m flex-w p-t-26">
                <ul class="pagination">
                    <?php
                    // Tạo phân trang
                    $totalProducts = $product->countProductsByCategory($category_slug);
                    $totalPages = ceil($totalProducts / $productsPerPage);
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li><a href="?category_slug=' . $category_slug . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php
        } elseif (empty($category_slug)) {
            // Nếu không có giá trị category_slug thì lấy tất cả sản phẩm
        ?>
            <div class="row">
                <?php
                $show_product = $product->showProduct($productsPerPage, $offset);
                if ($show_product) {
                    while ($result = $show_product->fetch_assoc()) {
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="block2-pic hov-img0">
                                <?= $product->imgProcessForUser($result['pimg'], 200, 200, 'img-fluid') ?>
                                <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    View details
                                </a>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="details.php?proid=<?php echo $result['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?php echo $result['pname'] ?>
                                    </a>
                                    <span class="stext-105 cl3">
                                        $<?php echo $result['price'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <div class="pagination flex-m flex-w p-t-26">
                <ul class="pagination">
                    <?php
                    // Tạo phân trang
                    $totalProducts = $product->countProducts();
                    $totalPages = ceil($totalProducts / $productsPerPage);
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        <?php
        } else {
            // Nếu không có sản phẩm nào được tìm thấy
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        No products found in this category.
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php
require('inc/footer.php');
?>
