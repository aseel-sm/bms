<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../index.php");
 
}
else{
      require('utilities.php');
    $id=$_POST['id'];
    $quantity=$_POST['quan'];

    $sql="UPDATE product SET stock=stock-'$quantity' WHERE id='$id'";
mysqli_query($conn,$sql) or die("Error".mysqli_error($conn));
}




?>