 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><img src="assets/img/eHealth-logo.png">eHealth</h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
        <?php
              if($_SESSION["userType"] == "normal"){
                echo "<li><a href='../loggedIn.php'>Home</a></li>";
                echo '<li><a href="../contact.php">Contact</a></li>';
                echo '<li><a  href="../appointment.php">Make an Appointment</a></li>';
                echo "<li><a href='downloadAndStore.php'> Download your clinical exams </a></li>";
                echo "<li><a href='../userInfo.php'>Account Information</a></li>";
              }
              else if($_SESSION["userType"] == "admin"){
                echo "<li><a href='../loggedIn.php'>Home</a></li>";
                echo "<li><a href='../ADMcontactReq.php'> Contact Requests </a></li>";
                echo "<li><a href='../ADMappointmentReq.php'> Appointment Requests </a></li>";
                echo "<li><a href='../ADMupload.php'> Upload Clinical Exams </a></li>";
              
              }
              else{
                echo "<li><a href='../index.php'>Home</a></li>";
                echo '<li><a href="../contact.php">Contact</a></li>';
                echo '<li><a  href="../appointment.php">Make an Appointment</a></li>';
                echo "<li><a href='../downloadExams.php'> Download your clinical exams </a></li>";
              }


          ?>


        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php
              if(isset($_SESSION["userID"])) {
                echo "<a href='phpFunctions/logout.inc.php' class='appointment-btn scrollto'>Logout</a>";
              }
              else{
                echo "<a href='#myModal'class='appointment-btn scrollto' data-toggle='modal'>Login</a>";
              }
      ?>
      
      
    </div>
  </header><!-- End Header -->

  <!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Member Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body row">
				<form action="../phpFunctions/login.inc.php" method="post">
					<div class="col-md-12 form-group mx-auto">
						<i class="fa fa-user"></i>
						<input type="text" name="username" class="form-control" placeholder="Email / NHS" required>
					</div>
					<div class="col-md-12 form-group mx-auto">
						<i class="fa fa-lock"></i>
						<input type="password" name="pwd" class="form-control" placeholder="Password" required>					
					</div>
					<div class="col-md-5 form-group mx-auto">
						<button type="submit" name="submit" id="login" class="btn btn-primary btn-block btn-lg">Login</button>
					</div>
          <div class="form-row"> <a href="signup.php">Don´t have an account? Sign up here</a> </div>
				</form>
        <?php
        
           if(isset($_GET["error"])) {
           
             if ($_GET["error"] == "stmtwrong") {
              echo "<p class='red'>Connection failed, please try again later</p>";
              }

             else if ($_GET["error"] == "wronguser") {
                echo "<p class='red'>The user does not exist.</p>";
                echo "<p class='red'>Please try a different email/NHS.</p>";
                }
              else if ($_GET["error"] == "wrongpassword") {
                  echo "<p class='red'>Incorrect password.<p>";
                  }
          }
         ?>
          

			</div>
		</div>
	</div>
</div>     