<?php
require 'header.inc.php';

if(isset($_GET['type'])){
    $id=$_GET['id'];
    if($_GET['type'] == "delete"){
        $sql=mysqli_query($con,"DELETE FROM `categories` WHERE cat_id='$id'");
        redirect('category_manager.php');
    }elseif($_GET['type']=="deactive"){
        $sql=mysqli_query($con,"update categories set status='0' WHERE cat_id='$id'");
        redirect('category_manager.php');
    }elseif($_GET['type']=="active"){
        $sql=mysqli_query($con,"update categories set status='1' WHERE cat_id='$id'");
        redirect('category_manager.php');
    }else{

    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Manager</h1>
                    <a href="add_categories.php">Add Categories</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Category Name</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query=mysqli_query($con,"select * from categories");
                                    $i=1;
                                    if(mysqli_num_rows($query)>0){
                                        while($list=mysqli_fetch_assoc($query)){
                                ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $list['cat_name'] ?></td>
                                        <td>
                                            <?php 
                                            if($list['status']==0){
                                                ?>
                                            <a href="?type=active&id=<?php echo $list['cat_id'] ?>"
                                                class="badge badge-danger" rel="noopener noreferrer">Deactive</a>
                                            <?php
                                            }elseif($list['status']==1){
                                                ?>
                                            <a href="?type=deactive&id=<?php echo $list['cat_id'] ?>"
                                                class="badge badge-success" rel="noopener noreferrer">Active</a>
                                            <?php
                                            }
                                        ?>
                                            <a href="add_categories.php?type=edit&id=<?php echo $list['cat_id'] ?>"
                                                class="badge badge-primary"
                                                rel="noopener noreferrer">Edit</a>
                                            <a href="add_products.php?type=delete&id=<?php echo $list['cat_id'] ?>"
                                                class="badge badge-danger"
                                                rel="noopener noreferrer">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function status_change(id) {
        var status = $('#status').val();
        $.ajax({
            url: 'data_transfer.php',
            method: 'post',
            data: `type=update_status&action=land&status=${status}&id=${id}`,
            success: function (result) {
                console.log(result);
            }
        });
    };
</script>
<?php
require 'footer.inc.php';

?>