<?php
require '../connection.php';
require '../function.inc.php';
unset($_SESSION['user_id']);
redirect('../index.php')
?>