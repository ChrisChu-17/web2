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
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
                            All Products
                        </button>
                        <?php
                        $category = new category();
                        $show_category = $category->showCategory();

                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) {
                        ?>

                                <button class="filter-btn stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" type="submit" name="category" data-filter=".<?php echo $result['slug'] ?>">
                                    <?php echo $result['name']; ?>
                                </button>
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

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <form method="post" id="searchForm">
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
                <!-- Your filter content here -->
            </div>

            <?php
            // Biến để đánh dấu xem có kết quả tìm kiếm hay không
            $hasSearchResult = false;

            if (isset($_POST['search'])) {
                $keyword = $_POST['search'];
                $product = new Product();
                $search_result = $product->searchProductByName($keyword);
            ?>
                <div class="row">
                <?php   // Kiểm tra xem có kết quả tìm kiếm hay không
                if ($search_result && $search_result->num_rows > 0) {
                    $hasSearchResult = true;
                    // Hiển thị kết quả tìm kiếm
                    while ($result = $search_result->fetch_assoc()) {
                        // Hiển thị thông tin sản phẩm tìm kiếm ở đây
                        echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                        echo "<div class='block2-pic hov-img0'>"; //card
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
            }
                ?>
                <?php if (!$hasSearchResult) { ?>
                    <div class="row">
                        <?php
                        if ($show_product) {
                            while ($result = $show_product->fetch_assoc()) {
                                // Hiển thị danh sách sản phẩm ở đây
                        ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="block2-pic hov-img0">
                                        <?= $product->imgProcessForUser($result['pimg'], 200, 200, 'img-fluid') ?>

                                        <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                            Quick View
                                        </a>

                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                <?= $result['pname'] ?>
                                            </a>

                                            <span class="stext-105 cl3">
                                                <?= $result['price'] ?>
                                            </span>
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
                        }
                    }
                    ?>
                    </div>

                </div>
        </div>
    </div>
</div>

<?php
require('inc/footer.php');
?>

<?php
require('inc/script.php');
?>