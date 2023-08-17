<?php
    include $_SERVER['DOCUMENT_ROOT']."/src/dbconnect.php";

    $username = $dbconnect->real_escape_string($_POST['username']);
    $email = $dbconnect->real_escape_string($_POST['email']);
    $password = $dbconnect->real_escape_string($_POST['password']);
    
    
    $stmt = $dbconnect->prepare("SELECT user_id FROM users WHERE username = ? or email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows) header("Location: /signup?error=fail");
    else {
        $stmt = $dbconnect->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt -> bind_param("sss", $email, $username, password_hash($password, PASSWORD_DEFAULT));
        $stmt -> execute();

        header("Location: /signin");
    }
?>