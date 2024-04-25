<?php
ob_start();
require('include/header.php');
?>
<?php include_once('../classes/brand.php'); ?>
<?php
$brands = new Brand();
if (isset($_GET['brandId'])) {
    $id = $_GET['brandId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['name'];
    $update_brand = $brands->updateBrand($brandName, $id);
    if ($update_brand) {
        header('Location: listBrands.php');
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
                                    <h1 class="h4 text-gray-900 mb-4">Update Brand!</h1>
                                </div>
                                <?php
                                if (isset($update_brand)) {
                                    return $update_brand;
                                }
                                ?>
                                <?php
                                $getBrandName = $brands->getBrandById($id);
                                if ($getBrandName) {
                                    while ($result = $getBrandName->fetch_assoc()) {

                                ?>
                                        <form class="user" action="" method="post">
                                            <div class="form-group">
                                                <label class="form-label">Brand name:</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name'] ?>" placeholder="Update Brand Name...">
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