<!-- Bailey -->
<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT']."/chessclub"."/src/secure/dbconnect.php";

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) {
        header("Location: /chessclub/");
        die();
    }

    // process moves
    $moves = $conn->real_escape_string( trim( preg_replace('/((\s|\n)+(\d)+.(\s|\n)*)|\n/', " ", " ".$_POST['moves']) ) );

    $white_nzcf = $conn->real_escape_string($_POST['white_nzcf']);
    $black_nzcf = $conn->real_escape_string($_POST['black_nzcf']);

    $tournament_id = $conn->real_escape_string($_POST['tournament_id']);
    if (!is_numeric($tournament_id)) {
        header("Location: /chessclub/admin?err=gInvalidTournament");
        die();
    }
    
    if (isset($_POST['whiteCheck']) && $_POST['whiteCheck']) $result = 1;
    else if (isset($_POST['blackCheck']) && $_POST['blackCheck']) $result = 0;
    else if (isset($_POST['drawCheck']) && $_POST['drawCheck']) $result = 2;
    else {
        header("Location: /chessclub/admin?err=gNoneChecked");
        die();
    }

    $stmt = $conn->prepare("SELECT member_id AS v FROM members WHERE nzcf_code = ?");
    $stmt->bind_param("s", $white_nzcf);
    $stmt->execute();
    $qresult = $stmt->get_result(); 
    if ($qresult->num_rows == 0) {
        header("Location: /chessclub/admin?err=gNoWhiteMember");
        die();
    }
    $white_member_results = $qresult->fetch_assoc();
        
    $stmt = $conn->prepare("SELECT member_id AS v FROM members WHERE nzcf_code = ?");
    $stmt->bind_param("s", $black_nzcf);
    $stmt->execute();
    $qresult = $stmt->get_result();
    if ($qresult->num_rows == 0) {
        header("Location: /chessclub/admin?err=gNoBlackMember");
        die();
    }
    $black_member_results = $qresult->fetch_assoc();


    $stmt = $conn->prepare("INSERT INTO games (black_member_id, white_member_id, tournament_id, result, moves) VALUES
        (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iiiis", $black_member_results['v'], $white_member_results['v'], $tournament_id, $result, $moves);
    $stmt->execute();
    if ($stmt->affected_rows == 0) {
        header("Location: /chessclub/admin?err=gfail");
    }

    header("Location: /chessclub/admin")

    
?>