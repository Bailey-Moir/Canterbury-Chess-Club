<!-- Gavith -->
<?php
    require $_SERVER['DOCUMENT_ROOT']."/chessclub"."/src/secure/server_creds.php";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>