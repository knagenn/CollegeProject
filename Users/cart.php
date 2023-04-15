<?php
  require 'header.inc.php';
 $query=count_product($con,$user_id);
  if($query==0){
    alert('Cart is Empty');
    redirect('index.php');
  }
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
        <strong class="text-black">Cart</strong>
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
                <th class="product-remove">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                    $query=show_product($con,$user_id);
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
                <td>
                  <div class="input-group mb-3" style="max-width: 120px;">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-primary js-btn-minus" type="button"
                        onclick="qtyFun('<?php echo $user_id ?>','<?php echo $list['product_id'] ?>','<?php echo $list['product_price'] ?>','minus')">&minus;</button>
                    </div>
                    <input type="text" class="form-control text-center" id="qty<?php echo $list['product_id'] ?>"
                      value="<?php echo $list['qty'] ?>"
                      onchange="qtyFun('<?php echo $user_id ?>','<?php echo $list['product_id'] ?>','<?php echo $list['product_price'] ?>','change')"
                      aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary js-btn-plus" type="button"
                        onclick="qtyFun('<?php echo $user_id ?>','<?php echo $list['product_id'] ?>','<?php echo $list['product_price'] ?>','plus')">&plus;</button>
                    </div>
                  </div>

                </td>
                <td>
                  <span>₦</span>
                  <span id="<?php echo $list['product_id'] ?>"><?php echo $list['total_price'] ?></span>
                </td>
                <td>
                  <a href="javascript:void(0)" onclick="deleteFun('<?php echo $list['cart_id'] ?>')"
                    class="btn btn-primary btn-sm">X</a>
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

    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <?php 
                      $query=mysqli_query($con,"select sum(total_price) as t_price from cart where user_id='$user_id' && status='0'");
                      $count=mysqli_fetch_assoc($query);
                    ?>
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">₦<span id="total_price"><?php echo $count['t_price'] ?></span></strong>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="checkoutFun()">Proceed To
                    Checkout</button>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function deleteFun(cart_id) {
    $.ajax({
      url: 'data_transfer.php',
      method: 'post',
      data: `type=cart_delete&cart_id=${cart_id}`,
      success: function (success) {
        if (success == "Success") {
          location.replace('cart.php');
        } else if (success == "Fail") {
          alert('Fail');
        }
      }
    });
  }

  function qtyFun(user_id, product_id, product_price, type) {
    var qty = parseInt($('#qty' + product_id).val());
    if (type == 'minus') {
      if (qty == 1) {
        qty = qty;
      } else {
        qty = qty - 1;
      }
    } else if (type == 'plus') {
      qty = qty + 1;
    } else if (type == 'change') {
      //qty=parse_str(qty);
      if (qty <= 0 || qty == '' || qty == 'NaN') {
        $('#qty' + product_id).val('1');
      } else if (qty.charCodeAt() >= 48 && qty.charCodeAt() <= 57) {
        //qty=qty;
      } else {
        $('#qty' + product_id).val('1');
      }
    }
    qty = parseInt(qty);
    product_price = parseInt(product_price);
    total_price = product_price * qty;
    $.ajax({
      url: 'data_transfer.php',
      method: 'post',
      data: `type=update_qty&qty=${qty}&user_id=${user_id}&product_id=${product_id}&total_price=${total_price}`,
      success: function (result) {
        if (result == "Success") {
          $('#' + product_id).html(total_price);
          $.ajax({
            url: 'data_transfer.php',
            method: 'post',
            data: `type=update_total_price&user_id=${user_id}`,
            success: function (result1) {
              $('#total_price').html(result1);
            }
          });
        }
      }
    });
  }

  function checkoutFun() {
    window.location.href = `checkout.php`;
  }
</script>
<?php
  require 'footer.inc.php';

  //update cart set qty='0',total_price='0' where qty='NaN';
?>