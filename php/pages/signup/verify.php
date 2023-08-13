<?php

    include("../../dbconnect.php");

    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    
    
    $stmt = $dbconnect->prepare("SELECT user_id FROM users WHERE username = ? or email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows) header("Location: signup.php?error=fail");
    else {
        $stmt = $dbconnect->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt -> bind_param("sss", $email, $username, password_hash($password, PASSWORD_DEFAULT));
        $stmt -> execute();

        header("Location: ../signin/signin.php");
    }
?>