<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../routes/admin/adminboard.php");
 
}
else{

  
    mysqli_query($conn,'SET foreign_key_checks = 0');
    //do some stuff here
  
  
    $id=$_GET['id'];
    $tb=$_GET["tb"];
    $sql="DELETE FROM `$tb` WHERE id =$id ";
    if(mysqli_query($conn,$sql)){
        
        echo "<script>alert('Deleted');
        window.location = '../routes/admin/adminboard.php';</script>";
    }
    else
    echo mysqli_error($conn);
    
    







    mysqli_query($conn,'SET foreign_key_checks = 1');

}
?>