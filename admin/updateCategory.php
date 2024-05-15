<?php
ob_start();
require('include/header.php');
?>
<?php include_once('../classes/category.php'); ?>
<?php
$category = new Category();
if (isset($_GET['catId'])) {
    $id = $_GET['catId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['name'];
    $update_category = $category->updateCategory($catName, $id);
    if ($update_category) {
        header('Location: listCats.php');
        exit;
    }
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
                                    <h1 class="h4 text-gray-900 mb-4">Update Category!</h1>
                                </div>
                                <?php
                                if (isset($update_category)) {
                                    return $update_category;
                                }
                                ?>
                                <?php
                                $getCategoryName = $category->getCatById($id);
                                if ($getCategoryName) {
                                    while ($result = $getCategoryName->fetch_assoc()) {

                                ?>
                                        <form class="user" action="" method="post">
                                            <div class="form-group">
                                                <label class="form-label">Category name:</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name'] ?>" placeholder="Update Category Name...">
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit" name="submit" class="form-control">
                                                Save
                                            </button>
                                            <hr>
                                        </form>
                                <?php
                                    }
                                }
                                ?>
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
ob_end_flush();
?>