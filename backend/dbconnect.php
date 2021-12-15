<?php
$servername="localhost";
$username="root";
$password="";
$dbname="bms";

$conn = mysqli_connect($servername, $username, $password,$dbname,"3308");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>