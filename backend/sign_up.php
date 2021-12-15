<?php 
require('utilities.php');

session_start();

$user=$pass=$address=$name='';




if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['submit'])) {


        $user=test_input($_POST['username']);
        $user_exist=is_user_exist($user);

        if ($user_exist!=1) {
        
        
        
        
          
            $pass=test_input($_POST['pass']);
            $address=test_input($_POST['address']);
            $name=test_input($_POST['name']);
            $sql="INSERT INTO `customer`(`mobile`, `name`, `address`, `password`) VALUES ('$user','$name','$address','$pass')";
            if (mysqli_query($conn,$sql)) {
                $query="INSERT INTO `wallet`( `mobile`) VALUES ('$user')";
                mysqli_query($conn,$query);
                $_SESSION['authenticate']="true";
                $_SESSION['user']="customer";
                setcookie(
                    "username",
                    $user,
                    time() + (10 * 365 * 24 * 60 * 60),'/'
                );
                header("Location:../routes/customer/customer.php");
            } else {
               
                echo "<script>alert('".mysqli_error($conn)."');
                window.location = '../index.php';</script>";
            }
            
        }else {
            echo mysqli_error($conn);
        
            echo "<script>alert('User Exist');
            window.location = '../index.php';</script>";
        }




    }}
    else{
        echo "sdsdfs";
    }
?>