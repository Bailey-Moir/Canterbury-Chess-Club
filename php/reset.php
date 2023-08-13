<?php
    // This file resets/creates the database.

    session_start();
    $_SESSION = [];
    session_destroy();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "canterbury_chess_club";

    // Create connection
    $conn =  new mysqli($servername, $username, $password);
    
    $conn->query("DROP DATABASE IF EXISTS $dbname;");
    $conn->query("CREATE DATABASE $dbname;");
    $conn->query("USE $dbname;");

    $conn->query("CREATE TABLE games (
        game_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id_1 INT(3) UNSIGNED NOT NULL,
        user_id_2 INT(3) UNSIGNED NOT NULL,
        tournament_ID INT(2) UNSIGNED NOT NULL,
        result TINYINT(1) UNSIGNED NOT NULL,
        moves varchar(500) NOT NULL
    );");
    $conn->query("CREATE TABLE ratings (
        rating_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(3) UNSIGNED NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        rating_standard INT(4) UNSIGNED NOT NULL,
        rating_rapid INT(4) UNSIGNED NOT NULL,
        rating_blitz INT(4) UNSIGNED NOT NULL,
    );");
    $conn->query("CREATE TABLE tournaments (
        tournament_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date_start TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_end TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        num_rounds INT(1) UNSIGNED NOT NULL,
        name VARCHAR(30) NOT NULL,
    );");
    $conn->query("CREATE TABLE users (
        user_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        member_id INT(4) UNSIGNED NOT NULL,
        email VARCHAR(48) NOT NULL,
        username VARCHAR(16) NOT NULL,
        password VARCHAR(60) NOT NULL,
        security TINYINT(1) UNSIGNED NOT NULL, # Admin
        verified TINYINT(1) UNSIGNED NOT NULL,
        status VARCHAR(8) NOT NULL
    );");
    $conn->query("CREATE TABLE members (
        member_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(4) UNSIGNED,
        name VARCHAR(20) NOT NULL,
        birth_year TIMESTAMP NOT NULL,
        nzcf_code INT(7) NOT NULL,
        fide_code INT(7) NOT NULL
    );");

    header("Location: /index.php");
    die();
?>