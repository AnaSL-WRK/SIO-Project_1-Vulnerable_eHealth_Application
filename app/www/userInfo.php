<?php 
  session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>eHealth - SIO Project 2022/2023</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="icon" href="assets/img/eHealth-logo.png" type="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php
  include_once 'layout/header.php'
?>





<section id="exams" class="appointment section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Your account information</h2>
      </div>


      <div class="container-fluid">
        <form action="phpFunctions/update.inc.php" method="post" role="form" class="php-email-form" style="background-color:#f1f7fd !important ;">

        <?php 
            require_once 'phpFunctions/dbh.inc.php';
            if (isset($_SESSION['userID'])){
              mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
              $user = $_SESSION["NHS"];
              
               
               $sql = "SELECT * FROM users WHERE NHS = $user;";

               
              if(!mysqli_query($conn, $sql)) {
                echo '<p class="red"> Something went wrong <p>';
              
              }
              
              
              $resultData = mysqli_query($conn, $sql);


              $row = mysqli_fetch_assoc($resultData);

              $NHS = $row["NHS"];

              
                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="col-md-1" style="padding: 10px;">Name:</div>';
                  echo '<input type="text" class="col-md-3" name="name" required value="'.$row["name"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-md-1" style="padding: 10px;">Email:</div>';
                  echo '<input type="email" class="col-md-2" name="email" required value="'.$row["email"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-md-1" style="padding: 10px;">Phone:</div>';
                  echo '<input type="tel" class="col-md-1" name="phone" minlength="9" maxlength="12" required value="'.$row["phone"] . '">';
                  echo '</div>';


                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="col-md-1" style="padding: 10px;">Address:</div>';
                  echo '<input type="text" class="col-md-3" name="address" required value="'.$row["address"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-md-2" style="padding: 10px;">Postal-code:</div>';
                  echo '<input type="text" class="col-md-1" name="postalcode" pattern="^\d{4}(?:[-]\d{3})$" required value="'.$row["postal"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-md-1" style="padding: 10px;">City:</div>';
                  echo '<input type="text" class="col-md-2" name="city" required value="'.$row["city"] . '">';
                  echo '</div>';


                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="col-md-2" style="padding: 10px;">Date Of Birth:</div>';
                  echo '<input type="date" class="col-md-2" name="DOB" readonly="readonly" required value="'.$row["DOB"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-md-1" style="padding: 10px;">NHS:</div>';
                  echo '<input type="text" class="col-md-1" name="NHS" readonly="readonly" required pattern="^\d{9}$" value="'. $row["NHS"] . '">';
                  echo '<div class="col-md-1"></div>';
                  echo '</div>';
                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="text-center"><button type="submit" name="update">Update Information</button></div>';

                
          

                  echo '</form>';
                  echo '</div>';

                  echo '<div class="col-md-3 mx-auto form-group">';
                  if(isset($_GET["error"])) {
                    if($_GET["error"] == "stmtfailed"){
                      echo "<p class='red'>Connection failed, please try again later</p>";
                    }
                  }

                  if(isset($_GET["info"])) {
                    if($_GET["info"] == "userUpdated"){
                      echo "<p>User information updated successfully</p>";
                    }
                  }
  
                  echo '</div>';


                  echo '<div class="section-title" style="padding: 3%;">';
                  echo '<h2>Change your password</h2>';
                  echo '</div>';


                  echo '<form action="phpFunctions/updatepwd.inc.php" method="post" role="form" style="background-color:#f1f7fd !important ;">';


                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="col-md-2" style="padding: 10px;">Old Password:</div>';
                  echo '<input type="password" class="col-md-2" name="password" required">';

                  echo '<div class="col-md-1"></div>';
                  echo '<div class="col-sm-2" style="padding: 10px;">New Password:</div>';
                  echo '<input type="password" class="col-md-2" name="newpassword" required">';
                  echo '<div class="col-md-1"></div>';

                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="col-md-2" style="padding: 10px;">Repeat New Password:</div>';
                  echo '<input type="password" class="col-md-2" name="newpasswordRPT" required">';
                  echo '<div class="col-md-1"></div>';
                  echo '<div class= "row" style="padding: 2%;">';
                  echo '<div class="text-center"><button type="submit" name="updatepwd">Update Password</button></form></div>';




          echo '<div class="col-md-3 mx-auto form-group">';

            if(isset($_GET["error"])) {  
              
             
              if($_GET["error"] == "pwdDontMatch"){
              echo "<p class='red'>Passwords don't match!</p>";
            } 

              if($_GET["error"] == "wrongPassword"){
              echo "<p class='red'>Wrong password!</p>";
              echo "<p class='red'>Please enter your old password correctly!</p>";
            } 

            if($_GET["error"] == "stmtfailed"){
              echo "<p class='red'>Connection failed, please try again later</p>";    
              } 
            }

            if(isset($_GET["info"])) {   
              if($_GET["info"] == "pwdUpdated"){
                echo "<p>Passowrd updated successfully</p>";
              } 
           }  

          
          echo '</div>';
        }

        ?>




  </section><!-- end Download exam Section -->


  
  <?php
  include_once 'layout/footer.php'
?>

