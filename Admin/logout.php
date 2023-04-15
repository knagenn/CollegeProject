<?php
require '../connection.php';
require '../function.inc.php';
unset($_SESSION['ADMIN_ID']);
redirect('../admin_login.php');
?>