<?php
$con=mysqli_connect('localhost','root','','shopping');


session_start();
session_regenerate_id();


define('SITE_PATH','https://localhost/E-commerce/');

define('PRODUCT_IMAGE_PATH',SITE_PATH.'Users/images/');
?>