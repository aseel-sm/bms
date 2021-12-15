<?php
require('backend/dbconnect.php');
session_start();
$err='';


 if(isset($_SESSION['authenticate'])){
  
  if( $_SESSION['authenticate']=='true')  {  
    
    if ( $_SESSION['user']=='admin') 
     header("Location:routes/admin/adminboard.php");
     else
     echo "<script>alert('Other user logged');
     </script>";

     

}
 } else {
   

  $user=$pass='';
  function test_input($data)
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
 
  if ($_SERVER['REQUEST_METHOD']=='POST') {
      if (isset($_POST['submit'])) {
          $user=test_input($_POST['username']);
          $pass=test_input($_POST['password']);
         
          $sql="SELECT * FROM admin";
          $result=mysqli_query($conn, $sql);
          if (mysqli_num_rows($result)==1) {
              while ($row=$result->fetch_assoc()) {
                  if ($user==$row['username'] && $pass==$row['password']) {
                      
                      $_SESSION['user']='admin';
                      $_SESSION['authenticate']='true';
                   
                      header("Location:routes/admin/adminboard.php");
                    } else {
                      $err="Wrong Creditianal";
                  }
              }
          }
      }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Log In</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="text-center d-flex justify-content-center pt-5">
      <div>
        <h4>Log In</h4>
        <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              placeholder="Username"
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Password"
            />
          </div>
          <div style="color:red;font-size:10px;" >
<?php echo $err?>
      </div>
          <button
            class="btn btn-primary"
            type="submit"
            name="submit"
            value="login"
          >
            Login
          </button>
       
        </form>
      </div>
    </div>
  </body>
</html>
