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
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Manager</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Size</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Street</th>
                                        <th>Country</th>
                                        <th>Zip</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query=mysqli_query($con,"select orders.*,cart.*,products.* from orders,cart,products where orders.cart_id=cart.cart_id && cart.product_id=products.product_id");
                                        while($list=mysqli_fetch_assoc($query)){
                                            ?>
                                            <tr>
                                            <td><?php echo $list['product_name'] ?></td>
                                            <td>$&nbsp;<?php echo $list['total_price'] ?></td>
                                            <td><?php echo $list['qty'] ?></td>
                                            <td><?php echo $list['size'] ?></td>
                                            <td><?php echo $list['first_name'].' '.$list['last_name'] ?></td>
                                            <td><?php echo $list['email'] ?></td>
                                            <td><?php echo $list['phone'] ?></td>
                                            <td><?php echo $list['address'] ?></td>
                                            <td><?php echo $list['address2'] ?></td>
                                            <td><?php echo $list['address2'] ?></td>
                                            <td><?php echo $list['address2'] ?></td>
                                            <td><?php echo $list['status'] ?></td>
                                            </tr>
                                            <?php
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