<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



session_start();
if (isset($_POST["updatepwd"])) {

$password = testInput($_POST["password"]);
$newpassword = testInput($_POST["newpassword"]);
$newpasswordRPT = testInput($_POST["newpasswordRPT"]);

$strnhs = $_SESSION["NHS"];

$nhs = intval($strnhs);




$userExists = userExists($conn, $nhs, $nhs);
$pwdHashed =  $userExists["password"];

$checkPwd = password_verify($password, $pwdHashed);

if($checkPwd === false){
    header("location: ../userinfo.php?error=wrongPassword");
    exit();
}

if (weakPassword($newpassword) !== false){
    header("location: ../userinfo.php?error=weakPassword");
    exit();
}

if (pwdNoMatch($newpassword, $newpasswordRPT) !== false){
    header("location: ../userinfo.php?error=pwdDontMatch");
    exit();
}


$sql = "UPDATE users SET password=? WHERE NHS=?";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../userInfo.php?error=stmtfailed");
    exit();
}


$hashedpwd = password_hash($newpassword, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt,"si",$hashedpwd,$nhs);



mysqli_stmt_execute($stmt);


header("location: ../userInfo.php?info=pwdUpdated");


}
?>