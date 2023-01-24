<?php



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




function pwdNoMatch($password, $passwordRPT){
    if ($password !== $passwordRPT) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}



//checks if user exists
function userExists($conn, $email, $NHS) {              
    $sql = "SELECT * FROM users WHERE email = '$email' OR NHS = '$NHS';";   // prepared statement to prevent sql injection
    
    if(!mysqli_query($conn, $sql)) {
        header("location: ../index.php?error=smtgfailed");
        exit();
    }
    else{

        $resultData = mysqli_query($conn,$sql);

    if ($row = mysqli_fetch_assoc($resultData)) {       //checks if data exists. if true, grabs the info
        return $row;                                    //associative array
    }
    else {
        $result = false;
    return $result;
    }
}
}


?>