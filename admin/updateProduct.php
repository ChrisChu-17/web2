<?php
ob_start();
require('include/header.php');
?>
<?php include_once('../classes/product.php'); ?>
<?php include_once('../classes/category.php'); ?>
<?php include_once('../classes/brand.php'); ?>
<?php
$product = new Product();
if (!isset($_GET['proId'])) {
    echo "<script> window.location = 'listProduct.php' </script>";
} else {
    $id = $_GET['proId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update_product = $product->updateProduct($_POST, $_FILES, $id);
    
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
                                if (isset($update_product)) {
                                    return $update_product;
                                }
                                ?>
                                <?php
                                $getProductName = $product->getProductById($id);
                                if ($getProductName) {
                                    while ($result = $getProductName->fetch_assoc()) {

                                ?>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="form-label">Product name:</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Images:</label>
                                                <input type="file" class="form-control" id="anhs" name="anhs[]" multiple">
                                                <img src="uploads/<?php echo $result['images']; ?>" width="100"><br>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Summary:</label>
                                                <textarea name="summary" class="form-control"><?php echo $result['summary'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description:</label>
                                                <textarea name="description" class="form-control"><?php echo $result['description'] ?></textarea>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-sm-0">
                                                    <label class="form-label">Quantity:</label>
                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $result['stock'] ?>">
                                                </div>
                                                <div class="col-sm-4 mb-sm-0">
                                                    <label class="form-label">Standard license price:</label>
                                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $result['price'] ?>">
                                                </div>
                                                <div class="col-sm-4 mb-sm-0">
                                                    <label class="form-label">Sale price:</label>
                                                    <input type="text" class="form-control" id="sale_price" name="sale_price" value="<?php echo $result['price'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Category:</label>
                                                <select class="form-control" name="category">
                                                    <option value=""></option>
                                                    <?php
                                                    $cats = new Category();
                                                    $catList = $cats->showCategory();
                                                    if ($catList) {
                                                        while ($catResult = $catList->fetch_assoc()) {
                                                            $selected = ($catResult['id'] == $result['category_id']) ? "selected" : "";
                                                    ?>
                                                            <option value="<?php echo $catResult['id']; ?>" <?php echo $selected; ?>><?php echo $catResult['name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Brand:</label>
                                                <select class="form-control" name="brand">
                                                    <option value=""></option>
                                                    <?php
                                                    $brands = new Brand();
                                                    $brandList = $brands->showBrand();
                                                    if ($brandList) {
                                                        while ($brandResult = $brandList->fetch_assoc()) {
                                                            $selected = ($brandResult['id'] == $result['brand_id']) ? "selected" : "";
                                                    ?>
                                                            <option value="<?php echo $brandResult['id']; ?>" <?php echo $selected; ?>><?php echo $brandResult['name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" name="submit" type="submit" class="form-control">
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