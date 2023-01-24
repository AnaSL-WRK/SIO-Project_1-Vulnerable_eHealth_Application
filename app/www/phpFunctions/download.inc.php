<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if ((isset($_POST["download"])) || (isset($_POST["code"]))) {

        $code = $_POST["code"];
       // echo $code;
        
    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE code = $code;";


    if(!mysqli_query($conn, $sql)) {
        header("location: ../downloadAndStore.php?error=smtgfailed");
        exit();
    }
        $resultData = mysqli_query($conn,$sql);


    if ($file = mysqli_fetch_assoc($resultData)) {       //checks if data exists. if true, grabs the info
        $filename = $file["pdfname"]; 
        $filepath = '../MedicalFilesDB/';      

    $arr = glob($filepath . $filename . ".*", GLOB_ERR);
    $fileInPath = $arr[0];
 

        if (file_exists($fileInPath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($fileInPath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fileInPath));
            readfile($fileInPath);
            ob_clean();
            flush();




            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE files SET downloads=$newCount WHERE code=$code";
            if (!mysqli_query($conn, $updateQuery) ){
                header("location: ../downloadAndStore.php?error=smtgfailed");
                exit();
            }

            mysqli_query($conn, $updateQuery);
            
        }
    }
}

?>