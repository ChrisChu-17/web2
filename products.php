<?php
require('inc/header.php');
?>
<?php include 'classes/product.php';  ?>
<?php include 'classes/category.php';  ?>
<!-- Product -->.

<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <div class="row">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>
                    <?php
                    $category = new category();
                    $show_category = $category->showCategory();

                    if ($show_category) {
                        while ($result = $show_category->fetch_assoc()) {
                    ?>
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 ">
                                <?php echo $result['name'] ?>
                            </button>

                    <?php
                        }
                    }
                    ?>
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


            <!--<div id="search-results">
             <?php include 'search.php'; ?>
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
                                <a href="#" class="filter-link stext-106 trans-04" data-keyword="Default">
                                    Default
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04" data-keyword="Popularity">
                                    Popularity
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04" data-keyword="Average rating">
                                    Average rating
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04 filter-link-active" data-keyword="Newness">
                                    Newness
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04" data-keyword="Price: Low to High">
                                    Price: Low to High
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04" data-keyword="Price: High to Low">
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
                            Brand
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04">
                                    H&M
                                </a>
                            </li>

                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                    LEVIS
                                </a>
                            </li>

                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04">
                                    RALPH LAUREN
                                </a>
                            </li>

                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04">
                                    TOMMY HILFIGER

                                </a>
                            </li>

                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04">
                                    UNIQLO
                                </a>

                            </li>

                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
                                    <i class="zmdi zmdi-circle-o"></i>
                                </span>

                                <a href="#" class="filter-link stext-106 trans-04">
                                    WRANGLER
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col4 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Category
                        </div>

                        <div class="flex-w p-t-4 m-r--5">
                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                TROUSER
                            </a>

                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">

                                t-shirts
                            </a>

                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                accessories
                            </a>

                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                jewelry
                            </a>

                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                underwear
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
            </div>
            <div class="block2">
                <div class="row">
                    <?php if (!$hasSearchResult) {
                        $product = new Product();
                        $show_product = $product->showProduct();
                        if ($show_product) {
                            while ($result = $show_product->fetch_assoc()) {
                                // Hiển thị danh sách sản phẩm ở đây
                    ?>

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="grid_1_of_4 images_1_of_4">
                                        <div class="block2-pic hov-img0">
                                            <a href="details.php?proid=<?php echo $result['id'] ?>"><?php echo $product->imgProcessForUser($result['pimg'], 200, 200, 'img-fluid') ?></a>
                                            <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                                Quick View
                                            </a>
                                        </div>
                                        <h5 class="text-muted mt-3 mb-1"><?php echo $result['pname'] ?></h5>
                                        <p><span class="price"><?php echo $result['price'] ?>VND</span></p>


                                        <div class="button"><span><a href=""></a></span></div>
                                    </div>
                                </div>
                    <?php        }
                        }
                    }
                    ?>
                </div>
            </div>


            <!--<div class="block2">
       
            <div class="row">
                <?php
                $product = new Product();
                $show_product = $product->showProduct();
                if ($show_product) {
                    while ($result = $show_product->fetch_assoc()) {
                ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="grid_1_of_4 images_1_of_4">
                                <div class="block2-pic hov-img0">
                                    <a href="details.php?proid=<?php echo $result['id'] ?>"><?php echo $product->imgProcessForUser($result['pimg'], 200, 200, 'img-fluid') ?></a>
                                    <a href="details.php?proid=<?php echo $result['id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                        Quick View
                                    </a>
                                </div>
                                <h5 class="text-muted mt-3 mb-1"><?php echo $result['pname'] ?></h5>
                                    <p><span class="price"><?php echo $result['price'] ?>VND</span></p>


                                    <div class="button"><span><a href=""></a></span></div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div> -->
    </div>
</div>

<!-- Load more -->
<div class="flex-c-m flex-w w-full p-t-45">
    <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
        Load More
    </a>
</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="path/to/your/isotope.pkgd.min.js"></script>

<?php
require('inc/footer.php');
?>

<?php
require('inc/script.php');
?>