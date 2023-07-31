
<?php
require 'header.inc.php';
?>
<div class="site-blocks-cover" style="background-image: url(https://source.unsplash.com/random/?sneakers);object-fit: cover;" data-aos="fade">
  <div class="container">
    <div class="row align-items-start align-items-md-center justify-content-end">
      <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
        <h1 class="mb-2" style="color:white;text-shadow: 2px 2px 5px black;font-size:80px;">"BeLIeVe Us, We DeLIVer The BEST"</h1>
        <div class="intro-text text-center text-md-left">
          <p class="mb-4" style="color:white; font-weight:bold;text-shadow: 2px 2px 5px black">"Who knew the perfect fit could be found in a box"</p>
          <p>
            <a href="#" class="btn btn-sm btn-primary" >Get Your OWN :)</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="site-section block-3 site-blocks-2 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 site-section-heading text-center pt-4">
        <h2 style="font-family: 'Times New Roman', serif;font-size:50px">Products</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="nonloop-block-3 owl-carousel home">
          <?php 
            $query=mysqli_query($con,"select * from products where status='1'");
            $i=1;
            while($list=mysqli_fetch_assoc($query)){
              $image=$list['product_image'];
              $image_arr=explode(",",$image);
          ?>
          <div class="item">
            <div class="block-4 text-center">
              <figure class="block-4-image">
                <a href="product_detail.php?id=<?php echo $list['product_id'] ?>">
                  <img src="<?php echo PRODUCT_IMAGE_PATH.$image_arr[0] ?>" alt="Image placeholder" class="img-fluid">
                </a>
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="product_detail.php?id=<?php echo $list['product_id'] ?>"><?php echo $list['product_name'] ?></a></h3>
                <p class="mb-0"><?php echo $list['product_description'] ?></p>
                <p class="text-primary font-weight-bold"><?php echo $list['product_price'] ?></p>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require 'footer.inc.php';
?>