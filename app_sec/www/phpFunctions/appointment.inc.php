<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['appointment'])) {

    $name = testInput($_POST["name"]);
    $email = testInput($_POST["email"]);
    $phone = testInput($_POST["phone"]);
    $date = $_POST["date"];
    $department = $_POST["department"];
    $doctor = $_POST["doctor"];
    $message = testInput($_POST["message"]);

    if (!$phone === Null){
        $sql = "INSERT INTO appointment(name,email,phone,date,department,doctor,message) VALUES (?, ?, ?, '$date', '$department' , '$doctor' , ?)";
    }
    else{
       $sql = "INSERT INTO appointment(name,email,date,department,doctor,message) VALUES (?, ?,'$date', '$department' , '$doctor' , ?)";
    }


    $stmt = mysqli_stmt_init($conn);
      
    if(!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../appointment.php?error=smtgfailed");
         exit();
    }
    

    if (!$phone === Null){
       mysqli_stmt_bind_param($stmt,"ssis", $name, $email, $phone, $message);
    }
    else{
        mysqli_stmt_bind_param($stmt,"sss", $name, $email, $message);
    }

       mysqli_stmt_execute($stmt);
    
       header("location: ../appointment.php?info=success");
        exit();
    
    }

?>