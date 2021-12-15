<?php 

session_start();
if(isset($_SESSION['authenticate'])){
  
  if( $_SESSION['authenticate']=='true')  {  
    
    echo "<h1>No Access</h1>";

     
  }
}
 else {
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Sign Up</title>
  </head>
  <body>
    <div class="container px-3 py-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
      <a class="navbar-brand" href="index.php">
        <img src="assets/favicon.svg" width="30" height="30" class="d-inline-block align-top" alt=""
          loading="lazy" />Lorem Botique
      </a>
     
      
    </nav>
      <div class="py-3 text-center"><h3>Customer Sign Up</h3></div>
      <form action="backend/sign_up.php" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Mobile No</label>
            <input type="text" required class="form-control" id="inputEmail4" name="username" />
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Set-Key(4-digit)</label>
            <input required  min="1000" max="9999" name="pass" type="number" class="form-control" id="inputPassword4" />
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail4">Name</label>
          <input required name="name" type="text" class="form-control" id="inputEmail4" />
        </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <input
            type="text"
            required
            class="form-control"
            id="inputAddress"
            placeholder="1234 Main St"
            name="address"
          />
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>
  </body>
</html>
<?php
} ?>