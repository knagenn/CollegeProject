<?php
  require 'header.inc.php';
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
        <strong class="text-black">Orders</strong>
      </div>
    </div>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-size">Size</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total Price</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                    //$query=show_product($con,$user_id);
                    $query=mysqli_query($con,"select orders.*,cart.*,products.* from orders,cart,products 
                                                where orders.cart_id=cart.cart_id && cart.product_id=products.product_id && cart.user_id='$user_id'");
                    foreach($query as $list){
                      $product_image= $list['product_image'];
                      $product_image=explode(",",$product_image);
                  ?>
              <tr>
                <td class="product-thumbnail">
                  <img src="<?php echo PRODUCT_IMAGE_PATH.$product_image[0] ?>" alt="Image" class="img-fluid">
                </td>
                <td class="product-name">
                  <h2 class="h5 text-black"><?php echo $list['product_name'] ?></h2>
                </td>
                <td class="product-name">
                  <h2 class="h5 text-black"><?php echo $list['size'] ?></h2>
                </td>
                <td><?php echo $list['qty'] ?></td>
                <td>
                  <span>$</span>
                  <span id="<?php echo $list['product_id'] ?>"><?php echo $list['total_price'] ?></span>
                </td>
              </tr>
              <?php 
                    } 
                  ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  require 'footer.inc.php';

  //update cart set qty='0',total_price='0' where qty='NaN';
?>