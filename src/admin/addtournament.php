<!-- Bailey -->
<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT']."/chessclub"."/src/secure/dbconnect.php";

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) {
        header("Location: /chessclub/");
        die();
    }


    $date_start_raw = htmlentities($_POST['date_start']);
    if ($date_start_raw == NULL) {
        header("Location: /chessclub/admin?err=temptyDateStart");
        end();
    }
    $date_start = date('Y-m-d', strtotime($date_start_raw));

    $date_end_raw = htmlentities($_POST['date_end']);
    if ($date_end_raw == NULL) {
        header("Location: /chessclub/admin?err=temptyDateEnd");
        end();
    }
    $date_end = date('Y-m-d', strtotime($date_end_raw));

    $tournament_name = $conn->real_escape_string($_POST['name']);
    if ($tournament_name == "") {
        header("Location: /chessclub/admin?err=temptyName");
        end();
    }

    $rounds = $_POST['rounds'];
    if ($rounds == NULL) {
        header("Location: /chessclub/admin?err=temptyRound");
        end();
    }
    if (!is_numeric($rounds) || $rounds < 1 || $rounds > 9) {
        header("Location: /chessclub/admin?err=tinvalidRound");
        end();
    }
    
    $stmt = $conn->prepare("INSERT INTO tournaments (date_start, date_end, name, num_rounds) VALUES
        (?, ?, ?, ?)
    ");
    $stmt->bind_param("sssi", $date_start, $date_end, $tournament_name, $rounds);
    $stmt->execute();
    if ($stmt->affected_rows == 0) {
        header("Location: /chessclub/admin?err=tfail");
    }

    header("Location: /chessclub/admin")

    
?>