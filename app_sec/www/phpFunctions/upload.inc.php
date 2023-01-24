<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["upload"])){

        $code = testInput($_POST["code"]);
        $file = testInput($_POST["myFile"]);
        $nhs = testInput($_POST["NHS"]);
        


// for security reasons, we can't get the filesize using $_FILES.  (it isnt reliable)
// When the user uploads the file,
//  PHP stores it temporarily and you can get the path using

$filepath = $_FILES['myFile']['tmp_name'];
$fileSize = filesize($filepath);
$fileinfo = finfo_open(FILEINFO_MIME_TYPE); // This function can return empty string instead of FALSE for some file types (ppt for example)., to fix that we need to check

if ($fileinfo != NULL && $filepath != NULL ) {
    $filetype = finfo_file($fileinfo, $filepath);

}
// if info is null its because its not a pdf file (since those are accepted)
else {
    header("location: ../ADMupload.php?error=filenotallowed");
    exit();

}

//echo 'hello';

// restrict file type
$allowedTypes = [
    'application/pdf' => 'pdf'


];
if(!in_array($filetype, array_keys($allowedTypes)))
 {
    header("location: ../ADMupload.php?error=filenotallowed");
    exit();
}


if ($fileSize === 0) {
    header("location: ../ADMupload.php?error=emptyfile");
    exit();

}

//limit size og file
if ($fileSize > 500000) { // (500kb)
    header("location: ../ADMupload.php?error=filetoobig");
    exit();

}


$filename = basename($filepath); 
$extension = $allowedTypes[$filetype];
$targetDirectory = "../MedicalFilesDB";

$newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

if (!copy($filepath, $newFilepath )) { // Copy the file, returns false if failed
    header("location: ../ADMupload.php?error=stmtfailed");
    exit();
 }

unlink($filepath); // Delete the temp file

$sql = "INSERT INTO files(code,NHS,size,pdfname) VALUES(?,?, '$fileSize', '$filename')";

$stmt = mysqli_stmt_init($conn);

   
  
if(!mysqli_stmt_prepare($stmt, $sql)) {
     header("location: ../ADMupload.php?error=stmtfailed");
     exit();
}
   mysqli_stmt_bind_param($stmt,"si", $code, $nhs);
   mysqli_stmt_execute($stmt);

   header("location: ../ADMupload.php?info=fileuploaded");
    exit();



}
?>