<?php


function pwdNoMatch($password, $passwordRPT){
    if ($password !== $passwordRPT) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function validateDate($date){
    $dob =  new DateTime($date);
    $upperLimit = new DateInterval('P16Y');
    $lowerLimit = new DateInterval('P120Y');
    $minDobLimit = ( new DateTime() )->sub($upperLimit);
    $maxDobLimit = ( new DateTime() )->sub($lowerLimit);

    if ($dob <= $maxDobLimit || $dob >= $minDobLimit) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function weakPassword($password){

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidNHS($nhs){

    $number = is_numeric($nhs);
    $stringNHS = (string)$nhs;
    
    if(!$number || strlen($stringNHS) != 9) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}




//checks if user exists
function userExists($conn, $email, $NHS) {              
    $sql = "SELECT * FROM users WHERE email = ? OR NHS = ?;";   // prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $email, $NHS);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {       //checks if data exists. if true, grabs the info
        return $row;                                    //associative array
    }
    else {
        $result = false;
    return $result;
    }
}

function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
    $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
    }


function testInput($data) {     //validation to prevent xss attacks
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
