<?php
require '../connection.php';
require '../function.inc.php';
if(isset($_POST['type'])){
    if($_POST['type']=="add_to_cart"){
        $user_id=$_POST['user_id'];
        $product_id=$_POST['product_id'];
        $size=$_POST['size'];
        $qty=$_POST['qty'];
        $total_price=$_POST['total_price'];
        $query=mysqli_query($con,"select * from cart where product_id='$product_id' && user_id='$user_id'");
        if(mysqli_num_rows($query)==1){
            echo "update cart set size='$size',qty='$qty',total_price='$total_price' 
            where product_id='$product_id' && user_id='$user_id')";
            $query=mysqli_query($con,"update cart set size='$size',qty='$qty',total_price='$total_price' 
            where product_id='$product_id' && user_id='$user_id'");
        }else{
            $query=mysqli_query($con,"insert into cart(user_id,product_id,size,qty,total_price) 
            values('$user_id','$product_id','$size','$qty','$total_price')");
        }
    if($query){
        echo "success";
    }else{
        echo "fail";
    }
    }
    elseif($_POST['type']=="get_notification"){
        $username=$_POST['username'];
        $query=mysqli_query($con,"select * from cart where status='0' && user_id='$username'");
        $count=mysqli_num_rows($query);
        echo $count;
    }
    elseif($_POST['type']=="cart_delete"){
        $cart_id=$_POST['cart_id'];
        $query=mysqli_query($con,"delete from cart where cart_id='$cart_id'");
        if($query){
            echo "Success";
        }else{
            echo "Fail";
        }
    }elseif($_POST['type']=="update_qty"){
        $qty=$_POST['qty'];
        $user_id=$_POST['user_id'];
        $product_id=$_POST['product_id'];
        $total_price=$_POST['total_price'];
        $query=mysqli_query($con,"update cart set qty='$qty',total_price='$total_price' where user_id='$user_id' && product_id='$product_id'");
        if($query){
            echo "Success";
        }else{
            echo "Fail";
        }
    }elseif($_POST['type']=="update_total_price"){
        $user_id=$_POST['user_id'];
        $query=mysqli_query($con,"select sum(total_price) as t_price from cart where user_id='$user_id'");
        $count=mysqli_fetch_assoc($query);
        if($query){
            echo $count['t_price'];
        }else{
            echo "Fail";
        }
    
    }elseif ($_POST['type']=="checkout") {
        $cart_id=$_POST['cart_ids'];
        $cart_id=json_decode($cart_id);
        $user_id=$_POST['user_id'];
        $first_name=$_POST['fname'];
        $last_name=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $address2=$_POST['address2'];
        $state=$_POST['state'];
        $postal=$_POST['postal'];
        
        foreach ($cart_id as $value) {
            $query=mysqli_query($con,"update cart set status='1' where cart_id='$value' && user_id='$user_id'");
            $query=mysqli_query($con,"INSERT INTO orders(cart_id, first_name, last_name, email, phone, address, address2, state, zip, status) 
            VALUES ('$value', '$first_name', '$last_name', '$email', '$phone', '$address', '$address2', '$state', '$postal','0')");
        }
        
        
    }

}
?>