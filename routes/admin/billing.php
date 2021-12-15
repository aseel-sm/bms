<?php
require('../../backend/utilities.php');
session_start();
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../../assets/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>

  <title>BMS</title>
</head>

<body>
  <div class="container py-2 px-3">

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
        <?php
        if (isset($_SESSION['authenticate'])) {
            if ($_SESSION['authenticate']=="true") {
                $path='';
                $path=$_SESSION['user']=='admin'? 'adminboard.php':'routes/customer/customer.php';
                echo '<a class="btn btn-danger my-2 my-sm-0  mx-1" href="' . $path .'">Dashboard</a>';
            }
        } else {
            ?>
        <a class="btn btn-success my-2 my-sm-0 mx-1" href="login.php">Log In</a>
        <a class="btn btn-info my-2 my-sm-0 mx-1" href="signup.php">Sign Up</a><?php
        } ?>
      </div>
    </nav>


    <div class="form-group col-md-7">
      <label for="CID">Customer ID</label>
      <input type="number" class="form-control" id="CID" name="id" placeholder="ID" />
      <button class="btn btn-primary my-1" id="searchCust" type="button">Search</button>

    </div>
    <div id="custDetails">

    </div>
    <div>
      <h4>Add Product</h4>
      <div class="form-row">
        <div class="form-group col-md-2">

          <input list="pids" class="form-control" id="PID1" name="pid" placeholder="ID" />
          <datalist id="pids">
            <?php   $products=get_products();
                      if (mysqli_num_rows($products)>0) {
                          while ($row=mysqli_fetch_assoc($products)) {
                              ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['name'] ,"-RS: ",$row['s_price']?></option>
            <?php
                          }
                      }
     ?>
          </datalist>

        </div>
        <div class="form-group col-md-2">

          <input type="number" class="form-control" id="quantity" min=1 name="quantity" placeholder="Quantity" />

        </div>
        <div class="form-group col-md-2">


          <button class="btn btn-primary" id="add_product" type="button">Add</button>

        </div>
      </div>


    </div>



    <div class="table-responsive mt-3">
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <th>Select</th>
            <th>Sl</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Discount: </th>
            <th><input id="discount" type="number"></th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Wallet: <span id="wallet_data"></span> </th>
            <th></th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total: <span id="total"></span></th>
            <th></th>
          </tr>

        </tfoot>
      </table>
      <div>
        <button type="button" id="delete_row" class="btn btn-danger">Delete Row</button>
        <button type="button" id="bill_now" class="btn btn-success">Bill Now</button>
      </div>
    </div>
  </div>
  <script>
    //get customer
    $(document).ready(function () {
      $("#searchCust").click(function () {
        const mobile = $("#CID").val();

        $.ajax({
          method: "POST",
          url: "../../backend/get_customer.php",
          data: { id: mobile },
          success: (function (data) {
            if (data == "null") {
              const markup = " <h6>No User</h6>";
              $("#custDetails").html(markup);
            }
            else {

              const customer = JSON.parse(data);

              const markup = " <h6>Name:<input id='cname' type='text' value='"+ customer["name"] +"'></h6><h6>Address:" + customer["address"] + "</h6></br>";
              $("#custDetails").html(markup);
            
              let mark2 = 0
              if( customer['balance']!=0)
              if (confirm("Do you want to use wallet balance?"))
                mark2 = customer['balance'];


              $("#wallet_data").html(mark2);
              if(customer['password']!=prompt("Enter Key")){
                alert("Invalid");
                location.reload();
              }
            }


          })
        })

      })
    });

    //add product
    $("#add_product").click(() => {
      const id = $("#PID1").val();

      $.ajax({
        method: "POST",
        url: "../../backend/get_product_details.php",
        data: { id: id, },
        success: (function (data) {
          if (data == "null") { alert('error') }
          else {


            const quantity = $("#quantity").val();
            product = JSON.parse(data);
            console.log(product);
            if (quantity > parseInt(product['stock']))
              alert("No stock")
            else {
              const markup = "<tr><td><input type='checkbox' name='record'></td><td class='serial'></td><td id='"+product["id"]+"'>" + product["name"] + "</td><td>" + quantity + "</td><td>" + product["s_price"] + "</td><td class='amount'>" + quantity * product["s_price"] + "</td></tr>"
                $("table tbody").append(markup);
                update_total();
                update_serial();

            
             
            }

          }




        }), error: (function () {
          alert('Fatal Error');
        })
      })
    })

    // Find and remove selected table rows


   
    $("#delete_row").click(function () {
      $("table tbody").find('input[name="record"]').each(function () {
        if ($(this).is(":checked")) {
          $(this).parents("tr").remove();
       




          update_total();
          update_serial();
        }

      });
    });
    //total
    function update_total() {
      var total = 0;
      $("table tbody").find('.amount').each(function () {
        k = parseInt($(this).html());
        total += k;

      });
     
      
      discount = $("#discount").val();
      total = total - discount;
      $("#total").html(total);
    }
    $("#discount").change(function () {
      update_total();
    })
    //serial
    function update_serial() {
      var i = 1;
      $("table tbody").find('.serial').each(function () {
        $(this).html(i);
        i++;
      });

    }
    //billing
    $("#bill_now").click(function () {
  if(confirm("Bill Now"))
  if ($("table tbody tr").length == 0) {
        alert("No Items")
      } else {
        const billData = {};
        const items = []
        $("table tbody tr").each(function (index, element) {
          let i=0;
          const itemData = [];
          $(this).children('td').each(function () {
            if(i==2){
              itemData.push(parseInt( $(this).attr('id')));
             
            }
            if(i>2 &&i<5)
            itemData.push(parseInt($(this).text()));
            i++;

          })
          items.push(itemData);
        })
        let total=parseInt($("#total").html())
        let discount=parseInt($("#discount").val());
        let cname=$("#cname").val();
        let cid=$("#CID").val();
        let wallet=parseInt($("#wallet_data").html())
        wallet = wallet == NaN ? 0 : wallet;
        total=total-wallet;
        billData.total=total;
        billData.wallet=wallet;
        billData.discount=discount;
        billData.name=cname;
        billData.cid=cid;
        sendData=JSON.stringify(billData);
        itemData=JSON.stringify(items);
     $.ajax({
       method:"POST",
       url:"../../backend/bill_now.php",
       data:{content:sendData,     items:itemData},
  
       success:(function(data){

        



          let res=JSON.parse(data);
          console.log(res);

 if(res['response']=='success'){
 alert('Bill Payed');
location.reload();

  window.location='../../backend/bill/bill_pdf?id='+res['id']+'&cid='+cid;
 }
       }
       )
       
     })

        
      }
    })
  </script>
</body>

</html>