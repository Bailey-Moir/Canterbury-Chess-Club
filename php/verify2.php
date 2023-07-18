<?php

    include("dbconnect.php");

    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    $stmt = $dbconnect->prepare("INSERT INTO user (email, username, password) VALUES (?, ?, ?)");
    $stmt -> bind_param("sss", $email, $username, $password);
    $stmt -> execute();

    header("Location: signin.php");
?>