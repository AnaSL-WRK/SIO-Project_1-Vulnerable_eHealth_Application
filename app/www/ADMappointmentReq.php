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
        <h2>Appointment Requests</h2>
      </div>

      <ul class="responsive-table-appointment">
        <li class="table-header">
          <div class="col col-1">Name of Patient</div>
          <div class="col col-2">Email</div>
          <div class="col col-3">Phone</div>
          <div class="col col-4">Date</div>
          <div class="col col-5">Department</div>
          <div class="col col-6">Doctor</div>
          <div class="col col-7">Message</div>
        </li>

        <?php 
            require_once 'phpFunctions/dbh.inc.php';
            if($_SESSION["userType"] == "admin"){

              
              $sql = "SELECT * FROM appointment";
              
              
              if(!mysqli_query($conn, $sql)) {
                echo "<script>alert('Something went wrong. Please try again later')</script>";
                exit();
              }else{
                $resultData = mysqli_query($conn, $sql);
              }
              
            
              while ($row = $resultData->fetch_assoc()){

                 $num = $num+1;
                  echo '<li class="table-row">';
                  echo '<div class="col col-1" data-label="name">' .$row["name"] . '</div>';
                  echo '<div class="col col-2" data-label="email">' .$row["email"] . '</div>';
                  echo '<div class="col col-3" data-label="phone">' .$row["phone"] . '</div>';
                  echo '<div class="col col-4" data-label="date">' .$row["date"] . '</div>';
                  echo '<div class="col col-5" data-label="dpt">' .$row["department"] . '</div>';
                  echo '<div class="col col-6" data-label="doc">' .$row["doctor"] . '</div>';
                  if (!$row["message"]==Null){
                    echo "<div class='col col-7' data-label='Message'><button type='button' class='btn-lg' data-toggle='modal' data-target='#approve".$num."'>Open Message</button></div>";
                    echo '<div id="approve'.$num.'" class="modal fade" role="dialog">';
                    echo '<div class="modal-dialog">';
                    echo '';
      
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    echo '<h4 class="modal-title">Message</h4>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<p>' . $row["message"] .'</p>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '';
                    echo '</div>';
                    echo '</div>';
                  }
                  else{
                    echo '<div class="col col-7" data-label="Message"> No message </div>';
                  } 
              }   
            }
              
            
          ?>
      </tbody>
      </table>
  </section><!-- end Download exam Section -->

  </main><!-- End #main -->

  <?php
  include_once 'layout/footer.php'
  ?>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>