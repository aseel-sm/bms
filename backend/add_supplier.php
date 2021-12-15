<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../index.php");
 
}
else{

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name=test_input($_POST['name'])    ;
    $contact=test_input($_POST['contact']);

    $sql="INSERT INTO `supplier`(`name`, `contact` ) VALUES ('$name','$contact')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Added Supplier');
                window.location = '../routes/admin/adminboard.php';</script>";
    } else {
        echo "<script>alert('Error,maybe existing contact or name');
        window.location = '../routes/admin/adminboard.php';</script>";
    }
}
?>