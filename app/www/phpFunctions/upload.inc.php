<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["upload"])){

        $code = ($_POST["code"]);
        $file = ($_POST["myFile"]);
        $nhs = ($_POST["NHS"]);
 
        



$filepath = $_FILES['myFile']['tmp_name'];
$fileName = $_FILES['myFile']['name'];
$fileSize = $_FILES['myFile']['size'];
$fileNameParts = explode('.', $fileName);
$ext = end($fileNameParts);




$filename = basename($filepath); 
$targetDirectory = "../MedicalFilesDB";

$newFilepath = $targetDirectory . "/" . $filename . "." . $ext;

if (!copy($filepath, $newFilepath )) { // Copy the file, returns false if failed
    header("location: ../ADMupload.php?error=stmtfailed");
    exit();
 }

unlink($filepath); // Delete the temp file

#sql query to insert into database
$sql = "INSERT INTO files(code,NHS,size,pdfname) VALUES('$code', '$nhs', '$fileSize', '$filename')";



if(mysqli_query($conn,$sql)){
    header("location: ../ADMupload.php?info=fileuploaded");
    exit();

}
else{
    header("location: ../ADMupload.php?error=stmtfailed");
    exit();

}
}
?>