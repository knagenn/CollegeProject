<?php
require '../connection.php';
require '../function.inc.php';
if (!isset($_SESSION['user_id'])) {
  redirect('../index.php');
}

$email = $_SESSION['user_id'];
$query = mysqli_query($con, "select * from users where email='$email'");
$list = mysqli_fetch_assoc($query);

$user_id = $list['id'];
$name = $list['name'];
$phone = $list['phone'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoppers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-3.3.1.min.js"></script>

</head>
<style>
  .logo_head {
    width: 150px !important;
  }
</style>

<body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">Shoppers</a>
              </div>
            </div>
            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li class="mr-2">
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count" id="cart_count">0</span>
                    </a>
                  </li>
                  <li class="mr-2"><a href="orders.php"><span class="icon-shopping-bag"></span></a></li>
                  <li class="mr-2"><a href="logout.php"><span class="icon-sign-out"></span></a></li>
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="home_tab active"><a href="index.php">Home</a></li>
            <?php
            $query = mysqli_query($con, "select * from categories limit 8");
            while ($list = mysqli_fetch_assoc($query)) {
            ?>
              <li class="<?php echo $list['cat_name'] ?>"><a href="total_prd.php?cat_id=<?php echo $list['cat_id'] ?>" id="<?php echo $list['cat_name'] ?>"><?php echo $list['cat_name'] ?></a></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </nav>
    </header>
    <script>
      var username = "<?php echo $user_id ?>";
      window.setInterval(function() {
        $.ajax({
          url: 'data_transfer.php',
          type: 'post',
          data: `type=get_notification&username=${username}`,
          success: function(success) {
            if (success == 0) {
              $('#cart_count').html('0');
            } else {
              $('#cart_count').html(success);
            }
          }
        });
      }, 2000);
    </script>