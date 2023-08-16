<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "canterbury_chess_club";

    $dbconnect =  new mysqli($servername, $username, $password, $dbname);

    if ($dbconnect->connect_error) {
        die("Connection failed: " . $dbconnect->connect_error);
    }

?>