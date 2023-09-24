<?php
    // Bailey
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) {
        header("Location: /");
        die();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "canterbury_chess_club";

    $filename = "databases/backup.sql";

    // Execute the command
    system("C:\\xampp\\mysql\\bin\\mysqldump --single-transaction --host=$servername --user=$username --password=$password $dbname > $filename", $returnStatus);
    
    if ($returnStatus !== 0) {
        header("Location: /admin?err=$thing");
        die();
    }

    // Define header information (from https://linuxhint.com/download_file_php/)
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Length: ' . filesize($filename));
    header('Pragma: public');

    //Clear system output buffer
    flush();

    //Read the size of the file
    readfile($filename);

    header("Location: /admin");
?>