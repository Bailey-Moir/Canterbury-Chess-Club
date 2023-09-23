<!-- Gavith -->
<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT']."/src/dbconnect.php";

    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? or email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows) header("Location: /signup?error=fail");
    else {
        $_SESSION['logged_in']['security'] = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $_SESSION['logged_in']['security']);
        $stmt->execute();

        $_SESSION['logged_in']['user_id'] = mysqli_insert_id($conn);
        $_SESSION['logged_in']['name'] = $username;

        header("Location: /accounts/".urlencode($_SESSION['logged_in']['name'])."/games");
    }
?>