<?php
require('../../backend/dbconnect.php');
require('../../backend/utilities.php');



session_start();


if ($_SESSION['user']!='admin' && $_SESSION['authenticate']!==true) {
    header("Location:../../index.php");
 
}
else{
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <title>Admin</title>
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
      <a class="navbar-brand" href="#">
        <img src="../../assets/favicon.svg" width="30" height="30" class="d-inline-block align-top" alt=""
          loading="lazy" />Lorem Botique
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"></li>

          <li class="nav-item"></li>
        </ul>
        <a class="btn btn-success my-2 my-sm-0 mx-1"  target="_blank"  href="billing.php">Bill Now</a>
        <a class="btn btn-danger my-2 my-sm-0 mx-1" href="../../backend/logout.php?q=out">Log out</a>
      </div>
    </nav>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-status-tab" data-toggle="pill" href="#v-pills-status" role="tab"
            aria-controls="v-pills-status" aria-selected="true">Botique Status</a>
          <a class="nav-link" id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product" role="tab"
            aria-controls="v-pills-product" aria-selected="false">Product</a>
          <a class="nav-link" id="v-pills-supplier-tab" data-toggle="pill" href="#v-pills-supplier" role="tab"
            aria-controls="v-pills-supplier" aria-selected="false">Supplier</a>
          <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab"
            aria-controls="v-pills-customer" aria-selected="false">Customer</a>
          <a class="nav-link" id="v-pills-gallery-tab" data-toggle="pill" href="#v-pills-gallery" role="tab"
            aria-controls="v-pills-gallery" aria-selected="false">Gallery</a>
          <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab"
            aria-controls="v-pills-sales" aria-selected="false">Sales</a>
          <a class="nav-link" id="v-pills-purchases-tab" data-toggle="pill" href="#v-pills-purchases" role="tab"
            aria-controls="v-pills-purchases" aria-selected="false">Purchases</a>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <!--Status Start-->

          <?php 
    
    $result=invoice_stat();
    $row=mysqli_fetch_assoc($result);
    $product_stat=mysqli_query($conn,'select count(id) as prod from product');
    $sup_stat=mysqli_query($conn,'select count(id) as sup from supplier');
    $cust_stat=mysqli_query($conn,'select count(id) as cust from customer');

    $prod_count=mysqli_fetch_assoc($product_stat);
    $sup_count=mysqli_fetch_assoc($sup_stat);
    $cust_count=mysqli_fetch_assoc($cust_stat);


        
    ?>
          <div class="tab-pane fade p-5 show active" id="v-pills-status" role="tabpanel"
            aria-labelledby="v-pills-status-tab">
            <div class="row row-cols-1 p-3 row-cols-sm-3">
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Sales</h5>
                    <h1 class="card-text"><?php echo $row['sales'] ?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Product</h5>
                    <h1 class="card-text"><?php echo $prod_count['prod'] ?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Suppliers</h5>
                    <h1 class="card-text"><?php echo $sup_count['sup'] ?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Customers</h5>
                    <h1 class="card-text"><?php echo $cust_count['cust'] ?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Discount</h5>
                    <h1 class="card-text"><?php echo $row['discount'] ?></h1>
                  </div>
                </div>
              </div>
              <div class="col my-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"> Earning</h5>
                    <h1 class="card-text"><?php echo $row['earning'] ?></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Status End-->

          <!--Product-->
          <div class="tab-pane fade" id="v-pills-product" role="tabpanel" aria-labelledby="v-pills-product-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#view_product" role="tab"
                  aria-controls="home" aria-selected="true">View</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add_product" role="tab"
                  aria-controls="profile" aria-selected="false">Add</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#update_product" role="tab"
                  aria-controls="contact" aria-selected="false">Update Stock</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#update_price" role="tab"
                  aria-controls="contact" aria-selected="false">Update Price</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active p-2" id="view_product" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive">
                  ​<input class="form-control" id="myProductInput" type="text" placeholder="Search.." />
                  <br />
                  <?php 
      $productlist=get_products();
      if (mysqli_num_rows($productlist)==0) {
        echo "<h3>No Products </h3>";
    }      
      else{?>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>SPrice</th>
                        <th>BPrice</th>
                        <th>Stock</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="myProductTable">
                      <?php

while ($prd=mysqli_fetch_assoc($productlist)) {
  
echo"  <tr>
<td>".$prd['id']."</td>
<td>".$prd['name']."</td>
<td>".$prd['s_price']."</td>
<td>".$prd['b_price']."</td>
<td>".$prd['stock']."</td>

<td>" ?><a href="../../backend/delete_row?id=<?php echo $prd['id'] ?>&tb=product"> <button class="btn btn-danger" type="button">
Delete
</button></a>
                      </td>
                      </tr> <?php
}
}
?>



                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade p-5" id="add_product" role="tabpanel" aria-labelledby="profile-tab">
                <form action="../../backend/add_product.php" method="post">
                  <div class="form-group">
                    <label for="pName">Name</label>
                    <input    required type="text" class="form-control" id="PName" name="name" placeholder="Name" />
                  </div>
                  <div class="form-group">
                    <label for="pSPrice">Sell price</label>
                    <input    required type="number" class="form-control" id="pSPrice" placeholder="Sell price" name="s_price" />
                  </div>
                  <div class="form-group">
                    <label for="pBPrice">Buy price</label>
                    <input    required type="number" class="form-control" id="pBPrice" placeholder="Buy price" name="b_price" />
                  </div>
                  <div class="form-group">
                    <label for="pSupplier">Supplier</label>
                    <select    required name="s_id" class="form-control" required name='supplier' id="pSupplier">

                      <?php 
                        $suppliers=get_suppliers();
                      if (mysqli_num_rows($suppliers)>0) {
        while ($row=mysqli_fetch_assoc($suppliers)) {
            ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
        }
    } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="pStock">Stock</label>
                    <input required type="number" class="form-control" name="stock" id="pStock" placeholder="Stock" />
                  </div>
                  <button class="btn btn-secondary" type="submit" name=submit>
                    Add Product
                  </button>
                </form>
              </div>

              <div class="tab-pane fade p-5" id="update_product" role="tabpanel" aria-labelledby="contact-tab">


                <form class="py-3" action="../../backend/update_stock.php" method="post">
                  <div class="form-group">
                    <label for="PID1">ID</label>
                    <input required list="pids" class="form-control" id="PID1" name="pid" placeholder="ID" />
                    <datalist id="pids">
                      <?php   $products=get_products();
                      if (mysqli_num_rows($products)>0) {
                          while ($row=mysqli_fetch_assoc($products)) {
                              ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
                          }
                      }
     ?>
                    </datalist>

                  </div>
                  <div class="form-group">
                    <label for="pBPrice">Buy price</label>
                    <input type="number" class="form-control" id="pBPrice" name="b_price"
                      placeholder="Update only if required" />

                  </div>

                  <div class="form-group">
                    <label for="pStock">Stock</label>
                    <input required type="number" class="form-control" id="pStock" name="stock" placeholder="Stock" />
                  </div>

                  <button class="btn btn-secondary" type="submit">
                    Update
                  </button>
                </form>
              </div>

              <div class="tab-pane fade p-5" id="update_price" role="tabpanel" aria-labelledby="contact-tab">


                <form class="py-3" action="../../backend/update_price.php" method="post">
                  <div class="form-group">
                    <label for="PID1">ID</label>
                    <input required list="pids" class="form-control" id="PID2" name="id" placeholder="ID" />
                    <datalist id="pids">
                      <?php   $products=get_products();
                      if (mysqli_num_rows($products)>0) {
                          while ($row=mysqli_fetch_assoc($products)) {
                              ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
                          }
                      }
     ?>
                    </datalist>

                  </div>
                  <div class="form-group">
                    <label  for="pSPrice">Sell price</label>
                    <input required type="number" class="form-control" id="pSPrice" name="price" placeholder="Sell price" />

                  </div>



                  <button type="submit" class="btn btn-secondary" type="button">
                    Update
                  </button>
                </form>
              </div>
            </div>
          </div>
          <!--Product End-->

          <!--Supplier-->
          <div class="tab-pane fade" id="v-pills-supplier" role="tabpanel" aria-labelledby="v-pills-supplier-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#view_supplier" role="tab"
                  aria-controls="home" aria-selected="true">View</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add_supplier" role="tab"
                  aria-controls="profile" aria-selected="false">Add</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#update_supplier" role="tab"
                  aria-controls="contact" aria-selected="false">Update</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active p-2" id="view_supplier" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive">
                  ​<input class="form-control" id="mySupplierInput" type="text" placeholder="Search.." />
                  <br />

                  <?php 
      $supplierlist=get_supplier();
      if (mysqli_num_rows($supplierlist)==0) {
        echo "<h3>No Suppliers </h3>";
    }      
      else{?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Purchased Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="mySupplierTable">


                      <?php

while ($sup=mysqli_fetch_assoc($supplierlist)) {

echo " <tr>
<td>".$sup['id']."</td>
<td>".$sup['name']."</td>
<td>".$sup['contact']."</td>
<td>". purchase_amount($sup['id'])."</td>

<td>";?>

<a href="../../backend/delete_row?id=<?php echo $sup['id'] ?>&tb=supplier"> <button class="btn btn-danger" type="button">
        Delete
      </button></a>
                      </td>
                      </tr> <?php
          }
      }
      ?>

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade p-5" id="add_supplier" role="tabpanel" aria-labelledby="profile-tab">
                <form action="../../backend/add_supplier" method="post">
                  <div class="form-group">
                    <label for="sName">Name</label>
                    <input required type="text" class="form-control" id="sName" name="name" placeholder="Name" />
                  </div>
                  <div class="form-group">
                    <label for="sContact">Contact</label>
                    <input required type="number" name="contact" class="form-control" id="sContact" placeholder="Contact" />
                  </div>

                  <button class="btn btn-secondary" type="submit">
                    Add Supplier
                  </button>
                </form>
              </div>
              <div class="tab-pane fade p-5" id="update_supplier" role="tabpanel" aria-labelledby="contact-tab">


                <form class="py-3" action="../../backend/update_supplier.php" method="post">
                  <div class="form-group">
                    <label for="SID">ID</label>
                    <input list="sids" class="form-control" id="SID" name="id" placeholder="ID" />
                    <datalist id="sids">
                      <?php   $sups=get_supplier();
                      if (mysqli_num_rows($sups)>0) {
                          while ($row=mysqli_fetch_assoc($sups)) {
                              ?>
                      <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                      <?php
                          }
                      }
     ?>
                    </datalist>
                  </div>
                  <div class="form-group">
                    <label for="sContact">Contact</label>
                    <input type="number" class="form-control" id="sContact" name="contact" placeholder="New Contact" />
                  </div>

                  <button class="btn btn-secondary" type="submit">
                    Update
                  </button>
                </form>
              </div>
            </div>
          </div>
          <!--Supplier End-->
          <!--Customer Start-->
          <div class="tab-pane fade" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view"
                  aria-selected="true">View</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add"
                  aria-selected="false">Add</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active p-3" id="view" role="tabpanel" aria-labelledby="add-tab">
                <div class="table-responsive">
                  ​<input class="form-control" id="myCustomerInput" type="text" placeholder="Search.." />
                  <br />
                  <?php 
$custlist=get_customers();
if (mysqli_num_rows($custlist)==0) {
echo "<h3>No Customers </h3>";
}      
else{?>

<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Mobile</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Wallet</th>
                        <th>Used Wallet</th>
                        <th>Total Sales</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="myCustomerTable">
      <?php

while ($customer=mysqli_fetch_assoc($custlist)) {
  $get_sale=get_customer_stat($customer['mobile']);
  $t_sale=mysqli_fetch_assoc($get_sale);
 $t_sale['sum']= $t_sale['sum']==null?0:$t_sale['sum'];
echo"  
<tr>
  <td>".$customer['mobile']."</td>
  <td>".$customer['name']."</td>
  <td>".$customer['address']."</td>
  <td>".$customer['used']."</td>
  <td>".$customer['balance']."</td>
  <td>".$t_sale['sum']."</td>
  
  <td>" ?>
     <a href="../../backend/delete_row?id=<?php echo $customer['id'] ?>&tb=customer"> <button class="btn btn-danger" type="button">
        Delete
      </button></a>
      </td>
      </tr> <?php
}
}
?>
                
                     

                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade p-3" id="add" role="tabpanel" aria-labelledby="add-tab">
                <form action="../../backend/add_customer.php" method="post">

                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Mobile No</label>
                    <input name="username" type="number" class="form-control" id="inputEmail4" />
                  </div>


                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Name</label>
                    <input name="name" type="text" class="form-control" id="inputEmail4" />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" />
                  </div>

                  <button type="submit" name="submit" value="submit" class="btn btn-primary">Add</button>
                </form>
              </div>
            </div>
          </div>
          <!--Customer End-->
          <!--Gallery Start-->
          <div class="tab-pane fade" id="v-pills-gallery" role="tabpanel" aria-labelledby="v-pills-gallery-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="gview-tab" data-toggle="tab" href="#gview" role="tab"
                  aria-controls="gview" aria-selected="true">View</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="gadd-tab" data-toggle="tab" href="#gadd" role="tab" aria-controls="gadd"
                  aria-selected="false">Add</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active p-3" id="gview" role="tabpanel" aria-labelledby="gview-tab">
                <div class="table-responsive">
                  ​<input class="form-control" id="myGalleryInput" type="text" placeholder="Search.." />
                  <br />
                  <br />

                  <?php 
$images=get_images();
if (mysqli_num_rows($images)==0) {
echo "<h3>No Images </h3>";
}      
else{?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Title</th>

                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="myGalleryTable">



                      <?php

while ($image=mysqli_fetch_array($images)) {
  
echo ' <tr>
<td>'.$image['title'].'</td>

<td>';?>
<a href="../../backend/delete_row?id=<?php echo $image['id'] ?>&tb=gallery"> <button class="btn btn-danger" type="button">
        Delete
      </button></a>
                      </td>
                      </tr>


                      <?php
          }
      }
      ?>

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade p-3" id="gadd" role="tabpanel" aria-labelledby="gadd-tab">
                <form action="../../backend/upload_gallery.php" method="post" enctype="multipart/form-data">

                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Title</label>
                    <input name="title" type="text" class="form-control" id="inputEmail4" />
                  </div>


                  <div class="form-group col-md-6">
                    <label for="inputEmail4">File</label>
                    <input type="file" name="gallery_image" class="form-control" id="inputEmail4" />
                  </div>


                  <button name="upload_image" type="submit" class="btn btn-primary">Add</button>
                </form>
              </div>
            </div>
          </div>
          <!--Gallery End-->
<!---Sales Start-->
<div class="tab-pane fade p-5  " id="v-pills-sales" role="tabpanel"
aria-labelledby="v-pills-sales-tab">

  
<div class="table-responsive">
  ​<input class="form-control" id="mySalesInput" type="text" placeholder="Search.." />
  <br />
  <?php 
$sales=get_sales();
if (mysqli_num_rows($sales)==0) {
echo "<h3>No Sales </h3>";
}      
else{?>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Total</th>
        <th>Discount</th>
        <th>Wallet</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="mySalesTable">
      <?php

while ($sale=mysqli_fetch_assoc($sales)) {

echo"  <tr>
<td>".$sale['id']."</td>
<td>".$sale['name']."</td>
<td>".$sale['amount']."</td>
<td>".$sale['discount']."</td>
<td>".$sale['wallet']."</td>
<td>".date("d F Y h:i:s A", strtotime($sale['date']))."</td>


<td>" ?>
<a href="../../backend/bill/bill_pdf?id=<?php echo $sale['id']?>&cid=<?php echo $sale['customer_id']?>">

<button class="btn btn-danger" type="button">
        Print
      </button>

</a>
      
      </td>
      </tr> <?php
}
}
?>



    </tbody>
  </table>
</div>
</div>
<!---Sales End-->
<!---Purchase Start-->
<div class="tab-pane fade p-5  " id="v-pills-purchases" role="tabpanel"
aria-labelledby="v-pills-status-tab">

<div class="table-responsive">
  ​<input class="form-control" id="myPurchaseInput" type="text" placeholder="Search.." />
  <br />
  <?php 
$purchase=get_purchases();
if (mysqli_num_rows($purchase)==0) {
echo "<h3>No Purchase </h3>";
}      
else{?>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Supplier</th>
        <th>Quantity</th>
        <th>Unit price</th>
        <th>Total</th>
       
      </tr>
    </thead>
    <tbody id="myPurchaseTable">
      <?php

while ($purch=mysqli_fetch_assoc($purchase)) {

echo"  <tr>
<td>".$purch['date']."</td>
<td>".$purch['name']."</td>
<td>".$purch['supplier']."</td>
<td>".$purch['quantity']."</td>
<td>".$purch['amount']/$purch['quantity']."</td>
<td>".$purch['amount']."</td>



</tr>";}
} ?>
    
    



    </tbody>
  </table>
</div>
</div>
<!---Purchase End-->
        </div>
      </div>
    </div>
  </div>

  <script>
    //ProductStart
    $(document).ready(function () {
      $("#myProductInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myProductTable tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  
    //ProductEnd
    //PurchaseStart
    $(document).ready(function () {
      $("#myPurchaseInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myPurchaseTable tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  
    //PurchaseEnd

    //SupplierStart
    $(document).ready(function () {
      $("#mySupplierInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#mySupplierTable tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
    //SupplierEnd

    //CustomerStart
    $(document).ready(function () {
      $("#myCustomerInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myCustomerTable tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
      //CustomerEnd
  </script>
</body>

</html>
<?php }?>