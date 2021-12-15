<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../../index.php");
 
}
else{


$id=$_POST['id'];
$price=$_POST['price'];
if ($price==''||$id=='') {
    echo "<script>alert(' Emply Field');
    window.location = '../routes/admin/adminboard.php';</script>";
} else {
    $sql="update product set s_price='$price' where id='$id'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Price Updated');
        window.location = '../routes/admin/adminboard.php';</script>";
    }
    else {
        echo "<script>alert('Error Occured');
        window.location = '../routes/admin/adminboard.php';</script>";
    }
    
}



}


?>