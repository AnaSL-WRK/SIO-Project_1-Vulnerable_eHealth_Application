<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



if (isset($_POST["submit"])){

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM users WHERE (email = '$username' OR NHS = '$username') AND password = '$pwd' ";
    

    if (!mysqli_query($conn,$sql))
	{
        header("location: ../index.php?error=stmtwrong");
        exit();
    }else{


        $userExists = userExists($conn, $username, $username);

        if ($userExists === false){
            header("location: ../index.php?error=wronguser");
            exit();
        }
        else{

            $resultData = mysqli_query($conn,$sql);

         
           if($user = mysqli_fetch_assoc($resultData)){

        
            session_start();
            $_SESSION["userID"] = $userExists["userID"];
            $_SESSION["name"] = $userExists["name"];
            $_SESSION["email"] = $userExists["email"];
            $_SESSION["userType"] = $userExists["userType"];
            $_SESSION["NHS"] = $userExists["NHS"];
            header("location: ../loggedIn.php");
            exit();
        }
        else{
            header("location: ../index.php?error=wrongpassword");
            exit();
        }

        }
  
    }
}

?>