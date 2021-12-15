<?php 


session_start();
require('backend/utilities.php');
  




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
    <title>BMS</title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
        <a class="navbar-brand" href="#">
          <img
            src="assets/favicon.svg"
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
      <?php
        if(isset($_SESSION['authenticate'])){
          if ($_SESSION['authenticate']=="true") {
            $path='';
            $path=$_SESSION['user']=='admin'? 'routes/admin/adminboard.php':'routes/customer/customer.php';
            echo '<a class="btn btn-danger my-2 my-sm-0  mx-1" href="' . $path .'">Dashboard</a>';
        }

        }else{
          ?>
          <a class="btn btn-success my-2 my-sm-0 mx-1" href="login.php"
            >Log In</a
          >
          <a class="btn btn-info my-2 my-sm-0 mx-1" href="signup.php"
            >Sign Up</a
          ><?php } ?>
        </div>
      </nav>

      <div class="owl-carousel owl-theme">
        <?php 
        $image=get_images();
        if (mysqli_num_rows($image)==0) {
          echo "<h3>No Images </h3>";

        }else{?>
        
        <?php

while ($img=mysqli_fetch_assoc($image)) {
    echo'  <div class="item"><img src="assets/gallery/'.$img['path'].'"  class="img-fluid h-75" alt="Responsive image"></div>';
}}?>
</div>
    </div>
  </body>
  <script src="js/owl.carousel.min.js"></script>
  <script>

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay: true,
    autoplaySpeed:1000,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
       
    }
})
  </script>
</html>
