<?php
require('include/header.php');
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
                                    <h1 class="h4 text-gray-900 mb-4">Add Product!</h1>
                                </div>
                                <form class="user" action="addProductProgress.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label">Product name:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name..." required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Images:</label>
                                        <input type="file" class="form-control" id="anhs" name="anhs[]" multiple" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Summary:</label>
                                        <textarea name="summary" class="form-control" placeholder="Enter Summary..." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description:</label>
                                        <textarea name="description" class="form-control" placeholder="Enter Description..." required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-sm-0">
                                            <label class="form-label">Quantity:</label>
                                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity..." required>
                                        </div>
                                        <div class="col-sm-4 mb-sm-0">
                                            <label class="form-label">Standard license price:</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Standard Price..." required>
                                        </div>
                                        <div class="col-sm-4 mb-sm-0">
                                            <label class="form-label">Sale price:</label>
                                            <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Enter Sale price..." required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Category:</label>
                                        <select class="form-control" name="category" required>
                                            <option value="">Choose the Category</option>
                                            <?php
                                            //ket noi database fetch data từ database ra bảng html
                                            require('db/conn.php');
                                            $sql = "select * from categories order by name";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Brand:</label>
                                        <select class="form-control" name="brand" required>
                                            <option value="">Choose the Brand</option>
                                            <?php
                                            //ket noi database fetch data từ database ra bảng html
                                            require('db/conn.php');
                                            $sql = "select * from brands order by name";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div> -->
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