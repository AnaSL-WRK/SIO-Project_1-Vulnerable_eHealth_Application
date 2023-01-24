<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



session_start();
if (isset($_POST["updatepwd"])) {

$password = ($_POST["password"]);
$newpassword = ($_POST["newpassword"]);
$newpasswordRPT = ($_POST["newpasswordRPT"]);

$strnhs = $_SESSION["NHS"];

$nhs = intval($strnhs);




$userExists = userExists($conn, $nhs, $nhs);
$pwd =  $userExists["password"];

$checkPwd = password_verify($password, $pwd);

if($checkPwd === false){
    header("location: ../userinfo.php?error=wrongPassword");
    exit();
}


if (pwdNoMatch($newpassword, $newpasswordRPT) !== false){
    header("location: ../userinfo.php?error=pwdDontMatch");
    exit();
}


$sql = "UPDATE users SET password=$newpassword WHERE NHS=$nhs";



if(!mysqli_query($conn, $sql)) {
    header("location: ../userInfo.php?error=stmtfailed");
    exit();
}

mysqli_query($conn, $sql);

header("location: ../userInfo.php?info=pwdUpdated");


}
?>