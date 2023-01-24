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

  <!-- ======= Download exam Section ======= -->
  <section id="exams" class="appointment section-bg">
    <div class="container" style="padding-top: 10px ;">

      <div class="section-title">
        <h2>Download your exam</h2>
        <p>Enter the code provided to you by your doctor</p>
      </div>

      <form action="phpFunctions/download.inc.php" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-3 mx-auto form-group">
            <input type="text" name="code" class="form-control" id="name" placeholder="Code" required>
            <div class="validate"></div>
          </div>
        </div>
        <div class="text-center"><button type="submit" onSubmit="window.location.reload()" name="download">Download</button></div>
      </form>
    </div>
  </section><!-- end Download exam Section -->

  <section id="exams" class="appointment section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Download your previous exams</h2>
      </div>

      <ul class="responsive-table">
        <li class="table-header">
          <div class="col col-1">Patient</div>
          <div class="col col-2">Code</div>
          <div class="col col-3">File size</div>
          <div class="col col-4">File name</div>
          <div class="col col-5">Download</div>
        </li>

        <?php 
            require_once 'phpFunctions/dbh.inc.php';
            if (isset($_SESSION['userID'])){

              $user = $_SESSION["NHS"];
              
               
               $sql = "SELECT * FROM files WHERE NHS = ?;";
               $stmt = mysqli_stmt_init($conn);
               
              if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo '<p class="red"> No downloads available yet <p>';
              
              }
              
              
              mysqli_stmt_bind_param($stmt, "s", $user);
              mysqli_stmt_execute($stmt);
              $resultData = mysqli_stmt_get_result($stmt);

              while ($row = $resultData->fetch_assoc()){
                  $code = $row["code"];
                  
                  if ($row['downloads']>=1){
                  echo '<li class="table-row">';
                  echo '<div class="col col-1" data-label="NHS">' .$row["NHS"] . '</div>';
                  echo '<div class="col col-2" data-label="Code">' .$row["code"] . '</div>';
                  echo '<div class="col col-3" data-label="Size">' .$row["size"] . ' B</div>';
                  echo '<div class="col col-4" data-label="Pdf Name">' .$row["pdfname"] . '</div>';
                  echo "<div class='col col-5' data-label='Download'><form action=phpFunctions/download.inc.php method='post'><button type='submit' value='". $code . "' name='code'>Download</button></form></div>";
                 }   
                }
              }
            
          ?>
      </tbody>
      </table>

      </tbody>
      </table>

      <div class="col-md-3 mx-auto form-group">
        <?php
            if(isset($_GET["error"])) {   
               echo "<p class='red'>Connection failed, please try again later</p>";    
            }

                
        ?>
        </div>
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