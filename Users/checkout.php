<?php
require 'header.inc.php';
?>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a
          href="cart.php">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-5 mb-md-0">
        <h2 class="h3 mb-3 text-black">Billing Details</h2>
        <div class="p-3 p-lg-5 border">
          <!-- <div class="form-group">
            <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
            <select id="c_country" class="form-control">
              <option value="1">Select a country</option>
              <option value="2">bangladesh</option>
              <option value="3">Algeria</option>
              <option value="4">Afghanistan</option>
              <option value="5">Ghana</option>
              <option value="6">Albania</option>
              <option value="7">Bahrain</option>
              <option value="8">Colombia</option>
              <option value="9">Dominican Republic</option>
            </select>
          </div> -->
          <form action="" method="post">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_fname" name="fname">
              </div>
              <div class="col-md-6">
                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_lname" name="lname">
              </div>
            </div>
            <div class="form-group row mb-5">
              <div class="col-md-6">
                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_email_address" name="email">
              </div>
              <div class="col-md-6">
                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number">
              </div>
            </div>
            <!-- <div class="form-group row">
            <div class="col-md-12">
              <label for="c_companyname" class="text-black">Company Name </label>
              <input type="text" class="form-control" id="c_companyname" name="c_companyname">
            </div>
          </div> -->

            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_address" name="address" placeholder="Street address">
              </div>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="street" placeholder="Apartment, suite, unit etc. (optional)">
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_state_country" class="text-black">State / Country <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control" id="state_country" name="state">
              </div>
              <div class="col-md-6">
                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="postal" name="postal">
              </div>
            </div>


        </div>
      </div>
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Your Order</h2>
            <div class="p-3 p-lg-5 border">
              <table class="table site-block-order-table mb-5">
                <thead>
                  <th>Product</th>
                  <th>Total</th>
                </thead>
                <tbody>
                  <?php
                    $query=show_product($con,$user_id);
                    $data = array();
                      foreach($query as $list){
                        $data[] = $list['cart_id'];
                  ?>
                  <tr>
                    <td><?php echo $list['product_name'] ?><strong class="mx-2">x</strong><?php echo $list['qty'] ?>
                    </td>
                    <td>$&nbsp;<?php echo $list['total_price'] ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                    <?php
                      $query=mysqli_query($con,"select sum(total_price) as t_price from cart where user_id='$user_id' && status='0'");
                      $count=mysqli_fetch_assoc($query);
                      $_SESSION['t_price']=$count['t_price'];
                    ?>
                    <td class="text-black font-weight-bold"><strong>$&nbsp;<?php echo $count['t_price'] ?></strong></td>
                  </tr>
                </tbody>
              </table>

              <div class="form-group">
                <button type="button" class="btn btn-primary btn-lg py-3 btn-block" id="place_order">Place Order</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $data=json_encode($data); ?>
<script>
  $('#place_order').click(function(){
    var cart_ids='<?php echo $data ?>';
    var user_id='<?php echo $user_id ?>'
    var fname = $("input[name='fname']").val();
    var lname = $("input[name='lname']").val();
    var email = $("input[name='email']").val();
    var phone = $("input[name='phone']").val();
    var address = $("input[name='address']").val();
    var address2 = $("input[name='street']").val();
    var state = $("input[name='state']").val();
    var postal = $("input[name='postal']").val();
    //console.log(cart_ids);
    $.ajax({
      url:'data_transfer.php',
      method:'post',
      data:`type=checkout&cart_ids=${cart_ids}&user_id=${user_id}&fname=${fname}&lname=${lname}
      &email=${email}&phone=${phone}&address=${address}&address2=${address2}&state=${state}&postal=${postal}`,
      success:function(result){
        location.replace('thankyou.php');
      }
    }) ;
})
</script>
<?php
require 'footer.inc.php';
?>