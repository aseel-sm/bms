<?php
require('dbconnect.php');
session_start();
if($_GET['q']=='out')
{echo "1";
    $_SESSION['user']=$_SESSION['authenticate']=NULL;
   
    if(isset( $_COOKIE['username']))
    setcookie("username", "", time() - 3600,'/');
   session_destroy();
    header("Location:../index.php");
}
else{
    echo "error";
}






?>