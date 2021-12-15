<?php 
require('dbconnect.php');
$fileExistsFlag = 0; 
// Check if image file is a actual image or fake image
if(isset($_POST["upload_image"])) {
  $check = getimagesize($_FILES["gallery_image"]["tmp_name"]);
  if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $fileName = $_FILES['gallery_image']['name'];
      $sql="select path from gallery where path='$fileName'";
      $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
      while ($row=mysqli_fetch_array($result)) {
          if ($row['path'] == $fileName) {
              $fileExistsFlag = 1;
          }
      }
      if ($fileExistsFlag == 0) {
          $target = "../assets/gallery/";
          $fileTarget = $target.$fileName;
          $tempFileName = $_FILES["gallery_image"]["tmp_name"];
          $title = $_POST['title'];
          $result = move_uploaded_file($tempFileName, $fileTarget);

          if($result){
              $sql="INSERT INTO `gallery`(`title`, `path`) VALUES ('$title','$fileName')";
              $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
              echo "<script>alert('Uploaded your file');
              window.location = '../routes/admin/adminboard.php';</script> ";
          }
          else {			
           
                  echo "<script>alert('Sorry !!! There was an error in uploading your file');
            window.location = '../routes/admin/adminboard.php';</script> ";
        
            
		}
      }
      else {
     

          echo "<script>alert('Sorry !!! Exist');
  window.location = '../routes/adminboard.php';</script> ";
      }


  }}
 else {
     echo "<script>alert('Sorry !!! Not Image');
  window.location = '../routes/adminboard.php';</script> ";
      
  }


?>