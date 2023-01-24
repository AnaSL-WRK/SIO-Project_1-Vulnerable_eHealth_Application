<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if ((isset($_POST["download"])) || (isset($_POST["code"]))) {

        $code = testInput($_POST["code"]);

        
    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE code = ?;";
    $stmt = mysqli_stmt_init($conn);


    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../downloadAndStore.php?error=smtgfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $code);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($file = mysqli_fetch_assoc($resultData)) {       //checks if data exists. if true, grabs the info
        
        $filename = $file["pdfname"] . '.pdf';      //can only download if .pdf
        $filepath = '../MedicalFilesDB/' . $filename;                                           

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile('../MedicalFilesDB/' . $filename);
            ob_clean();
            flush();

            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE files SET downloads=$newCount WHERE code=$code";
            mysqli_query($conn, $updateQuery);
            exit;
        }
    }
}

?>