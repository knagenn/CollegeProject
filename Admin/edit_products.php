<?php
require 'header.inc.php';

if(isset($_GET['type'])){
    $id=$_GET['id'];
    if($_GET['type'] == "edit"){
        $sql=mysqli_query($con,"SELECT * FROM `products` WHERE product_id='$id'");
        $list=mysqli_fetch_assoc($sql);
        $product_name=$list['product_name'];
        $product_price=$list['product_price'];
        $product_description=$list['product_description'];

        if(isset($_POST['submit'])){
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_description = $_POST['product_description'];
            $query = mysqli_query($con,"update products set product_name='$product_name',product_price='$product_price',product_description='$product_description' where product_id='$id'");
            if ($query){
                alert('Updated Successfully');
                redirect('product_manager.php');
            }
            else{
                alert('Failed to Updated');
                redirect('product_manager.php');
            }
        }else{
        
        }
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
                    <h1>Edit Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                <div class="col-12 add_div">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Manager</h3>
                        </div>
                        <form action="" method="post" id="add_products" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Select Category</label>
                                            <select name="cat" id="" class="form-control">
                                                <option value="0">Select Category</option>
                                                <?php 
                                                    //$query=mysqli_query($con,"select * from categories limit 8");
                                                    //while($list=mysqli_fetch_assoc($query)){
                                                ?>
                                                <option value="<?php //echo $list['cat_id'] ?>"><?php //echo $list['cat_name'] ?></option>
                                                <?php
                                                    //}
                                                ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                            <input name="product_name" type="text" placeholder="Product Name"
                                                class="form-control" value="<?php echo $product_name ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Product Price</label>
                                            <input name="product_price" type="text" placeholder="₦"
                                                class="form-control" value="<?php echo $product_price ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Product Size</label><br>
                                            <div class="form-check-inline form-check">
                                                <label for="inline-checkbox1" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox1" name="product_size[]"
                                                        value="Small" class="form-check-input">Small
                                                </label>
                                                <label for="inline-checkbox2" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox2" name="product_size[]"
                                                        value="Medium" class="form-check-input">Medium
                                                </label>
                                                <label for="inline-checkbox3" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox3" name="product_size[]"
                                                        value="Large" class="form-check-input">Large
                                                </label>
                                                <label for="inline-checkbox3" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox4" name="product_size[]"
                                                        value="Extra Large" class="form-check-input">Extra Large
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Upload Image(s)</label>
                                            <input type="file" id='files' name="image_files[]"
                                                name="file-multiple-input" multiple="" class="form-control-file">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="product_description" id="features" type="text"
                                        placeholder="Features" class="form-control"><?php echo $product_description ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="submit"
                                        class="form-control btn btn-primary">Update</button>
                                </div>
                                <div id="result"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#add_products').validate({
        rules: {
            product_name: {
                required:true,
                minlength:3,
                maxlength:10
            },
            product_price: {
                required:true,
                maxlength:5,
            },
            
            'image_files[]': {
                required:true,
                extension: "jpg|png|jpeg",
            },
            product_description: {
                required:true,
                minlength:5,
                maxlength:100,
            },
        },
        messages: {
            product_name: {
                required:"Product Name Cannot be left Blank",
                minlength:"Minimum 3 Characters Required",
                maxlength:"Maximum 10 Characters allowed",
            },
            product_price: {
                required:"Product Price Cannot be left Blank",
                maxlength:"Maximum 5 Characters allowed",
            },
            
            'image_files[]': {
                required:"Product Image Required",
                extension: "Extensions allowed are jpg,jpeg,png",
            },
            product_description: {
                required:"Product Description Cannot be left Blank",
                minlength:"Minimum 5 Characters Required",
                maxlength:"Maximum 100 Characters allowed",
            },
        },
        submitHandler: function(form){
            form.submit();
        }
    });
</script>
<?php
require 'footer.inc.php';

?>