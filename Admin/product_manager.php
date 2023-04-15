<?php
require 'header.inc.php';

if(isset($_GET['type'])){
    $id=$_GET['id'];
    if($_GET['type'] == "delete"){
        $sql=mysqli_query($con,"DELETE FROM `products` WHERE product_id='$id'");
        redirect('product_manager.php');
    }elseif($_GET['type']=="deactive"){
        $sql=mysqli_query($con,"update products set status='0' WHERE product_id='$id'");
        redirect('product_manager.php');
    }elseif($_GET['type']=="active"){
        $sql=mysqli_query($con,"update products set status='1' WHERE product_id='$id'");
        redirect('product_manager.php');
    }else{

    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Manager</h1>
                    <a href="add_products.php">Add Products</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Size</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query=mysqli_query($con,"select * from products");
                                    $i=1;
                                    if(mysqli_num_rows($query)>0){
                                        while($list=mysqli_fetch_assoc($query)){
                                             $image_array= $list['product_image'];
                                             $images=explode(",",$image_array);
                                ?>
                                    <tr style="<?php echo $style ?>">
                                        <td><img src="<?php echo PRODUCT_IMAGE_PATH.$images[0] ?>"
                                                style="width:100px; height:50px" alt=""></td>
                                        <td><?php echo $list['product_id'] ?></td>
                                        <td><?php echo $list['product_name'] ?></td>
                                        <td>$&nbsp;<?php echo $list['product_price'] ?></td>
                                        <td><?php echo $list['product_size']?></td>
                                        <td>
                                            <?php 
                                            if($list['status']==0){
                                                ?>
                                            <a href="?type=active&id=<?php echo $list['product_id'] ?>"
                                                class="badge badge-danger" rel="noopener noreferrer">Deactive</a>
                                            <?php
                                            }elseif($list['status']==1){
                                                ?>
                                            <a href="?type=deactive&id=<?php echo $list['product_id'] ?>"
                                                class="badge badge-success" rel="noopener noreferrer">Active</a>
                                            <?php
                                            }
                                        ?>
                                            <a href="edit_products.php?type=edit&id=<?php echo $list['product_id'] ?>"
                                                target="_blank" class="badge badge-primary"
                                                rel="noopener noreferrer">Edit</a>
                                            <a href="?type=delete&id=<?php echo $list['product_id'] ?>"
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