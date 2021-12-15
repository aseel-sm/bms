<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../index.php");
 
}
else{
    require('utilities.php');


   
    $name=test_input($_POST['name']);
    $s_price=test_input($_POST['s_price']);
    $b_price=test_input($_POST['b_price']);
    $s_id=test_input($_POST['s_id']);
    $stock=test_input($_POST['stock']);

    $sql="INSERT INTO `product`( `name`, `s_price`, `b_price`, `stock`, `supplier_id`)
     VALUES ('$name','$s_price','$b_price','$stock','$s_id')";
    if (mysqli_query($conn, $sql)) {

        $sql="SELECT `id` FROM `product` WHERE name='$name'";
        if (mysqli_query($conn, $sql)) {

            $result=mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)==1){
                    $row=mysqli_fetch_assoc($result);
                    $pid=$row['id'];
                    $amount=$b_price*$stock;
                    $sql="INSERT INTO `purchase`( `supplier_id`, `product_id`, `quantity`, `amount`) 
                        
                   
                    VALUES ('$s_id','$pid','$stock','$amount')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Added Product ');
                        window.location = '../routes/admin/adminboard.php';</script>";
                    }
                    else
                    echo "<script>alert('Error occured3');
                    window.location = '../routes/admin/adminboard.php';</script>";
            }  else
            echo "<script>alert('Error occured2');
            window.location = '../routes/admin/adminboard.php';</script>";


        }
        else
        echo "<script>alert('Error occured1');
        window.location = '../routes/admin/adminboard.php';</script>";

       
    }
    
    
    
    
    else {
     
        echo "<script>alert('".mysqli_error($conn)."');
        window.location = '../routes/admin/adminboard.php';</script>";
    }


}


?>