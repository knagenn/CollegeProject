<?php
require 'connection.php';
require 'function.inc.php';
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(mysqli_num_rows(mysqli_query($con,"select * from admin where username='$username' && password='$password'"))==1){
      $_SESSION['ADMIN_ID']=1;
        redirect('Admin/index.php');
    }else{
        alert('Credentials Invalid');
        redirect('admin_login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="Admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="Admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="admin_login.php" class="h1"><b>Admin Login</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="Admin/plugins/jquery/jquery.min.js"></script>
  <script src="Admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Admin/dist/js/adminlte.min.js"></script>
</body>

</html>