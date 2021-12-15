<?php 

require('dbconnect.php');
session_start();
if ($_SESSION['user']!='admin' || $_SESSION['authenticate']!=="true") {
    header("Location:../routes/admin/adminboard.php");
 
}
else{

  

   
  
   $content=$_POST['content'];
 
  $content_data=json_decode($content,true);

  $items=$_POST['items'];
  $item_data=json_decode($items,true);



  function update($data){
      global $conn;
      global $stmt;
      $id=$data[0];
      $stock=$data[1];
      $sql="UPDATE product SET stock=stock-'$stock' WHERE id='$id'";
      mysqli_query($conn,$sql);

  }
 
array_map("update",$item_data);



$cid=$content_data['cid'];
$total=$content_data['total'];
$wallet=$content_data['wallet'];
$discount=$content_data['discount'];
$name=$content_data['name'];
$flag=false;
if(($total+$discount>=2000))
$flag=true;
$flag2=true;

if($wallet==0)
  $flag2=false;
$sql1="INSERT INTO `invoice`( `customer_id`, `amount`, `discount`, `wallet`, `name`, `items`) VALUES ('$cid','$total','$discount','$wallet','$name','$items')";
mysqli_query($conn,$sql1);

if($flag2==true)
{
    $sql2="UPDATE `wallet` SET used=used+ balance WHERE mobile='$cid';";
    $sql3="UPDATE `wallet` SET balance=0 WHERE mobile='$cid';";
    mysqli_multi_query($conn,$sql2);
    mysqli_multi_query($conn,$sql3);
}
if($flag==true)
{
    $sql4="UPDATE `wallet` SET balance=balance+200 WHERE mobile='$cid'";
mysqli_query($conn,$sql4);
}
echo mysqli_error($conn);


$sql="SELECT id FROM invoice WHERE date=(SELECT MAX(date) from invoice WHERE customer_id='$cid')";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$cid=$row['id'];



echo mysqli_error($conn);
$res=array("response"=>"success","id"=>$cid);
$res=json_encode($res);
echo $res;

 


}
?>