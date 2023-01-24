<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

session_start();

if (isset($_POST["update"])) {

    $name = testInput($_POST["name"]);
    $email = testInput($_POST["email"]);
    $strphone = testInput($_POST["phone"]);
    $address = testInput($_POST["address"]);
    $postal = testInput($_POST["postalcode"]);
    $city = testInput($_POST["city"]);
    $DOB = ($_POST["DOB"]);
    $strnhs = testInput($_POST["NHS"]);



    $nhs = intval($strnhs);
    $phone = intval($strphone);



    
 
        $sql = "UPDATE users SET name=?,email=?,phone=?,address=?,postal=?,city=?,DOB='$DOB' WHERE NHS=?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../userInfo.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ssisssi",$name,$email,$phone,$address,$postal,$city,$nhs);

    

   mysqli_stmt_execute($stmt);


   header("location: ../userInfo.php?info=userUpdated");

}

?>

