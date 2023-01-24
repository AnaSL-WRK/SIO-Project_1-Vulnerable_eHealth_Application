<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


if (isset($_POST["signup"])){

    $name = ($_POST["name"]);
    $email = ($_POST["email"]);
    $strphone = ($_POST["phone"]);
    $address = ($_POST["address"]);
    $postal = ($_POST["postalcode"]);
    $city = ($_POST["city"]);
    $DOB = ($_POST["DOB"]);
    $strnhs = ($_POST["NHS"]);
    $password = ($_POST["password"]);
    $passwordRPT = ($_POST["passwordRPT"]);

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


    if (pwdNoMatch($password, $passwordRPT) !== false){
        header("location: ../signup.php?error=pwdDontMatch");
        exit();
    }



   $sql = "INSERT into users(name,email,phone,address,postal,city,DOB,NHS,password) values('$name', '$email', '$phone', '$address','$postal', '$city', '$DOB', '$nhs', '$password')";   // prepared statement to prevent sql injection

  
   if(!mysqli_query($conn, $sql)) {
       header("location: ../signup.php?error=stmtfailed");
       exit();
   }
   else{
    header("location: ../signup.php?info=userCreated");
    exit();
   }

}
?>

