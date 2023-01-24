<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['contact'])) {

    $name = testInput($_POST["name"]);
    $email = testInput($_POST["email"]);
    $subject = testInput($_POST["subject"]);
    $message = testInput($_POST["message"]);

    $sql = "INSERT INTO contact(name,email,subject,message) VALUES (?,?,?,?)";


$stmt = mysqli_stmt_init($conn);
  
if(!mysqli_stmt_prepare($stmt, $sql)) {
     header("location: ../contact.php?error=smtgfailed");
     exit();
}

   mysqli_stmt_bind_param($stmt,"ssss", $name, $email, $subject, $message);
   mysqli_stmt_execute($stmt);

   header("location: ../contact.php?info=success");
    exit();

}

?>