<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


if (isset($_POST["signup"])){

    $name = testInput($_POST["name"]);
    $email = testInput($_POST["email"]);
    $strphone = testInput($_POST["phone"]);
    $address = testInput($_POST["address"]);
    $postal = testInput($_POST["postalcode"]);
    $city = testInput($_POST["city"]);
    $DOB = ($_POST["DOB"]);
    $strnhs = testInput($_POST["NHS"]);
    $password = testInput($_POST["password"]);
    $passwordRPT = testInput($_POST["passwordRPT"]);


    $nhs = intval($strnhs);
    $phone = intval($strphone);


    if (validateDate($DOB) !== false){
        header("location: ../signup.php?error=invalidDate");
        exit();
    }

    if (invalidNHS($nhs) !== false){
        header("location: ../signup.php?error=invalidNHS");
        exit();
    }
      
    if (userExists($conn, $email, $nhs) !== false){
        header("location: ../signup.php?error=userTaken");
        exit();
    }

    if (weakPassword($password) !== false){
        header("location: ../signup.php?error=weakPassword");
        exit();
    }

    if (pwdNoMatch($password, $passwordRPT) !== false){
        header("location: ../signup.php?error=pwdDontMatch");
        exit();
    }



   $sql = "INSERT into users(name,email,phone,address,postal,city,DOB,NHS,password) values(?, ?, ?, ?, ?, ?, '$DOB', ?, ?)";   // prepared statement to prevent sql injection
   $stmt = mysqli_stmt_init($conn);
  
   if(!mysqli_stmt_prepare($stmt, $sql)) {
       header("location: ../signup.php?error=stmtfailed");
       exit();
   }

   $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

   mysqli_stmt_bind_param($stmt,"ssisisis",$name,$email,$phone,$address,$postal,$city,$nhs,$hashedpwd);
   mysqli_stmt_execute($stmt);


   header("location: ../signup.php?info=userCreated");

}
?>

