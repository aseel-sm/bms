<?php 
require('dbconnect.php');

$pass=$_POST['pass'];
$mob=$_GET['mob'];

$sql="UPDATE `customer` SET password='$pass' WHERE mobile='$mob'";
 
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Password Updated ');
    window.location = '../routes/customer/customer.php';</script>";
}
else
echo "<script>alert('Error occured3');
window.location = '../routes/customer/customer.php';</script>";
{

echo mysqli_error($conn);}

?>