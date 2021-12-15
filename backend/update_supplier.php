<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../../index.php");
 
}
else{


$id=$_POST['id'];
$contact=$_POST['contact'];
if($contact=='' || $id==''){
    echo "<script>alert(' Emply Field');
    window.location = '../routes/admin/adminboard.php#view_product';</script>";



}
else{
   
    $sql="update supplier set contact='$contact' where id='$id'";
if(mysqli_query($conn,$sql)){
    echo "<script>alert('Contact Updated');
    window.location = '../routes/admin/adminboard.php#view_product';</script>";
}
else {
    echo "<script>alert('Error Occured');
    window.location = '../routes/admin/adminboard.php#view_product';</script>";
}
}



}


?>