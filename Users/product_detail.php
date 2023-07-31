<?php 
require 'header.inc.php';
//require 'add_to_cart.inc.php';
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Tank Top T-Shirt</strong></div>
    </div>
  </div>
</div>
<?php
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query=mysqli_query($con,"select * from products where product_id='$id'");
    $list=mysqli_fetch_assoc($query);
     $product_id=$list['product_id'];
     $product_name=$list['product_name'];
     $product_description=$list['product_description'];
     $product_price=$list['product_price'];
     $product_image=$list['product_image'];
     $product_size=$list['product_size'];
  }
?>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div id="demo" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <?php 
              $image_arr=explode(",",$product_image);
              $i=0;
              $k=0;
              $count=count($image_arr);
              for($j=0; $i<=$count;$j++){
            ?>
            <li data-target="#demo" data-slide-to="<?php echo $k++ ?>" id="slider<?php echo $i++ ?>"></li>
            <?php 
              } 
            ?>
          </ul>
          <!-- The slideshow -->
          <div class="carousel-inner">
            <?php 
              $image_arr=explode(",",$product_image);             
              $i=0;
              foreach($image_arr as $list){    
            ?>
            <div class="carousel-item" id="custom<?php echo $i++ ?>">
              <img src="<?php echo PRODUCT_IMAGE_PATH.$list ?>" alt="Image" class="img-fluid">
            </div>
            <?php 
              }
            ?>
          </div>
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="text-black"><?php echo $product_name ?></h2>
        <p><?php echo $product_description ?></p>
        <p><strong class="text-primary h4">$<span id="product_price"><?php echo $product_price ?><span></strong></p>
        <div class="mb-1">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <select id="size" class="form-control">
                  <?php
                    $product_size=explode(',',$product_size);
                    $i=1;
                    foreach($product_size as $checkbox){
                  ?>
                  <option value="<?php echo $checkbox ?>"><?php echo $checkbox ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="mb-5">
          <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" class="form-control text-center" readonly id="qty" value="1" placeholder=""
              aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
          </div>

        </div>
        <p><a href="javascript:void(0)" onclick="addToCart('<?php echo $product_id ?>','<?php echo $user_id ?>')"
            class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    var carousel = $('#custom0');
    carousel.addClass("active");
  });

  function addToCart(product_id, user_id) {
    var size = $('#size').val();
    var qty = $('#qty').val();
    var product_price = $('#product_price').html();
    product_price = parseInt(product_price);
    var total_price = product_price * qty;
    $.ajax({
      url: 'data_transfer.php',
      method: 'POST',
      data: `type=add_to_cart&product_id=${product_id}&user_id=${user_id}&size=${size}&qty=${qty}&total_price=${total_price}`,
      success: function (result) {
        console.log(user_id);
      }
    })
  }
  $('#qty').change(function () {
    if ($('#qty').val() <= 0)
      $('#qty').val('1');
  });
</script>
<?php 
require 'footer.inc.php'
?>