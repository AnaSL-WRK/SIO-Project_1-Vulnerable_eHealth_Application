<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['appointment'])) {

    $name = ($_POST["name"]);
    $email = ($_POST["email"]);
    $phone = ($_POST["phone"]);
    $date = $_POST["date"];
    $department = $_POST["department"];
    $doctor = $_POST["doctor"];
    $message = ($_POST["message"]);

    if (!$phone === Null){
        $sql = "INSERT INTO appointment(name,email,phone,date,department,doctor,message) VALUES ('$name', '$email','$phone', '$date', '$department' , '$doctor' , '$message')";
    }
    else{
       $sql = "INSERT INTO appointment(name,email,date,department,doctor,message) VALUES ('$name', '$email','$date', '$department' , '$doctor' , '$message')";
    }

    if(mysqli_query($conn,$sql)){
        header("location: ../appointment.php?info=success");
        exit();
    }
    else{
        header("location: ../appointment.php?error=smtgfailed");
        exit();
    }
    }
?>