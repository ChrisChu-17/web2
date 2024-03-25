<?php
require('include/header.php');
?>

<div>
    <!-- <h3>Danh sách thương hiệu</h3> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thể loại</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        //ket noi database fetch data từ database ra bảng html
                        require('db/conn.php');
                        $sql = "select * from categories order by name";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['slug']; ?></td>
                                <td><?= $row['status']; ?></td>
                                <td><a href="deleteCats.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa Category này?');">Delete</a> <a href="" class="btn btn-warning">Edit</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
require('include/footer.php');
?>