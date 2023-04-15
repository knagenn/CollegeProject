<?php
require 'header.inc.php';
$cat_name="";
if(isset($_GET['type'])){
    $id=$_GET['id'];
    if($_GET['type'] == "delete"){
        $sql=mysqli_query($con,"DELETE FROM `categories` WHERE cat_id='$id'");
        alert('Deleted Successfully');
        redirect('category_manager.php');
    }elseif($_GET['type']=="deactive"){
        $sql=mysqli_query($con,"update categories set status='0' WHERE cat_id='$id'");
        alert('Updated Successfully');
        redirect('category_manager.php');
    }elseif($_GET['type']=="active"){
        $sql=mysqli_query($con,"update categories set status='1' WHERE cat_id='$id'");
        alert('Updated Successfully');
        redirect('category_manager.php');
    }elseif($_GET['type']=="edit"){
        $sql=mysqli_query($con,"select * from categories WHERE cat_id='$id'");
        $list=mysqli_fetch_assoc($sql);
        $cat_name=$list['cat_name'];
    }else{

    }
}
if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];
    $query = mysqli_query($con,"INSERT INTO categories(cat_name,status) 
        VALUES('$cat_name','0')");
        if ($query){
            alert('Added Successfully');
            redirect('category_manager.php');
        }
        else{
            alert('Failed to Add');
            redirect('category_manager.php');
        }
    }
    if(isset($_POST['update'])){
        $cat_name = $_POST['cat_name'];
        $query = mysqli_query($con,"update categories set cat_name='$cat_name' WHERE cat_id='$id'");
            if ($query){
                alert('Updated Successfully');
                redirect('category_manager.php');
            }
            else{
                alert('Failed to Add');
                redirect('category_manager.php');
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
                    <h1>Products</h1>
                    <a href="product_manager.php">Show Product</a>
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
                <div class="col-12 add_div">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Category Manager</h3>
                        </div>
                        <form action="" method="post" id="add_cat">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                            <input name="cat_name" type="text" placeholder="Category Name"
                                                class="form-control" value="<?php echo $cat_name ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                <?php 
                                    if(isset($_GET['type'])){
                                        if($_GET['type']=="edit"){
                                ?>
                                    <button type="submit" name="update"
                                        class="form-control btn btn-primary">Update</button>
                                    <?php }}else{
                                        ?>
                                        <button type="submit" name="submit"
                                        class="form-control btn btn-primary">Submit</button>
                                        <?php
                                    } ?>
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
    $('#add_cat').validate({
        rules: {
            cat_name: {
                required:true,
                minlength:3,
                maxlength:10
            },
        },
        messages: {
            cat_name: {
                required:"Category Name Cannot be left Blank",
                minlength:"Minimum 3 Characters Required",
                maxlength:"Maximum 10 Characters allowed",
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