<?php
require('include/header.php');
?>
<?php include '../classes/category.php';  ?>
<?php
// gọi class category
$category = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $catName = $_POST['name'];
    $insertCat = $category->insertCategory($catName); // hàm check catName khi submit lên
}
?>
<div>
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Category!</h1>
                                </div>
                                <?php
                                if (isset($insertCat)) {
                                    echo $insertCat;
                                }
                                ?>
                                <form class="user" action="addCats.php" method="post">
                                    <div class="form-group">
                                        <label class="form-label">Category name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name...">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit" class="form-control">
                                        Save
                                    </button>
                                    <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
require('include/footer.php');
?>