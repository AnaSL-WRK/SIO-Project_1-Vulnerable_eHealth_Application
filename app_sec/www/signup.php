<?php session_start(); ?>
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

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact" style="padding-top:10% !important; background-color:#f1f7fd !important ;">
      <div class="container">

        <div class="section-title">
          <h2>Sign up</h2>
          <p></p>
        </div>
      </div>


      <div class="container">
       

            <form action="phpFunctions/signup.inc.php" method="post" role="form" class="php-email-form" style="background-color:#f1f7fd !important ;">
            <div class= "row">
                <div class="col-md-5 form-group mx-auto">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                </div>

                <div class="col-md-5 form-group mx-auto">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="col-md-2 form-group mx-auto">
                  <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number" minlength="9" maxlength="12" required>
                </div>
            </div> 

            <div class= "row">
                
                <div class="col-md-5 form-group ">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                </div>

                <div class="col-md-2 form-group">
                    <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postal Code" pattern="^\d{4}(?:[-]\d{3})$" required>
                </div>

                <div class="col-md-3 form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                </div>
                <div class="col-md-2 form-group mx-auto">
                    <input type="date" class="form-control" name="DOB" id="DOB" placeholder="Date of Birth" required>
                </div>

            </div> 
            <div class= "row mx-auto ">
            <div class="col-md-2 form-group mx-auto">
                    <input type="text" class="form-control" name="NHS" id="NHS" placeholder="NHS Number" pattern="^\d{9}$" required>
                </div>

                <div class="col-md-4 form-group mx-auto">
                    <input type="password" class="form-control" name="password"  placeholder="Password" required></textarea>
                </div>

                <div class="col-md-4 form-group mx-auto">
                    <input type="password" class="form-control" name="passwordRPT"  placeholder="Repeat your Password" required></textarea>
                </div>

                </div> 
              <div class="text-center"><button type="submit" name="signup">Sign Up</button></div>
            </form>
          </div> 
        <div class="col-md-6 form-group mx-auto">
          
          <?php
          if(isset($_GET["error"])) 
          {

            if($_GET["error"] == "invalidDate"){
              echo "<p class='red'>Your Date of Birth is invalid!</p>";
              echo "<p class='red'>You have to be at least 16 years old to use this service</p>";
          }
            if($_GET["error"] == "invalidNHS"){
                echo "<p class='red'>Your NHS number is invalid!</p>";
                echo "<p class='red'>It should be 9 numbers long! </p>";
            }
            if($_GET["error"] == "userTaken"){
                echo "<p class='red' >That email or NHS number is already in use!</p>";
            }
            if($_GET["error"] == "weakPassword"){
                echo "<p class='red'>Your password is too weak!</p>";
                echo "<p class='red'>It should be a combination of at least 8 letters, numbers and symbols! </p>";
            }
            if($_GET["error"] == "pwdDontMatch"){
                echo "<p class='red'>Passwords don't match!</p>";
            } 
          }
          else if(isset($_GET["info"])) {
            echo "<p>User created! You can now login into your account.</p>";
          }
        
      ?>
          </div>

      
    </section><!-- End Contact Section -->
   



    <?php
  include_once 'layout/footer.php'
?>