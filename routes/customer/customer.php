<?php 
require('../../backend/utilities.php');
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
    <title>Customer</title>
  </head>
  <body>
   

    <nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
        <a class="navbar-brand" href="#">
          <img
            src="../../assets/favicon.svg"
            width="30"
            height="30"
            class="d-inline-block align-top"
            alt=""
            loading="lazy"
          />Lorem Botique
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"></li>

            <li class="nav-item"></li>
          </ul>
          <a class="btn btn-danger my-2 my-sm-0 mx-1" href="../../backend/logout.php?q=out"
            >Log out</a
          >
        </div>
      </nav>

    <!--Customer Status-->
    <?php 
    
    $result=get_customer_stat($_COOKIE['username']);
    $row=mysqli_fetch_assoc($result);
    
        
    ?>
    <div class="row row-cols-1 p-3 row-cols-sm-2 row-cols-md-4">
      <div class="col my-2">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Total Purchase</h5>
            <h1 class="card-text"><?php echo $row['purchase']==null?0:$row['purchase']?></h1>
          </div>
        </div>
      </div>
      <div class="col my-2">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Amount Spent</h5>
            <h1 class="card-text"><?php echo $row['sum']==null?0:$row['sum']?></h1>
          </div>
        </div>
      </div>
      <div class="col my-2">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Wallet Amount</h5>
            <h1 class="card-text"><?php echo $row['balance']==null?0:$row['balance']?></h1>
          </div>
        </div>
      </div>
      <div class="col my-2">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Wallet Used</h5>
            <h1 class="card-text"><?php echo $row['used']==null?0:$row['used']?></h1>
          </div>
        </div>
      </div>
    </div>
    <!--CustomerStatus End-->
<div>
    
    <button type="button" class="btn btn-success m-3" data-toggle="modal" data-target="#myModal">
        Update Password 
      </button>
</div>
    <!--Purchase Details-->
    <div class="table-responsive p-2">
      <input
        class="form-control"
        id="myPurchase"
        type="text"
        placeholder="Search.."
      />
      <br />
      <?php 
    
$sales=get_sales_id($_COOKIE['username']);
if (mysqli_num_rows($sales)==0) {
echo "<h3>No Purchase Done </h3>";
}      
else{?>
      <table class="table table-bordered table-striped">
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
        <tbody id="myPurchaseTable">
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
    <!--Purchase Details End-->



    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form method="post" action="../../backend/update_by_customer.php?mob=<?php echo $_COOKIE['username']?>">
             <div class="form-group">
                 <label for="password">Password</label>
                 <input id="password" min=1000 max=9999 class="form-control" type="number" name="pass">
             </div>
           
             <button class="btn btn-primary" type="submit">Update</button>
         </form>
        </div>
        
      
        
      </div>
    </div>
  </div>
    <script>
      $(document).ready(function () {
        $("#myPurchase").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myPurchaseTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
          });
        });
      });
    </script>
  </body>
</html>
