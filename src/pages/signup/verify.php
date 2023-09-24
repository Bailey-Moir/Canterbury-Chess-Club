<!-- Gavith -->
<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT']."/src/secure/dbconnect.php";

    if (!preg_match('/^[A-z\d._\-]{1,16}$/', $_POST['username'])) {
        header("Location: /signup?err=username");
        die();
    }
    if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $_POST['email'])) { // from https://regexr.com/3e48o
        header("Location: /signup?err=email");
        die();
    }    
    if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/', $_POST['password'])) { // from https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a
        header("Location: /signup?err=password");
        die();
    }

    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? or email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows) {
        header("Location: /signup?err=taken");
        die();
    }
    

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, username, password, security, verified) VALUES (?, ?, ?, 0, 0)");
    $stmt->bind_param("sss", $email, $username, $hashed_pass);
    $stmt->execute();

    $_SESSION['logged_in']['user_id'] = mysqli_insert_id($conn);
    $_SESSION['logged_in']['name'] = $username;

    header("Location: /accounts/".urlencode($_SESSION['logged_in']['name'])."/games");
?>