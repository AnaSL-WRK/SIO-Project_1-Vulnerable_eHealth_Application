<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

session_start();

if (isset($_POST["update"])) {

    $name = ($_POST["name"]);
    $email = ($_POST["email"]);
    $strphone = ($_POST["phone"]);
    $address = ($_POST["address"]);
    $postal = ($_POST["postalcode"]);
    $city = ($_POST["city"]);
    $DOB = ($_POST["DOB"]);
    $strnhs = ($_POST["NHS"]);



    $nhs = intval($strnhs);
    $phone = intval($strphone);

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    
 
        $sql = "UPDATE users SET name='$name',email='$email',phone='$phone',address='$address',postal='$postal',city='$city',DOB='$DOB' WHERE NHS='$nhs'";


        if(!mysqli_query($conn, $sql)) {
            header("location: ../userInfo.php?error=stmtfailed");
            exit();
        }

        mysqli_query($conn, $sql);

    

 


   header("location: ../userInfo.php?info=userUpdated");

}

?>

