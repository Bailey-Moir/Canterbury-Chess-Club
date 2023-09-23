<!-- Gavith -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "canterbury_chess_club";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>