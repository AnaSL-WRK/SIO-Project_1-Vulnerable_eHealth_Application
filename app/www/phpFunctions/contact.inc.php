<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['contact'])) {

    $name = ($_POST["name"]);
    $email = ($_POST["email"]);
    $subject = ($_POST["subject"]);
    $message = ($_POST["message"]);

    $sql = "INSERT INTO contact(name,email,subject,message) VALUES ('$name', '$email', '$subject', '$message')";

    if(mysqli_query($conn,$sql)){
        header("location: ../contact.php?info=success");
        exit();
    }
    else{
        header("location: ../contact.php?error=smtgfailed");
        exit();
    }
    }
?>