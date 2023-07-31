<?php
require 'connection.php';
require 'function.inc.php';
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"select * from users where email='$email' && password='$password'");
    if(mysqli_num_rows($query)==1){
        $_SESSION['user_id']=$email;
        // alert('You are Looged In');
        redirect('Users/index.php');
    }else{
        alert('Login Failed');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
</head>

<body>
    <main>
        <div class="container shadow-lg">
            <div class="row">
                
                <div class="col-sm-6 login-section-wrapper ">
                    <div class="login-wrapper my-auto">
                        <h1 class="display-3 mb-5 text-center h1">Log In</h1>
                        <form action="" method="post">
                            <div class="form-group mb-4">
                                <label style="font-size: 17px"for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Your Email">
                            </div>
                            <div class="form-group mb-5">
                                <label style="font-size: 17px"for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Your Passsword">
                            </div>
                            <input name="submit" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                        </form>
                        <p style="color:red;font-size: 17px">
                        Don't Have Any Account? 
                            <a href="register.php">Register Here</a>
                        </p>

                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block" >
                    <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
    <style>
        body {
            font-family: "Karla", sans-serif;
            background-color: #fff;
            min-height: 100vh;
        }

        .brand-wrapper {
            padding-top: 7px;
            padding-bottom: 8px;
        }

        .brand-wrapper .logo {
            height: 25px;
        }

        .login-section-wrapper {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            padding: 68px 100px;
            background-color: #fff;
        }

        @media (max-width: 991px) {
            .login-section-wrapper {
                padding-left: 50px;
                padding-right: 50px;
            }
        }

        @media (max-width: 575px) {
            .login-section-wrapper {
                padding-top: 20px;
                padding-bottom: 20px;
                min-height: 100vh;
            }
        }

        .login-wrapper {
            width: 300px;
            max-width: 100%;
            padding-top: 24px;
            padding-bottom: 24px;
        }

        @media (max-width: 575px) {
            .login-wrapper {
                width: 100%;
            }
        }

        .login-wrapper label {
            font-size: 14px;
            font-weight: bold;
            color: #b0adad;
        }

        .login-wrapper .form-control {
            border: none;
            border-bottom: 1px solid #e7e7e7;
            border-radius: 0;
            padding: 9px 5px;
            min-height: 40px;
            font-size: 18px;
            font-weight: normal;
        }

        .login-wrapper .form-control::-webkit-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::-moz-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control:-ms-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::-ms-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::placeholder {
            color: #b0adad;
        }

        .login-wrapper .login-btn {
            padding: 13px 20px;
            background-color: #fdbb28;
            border-radius: 0;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 14px;
        }

        .login-wrapper .login-btn:hover {
            border: 1px solid #fdbb28;
            background-color: #fff;
            color: #fdbb28;
        }

        .login-wrapper a.forgot-password-link {
            color: #080808;
            font-size: 14px;
            text-decoration: underline;
            display: inline-block;
            margin-bottom: 54px;
        }

        @media (max-width: 575px) {
            .login-wrapper a.forgot-password-link {
                margin-bottom: 16px;
            }
        }

        .login-wrapper-footer-text {
            font-size: 16px;
            color: #000;
            margin-bottom: 0;
        }

        .login-title {
            font-size: 30px;
            color: #000;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .login-img {
            border:none;
            object-fit:cover;
            width:500px;
            height:500px;
            margin-top:50px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>