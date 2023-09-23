<!-- Bailey -->
<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT']."/src/secure/dbconnect.php";

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) {
        header("Location: /");
        die();
    }

    $black_nzcf = $conn->real_escape_string($_POST['black_nzcf']);
    $white_nzcf = $conn->real_escape_string($_POST['white_nzcf']);
    $result = $_POST['blackCheck'];    
    $moves = $conn->real_escape_string($_POST['moves']);
    $tournament_id = $conn->real_escape_string($_POST['tournament_id']);
    
        
    $stmt = $conn->prepare("SELECT member_id AS v FROM members WHERE nzcf_code = ?");
    $stmt->bind_param("s", $black_nzcf);
    $stmt->execute();
    $black_member_results = $stmt->get_result()->fetch_assoc();

    $stmt = $conn->prepare("SELECT member_id AS v FROM members WHERE nzcf_code = ?");
    $stmt->bind_param("s", $white_nzcf);
    $stmt->execute();
    $white_member_results = $stmt->get_result()->fetch_assoc();

    $stmt = $conn->prepare("INSERT INTO games (black_member_id, white_member_id, tournament_id, result, moves) VALUES
        (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iiiis", $black_member_results['v'], $white_member_results['v'], $tournament_id, $result, $moves);
    $stmt->execute();

    header("Location: /admin")

    
?>