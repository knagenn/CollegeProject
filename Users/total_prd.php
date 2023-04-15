<?php
  require 'header.inc.php';
?>
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
          class="text-black">Shop</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-9 order-2">

        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="float-md-left mb-4">
              <h2 class="text-black h5">Shop All</h2>
            </div>
            <div class="d-flex">
              <div class="dropdown mr-1 ml-md-auto">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Latest
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                <?php 
                  $query=mysqli_query($con,"select * from categories order by cat_name desc limit 5");
                  while($list=mysqli_fetch_assoc($query)){
                ?>
                  <a class="dropdown-item" href="total_prd.php?cat_id=<?php echo $list['cat_id'] ?>"><?php echo $list['cat_name'] ?></a>
                  <?php
                    }
                  ?>
                </div>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference"
                  data-toggle="dropdown">Reference</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                  <a class="dropdown-item" href="total_prd.php?cat_id=<?php echo $_GET['cat_id'] ?>&order=true&product_name=asc">Name, A to Z</a>
                  <a class="dropdown-item" href="total_prd.php?cat_id=<?php echo $_GET['cat_id'] ?>&order=true&product_name=desc">Name, Z to A</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="total_prd.php?cat_id=<?php echo $_GET['cat_id'] ?>&order=true&product_price=asc">Price, low to high</a>
                  <a class="dropdown-item" href="total_prd.php?cat_id=<?php echo $_GET['cat_id'] ?>&order=true&product_price=desc">Price, high to low</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">

        <?php 
        $sql="select * from products where cat_id={$_GET['cat_id']} && status='1' ";
        if(isset($_GET['order']) && $_GET['order']=="true"){
          if(isset($_GET['product_name'])){
            $sql.="ORDER BY product_name {$_GET['product_name']}";
          }
          if(isset($_GET['product_price'])){
            $sql.="ORDER BY product_price {$_GET['product_price']}";
          }
        }
        
        $query=mysqli_query($con,$sql);
        while($list=mysqli_fetch_assoc($query)){
          $image=$list['product_image'];
              $image_arr=explode(",",$image);
          ?>
          <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="block-4 text-center border">
              <figure class="block-4-image">
                <a href="product_detail.php?id=<?php echo $list['product_id'] ?>"><img  src="<?php echo PRODUCT_IMAGE_PATH.$image_arr[0] ?>" alt="Image placeholder" class="img-fluid"></a>
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="product_detail.php?id=<?php echo $list['product_id'] ?>"><?php echo $list['product_name'] ?></a></h3>
                <p class="mb-0"><?php echo $list['product_description'] ?></p>
                <p class="text-primary font-weight-bold">$<?php echo $list['product_price'] ?></p>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
        </div>
      </div>

      <div class="col-md-3 order-1 mb-5 mb-md-0">
        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
          <ul class="list-unstyled mb-0">
          <?php 
              $query=mysqli_query($con,"select * from categories");
              while($list=mysqli_fetch_assoc($query)){
                $query2=mysqli_query($con,"select * from products where cat_id={$list['cat_id']} && status='1'");
                $num=mysqli_num_rows($query2);
            ?>
                  <li class="mb-1"><a href="total_prd.php?cat_id=<?php echo $list['cat_id'] ?>" class="d-flex"><span><?php echo $list['cat_name'] ?></span> <span
                  class="text-black ml-auto">(<?php echo $num ?>)</span></a></li>
            <?php
              }
            ?>
          </ul>
        </div>

        <div class="border p-4 rounded mb-4">
          <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
            <div id="slider-range" class="border-primary"></div>
            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
          </div>

          <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
            <label for="s_sm" class="d-flex">
              <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
            </label>
            <label for="s_md" class="d-flex">
              <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
            </label>
            <label for="s_lg" class="d-flex">
              <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
            </label>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
<?php
  require 'footer.inc.php';
?>