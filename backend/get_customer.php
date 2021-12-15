<?php 

require('dbconnect.php');
require('utilities.php');

session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../routes/admin/adminboard.php");
 
}
else{

  $mobile=$_POST['id'];
    get_customer_by_id($mobile);

}
?>