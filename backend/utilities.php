<?php 
require('dbconnect.php');
function is_user_exist($mobile)
{
    global $conn;
    $sql="select mobile from customer where mobile='$mobile'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
            return 1;
        } else {
            return 0;
        }
    }
}


function get_suppliers()
{
    global $conn;
    $sql="select * from supplier";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
      
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_products()
{
    global $conn;
    $sql="select * from product";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
      
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_supplier()
{
    global $conn;
    $sql="select * from supplier";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
       
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_images()
{
    global $conn;
    $sql="select * from gallery";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}

 function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

function purchase_amount($id){
    global $conn;  
    $sql="select sum(amount) from purchase where supplier_id='$id'";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
      
       
         return  $row[0];;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_purchases()
{
    global $conn;
    $sql="SELECT purchase.date,supplier.name as supplier,product.name,purchase.quantity,purchase.amount FROM purchase INNER JOIN product ON purchase.product_id=product.id INNER JOIN supplier on purchase.supplier_id=supplier.id";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_customers()
{
    global $conn;
    $sql="SELECT c.id,c.mobile,c.name,c.address,w.used,w.balance from customer c,wallet w where c.mobile=w.mobile ";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_customer_by_id($id)
{
    global $conn;  
    $sql="select c.id,c.mobile,c.password,c.name,c.address,w.used,w.balance from customer c,wallet w where c.mobile='$id' and c.mobile=w.mobile";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        echo json_encode($row);
       
        
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_product_details($id)
{
    global $conn;  
    $sql="select * from product where id='$id'";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        echo json_encode($row);
       
        
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_sales()
{
    global $conn;
    $sql="SELECT * from invoice";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_sales_id($id)
{
    global $conn;
    $sql="SELECT * from invoice where customer_id='$id'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}
function get_customer_stat($id)
{
    global $conn;
    $sql="SELECT SUM(amount) as sum,COUNT(customer_id) as purchase ,w.used as used,w.balance as balance from invoice ,wallet w where customer_id='$id' and customer_id=w.mobile";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
        return $result;
    } else {
        echo mysqli_error($conn);
    }
}
function invoice_stat()
{
    global $conn;
    $sql="SELECT COUNT(id)as sales,SUM(discount) as discount,SUM(amount) as earning from invoice";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        echo mysqli_error($conn);
         return $result;
      
    }
    else {
        echo mysqli_error($conn);
    }
  
}


?>