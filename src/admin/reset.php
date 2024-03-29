<!-- Bailey -->
<?php    
    // This file resets/creates the database.
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) {
        header("Location: /chessclub");
        die();
    }

    $_SESSION = [];
    session_destroy();
    
    require $_SERVER['DOCUMENT_ROOT']."/chessclub/src/secure/dbconnect.php";
    
    $conn->query("DROP DATABASE IF EXISTS $dbname;");
    $conn->query("CREATE DATABASE $dbname;");
    $conn->query("USE '$dbname';");

    $conn->multi_query(file_get_contents("./databases/main.sql"));
    while ($conn->next_result()) {;} // flush multi_queries

    session_start();

    $_SESSION['logged_in']['user_id'] = 1;
    $_SESSION['logged_in']['name'] = "admin";
    $_SESSION['logged_in']['admin'] = TRUE;

    header("Location: /chessclub/admin");
?>