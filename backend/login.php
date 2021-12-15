<?php
require('dbconnect.php');
require('utilities.php');

session_start();



$user=$_POST['username'];
$pass=$_POST['password'];

$user_exist=is_user_exist($user);

if ($user_exist!=0) {
    $sql="select mobile,password from `customer` where mobile='$user'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)==1) {
            $row=mysqli_fetch_array($result);
            if ($row['password']==$pass) {
                $_SESSION['authenticate']="true";
                $_SESSION['user']="customer";
                setcookie(
                    "username",
                    $user,
                    time() + (10 * 365 * 24 * 60 * 60),'/'
                );
                header("Location:../routes/customer/customer.php");
            } else {
                echo mysqli_error($conn);
    ;
               echo "<script>alert('Invalid Password".mysqli_error($conn)."');window.location = '../index.php';</script>";
            }
        } else {
            echo mysqli_error($conn);
            echo "<script>alert('Error ,double user error".mysqli_error($conn)."');
        window.location = '../index.php';</script>";
        }
    } else {
        echo mysqli_error($conn);
        echo "<script>alert('Query Error".mysqli_error($conn)."');
        window.location = '../index.php';</script>";
    }
} else {
    echo mysqli_error($conn);
    echo "<script>alert('No user Exist".mysqli_error($conn)."');
    window.location = '../index.php';</script>";
}
