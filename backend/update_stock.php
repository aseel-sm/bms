<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../index.php");
 
}
else{
    require('utilities.php');


   
    $id=test_input($_POST['pid']);
   
    $b_price=test_input($_POST['b_price']);
  
    $stock=test_input($_POST['stock']);
$sql="SELECT * FROM product where id='$id'";
    if (mysqli_query($conn, $sql)) {
$result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_id=$row['id'];
        $new_stock=$row['stock']+$stock;
        if ($b_price=='') {
            $sql="update product set stock='$new_stock' where id='$_id'";
        } else {
            $sql="update product set stock='$new_stock',b_price='$b_price' where id='$_id'";
        }
        
       
        if (mysqli_query($conn, $sql)) {

            $s_id=$row['supplier_id'];
            if ($b_price=='') {
                $amount=$row['b_price']*$stock;
            } else {
                $amount=$b_price*$stock;
            }
            
            $sql="INSERT INTO `purchase`( `supplier_id`, `product_id`, `quantity`, `amount`) 
                        
                   
            VALUES ('$s_id','$_id','$stock','$amount')";
       
                    
                   
                 
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Stock Updated ');
                        window.location = '../routes/admin/adminboard.php';</script>";
                    }
                    else
                    echo "<script>alert('Error occured3');
                 window.location = '../routes/admin/adminboard.php';</script>";
                  {
                  
                    echo mysqli_error($conn);}
            }  else
            echo "<script>alert('Error occured2');
            window.location = '../routes/admin/adminboard.php';</script>";


        }
       
       
    }
    
    
    
    
    




?>