<?php 

require('dbconnect.php');
require('utilities.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../../index.php");
 
}
else{



    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['submit'])) {
    
    
            $user=test_input($_POST['username']);
            $user_exist=is_user_exist($user);
    
            if ($user_exist!=1) {
            
            
            
            
              
             
                $address=test_input($_POST['address']);
                $name=test_input($_POST['name']);
                $sql="INSERT INTO `customer`(`mobile`, `name`, `address`, `password`) VALUES ('$user','$name','$address','0000')";
                if (mysqli_query($conn,$sql)) {
                 
                    $query="INSERT INTO `wallet`( `mobile`) VALUES ('$user')";
                    mysqli_query($conn,$query);
                    echo "<script>alert('Customer Added');
                    window.location = '../routes/admin/adminboard.php';</script>";
                } else {
                   
                    echo "<script>alert('".mysqli_error($conn)."');
                    window.location = '../routes/admin/adminboard.php';</script>";
                }
                
            }else {
                echo mysqli_error($conn);
            
                echo "<script>alert('User Exist');
                window.location = '../routes/admin/adminboard.php';</script>";
            }
    
    
    
    
        }}
        else{
            echo "sdsdfs";
        }


}


?>