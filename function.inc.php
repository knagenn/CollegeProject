<?php
function pre($data){
    echo "<pre>";
    print_r($data);
}
function alert($link1){
    ?>
    <script>
        alert('<?php echo $link1?>');
    </script>
    <?php
}
function redirect($link){
    ?>
    <script>
        window.location.href='<?php echo $link?>';
    </script>
    <?php
    die();
}
function escape($str){
    global $con;
    $str=mysqli_real_escape_string($con,$str);
    return $str;
    
}
function show_product($con,$user_id){
        $sql="select products.*,cart.* from products,cart where cart.status='0' && cart.product_id=products.product_id";
    
        if($user_id!=''){
            $sql.=" && cart.user_id='$user_id'";
        }
        $res = mysqli_query($con, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }
        return $data;
}

function count_product($con,$user_id){
    $sql="select products.*,cart.* from products,cart where cart.status='0' && cart.product_id=products.product_id";
    if($user_id!=''){
        $sql.=" && cart.user_id='$user_id'";
    }
    $res = mysqli_query($con, $sql);
    $count=mysqli_num_rows($res);
    return $count;
}
?>