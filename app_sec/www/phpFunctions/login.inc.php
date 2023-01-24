<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])){


    $time=time()-60;
    $ip_address=getIpAddr();

    $query= "SELECT count(*) as total_count from loginlogs where TryTime > $time and IpAddress='$ip_address'";
    

    if (!mysqli_query($conn,$query))
	{
        header("location: ../index.php?error=stmtwrong");
        exit();
    }

    $data = mysqli_query($conn,$query);
    $check_login_row=mysqli_fetch_assoc($data);
    $total_count=$check_login_row['total_count'];

    //3 tries before 1 min lock
    if($total_count>=3){
        header("location: ../index.php?error=wronglogin0");
    
    }
    else{


    $username = testInput($_POST["username"]);
    $pwd = testInput($_POST["pwd"]);


    $userExists = userExists($conn, $username, $username);
    $checkPwd = false;
 
    

    if (!$userExists === false){
        $pwdHashed =  $userExists["password"];
        $checkPwd = password_verify($pwd, $pwdHashed);

    }



    if (($userExists === false) || ($checkPwd === false)){        
        $total_count++;
        $rem_attm= 3-$total_count;

        if($rem_attm == 2){
             header("location: ../index.php?error=wronglogin2");
   
        }

         else if($rem_attm == 1){
            header("location: ../index.php?error=wronglogin1");

        }


        else if($rem_attm <= 0){
          header("location: ../index.php?error=wronglogin0");
   
        }

        $try_time=time();
        $queryIns = "INSERT into loginlogs(IpAddress,TryTime) values('$ip_address','$try_time')";

        if (!mysqli_query($conn,$queryIns))
        {
            header("location: ../index.php?error=stmtwrong");
        }
        else{
            exit();
        }
        
    }



    else if ($checkPwd === true){
        session_start();
        $_SESSION["userID"] = $userExists["userID"];
        $_SESSION["name"] = $userExists["name"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["userType"] = $userExists["userType"];
        $_SESSION["NHS"] = $userExists["NHS"];

        $queryDel = "DELETE from loginlogs where IpAddress='$ip_address'";
        mysqli_query($conn,$queryDel);

        header("location: ../loggedIn.php");
        exit();
    }

}
}
?>