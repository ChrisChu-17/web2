<?php
require('include/header.php');
?>
<?php include '../classes/brand.php';  ?>
<?php

$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $brandName = $_POST['name'];
    $insertBrand = $brand->insertBrand($brandName); // hàm check catName khi submit lên
    if(isset($insertBrand)) {
       header("Location: listBrands.php"); 
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
                                    <h1 class="h4 text-gray-900 mb-4">Add Brand!</h1>
                                </div>
                                <?php
                                if (isset($insertBrand)) {
                                    echo $insertBrand;
                                }
                                ?>
                                <form class="user" action="addBrands.php" method="post">
                                    <div class="form-group">
                                        <label class="form-label">Brand name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand Name...">
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