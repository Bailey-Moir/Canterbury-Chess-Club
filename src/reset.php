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
    $conn = new mysqli($servername, $username, $password);
    
    $conn->query("DROP DATABASE IF EXISTS $dbname;");
    $conn->query("CREATE DATABASE $dbname;");
    $conn->query("USE $dbname;");

    $conn->query("CREATE TABLE games (
        game_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        black_member_id INT(3) UNSIGNED NOT NULL,
        white_member_id INT(3) UNSIGNED NOT NULL,
        tournament_id INT(2) UNSIGNED NOT NULL,
        result TINYINT(1) UNSIGNED NOT NULL,
        moves varchar(500) NOT NULL
    );");
    $conn->query("CREATE TABLE ratings (
        rating_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        member_id INT(3) UNSIGNED NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        rating_standard INT(4) UNSIGNED NOT NULL,
        rating_rapid INT(4) UNSIGNED NOT NULL,
        rating_blitz INT(4) UNSIGNED NOT NULL
    );");
    $conn->query("CREATE TABLE tournaments (
        tournament_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date_start TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        date_end TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        num_rounds INT(1) UNSIGNED NOT NULL,
        name VARCHAR(30) NOT NULL
    );");
    $conn->query("CREATE TABLE users (
        user_id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        member_id INT(4) UNSIGNED,
        email VARCHAR(48) NOT NULL,
        username VARCHAR(16) NOT NULL UNIQUE,
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

    $conn->query("INSERT INTO tournaments (date_start, date_end, num_rounds, name) VALUES
        ('23/11/2022', '07/12/2022', 6, \"Arie Nijman Cup 2022\"),
        ('28/09/2022', '09/11/2022', 6, \"Chas L Hart Cup 2022\"),
        ('10/08/2022', '14/09/2022', 6, \"Eric Brown Shield 2022\"),
        ('13/05/2022', '29/06/2022', 8, \"Club Championships 2022 B Grade\"),
        ('13/05/2022', '22/06/2022', 7, \"Club Championships 2022 A Grade\"),
        ('13/05/2022', '15/05/2022', 6, \"Arie Nijman Memorial 2022\"),
        ('09/03/2022', '13/04/2022', 6, \"Colthart Cup 2022\"),
        ('02/02/2022', '16/02/2022', 6, \"Summer Rapid 2022\")
    ");

    $conn->query("INSERT INTO members (name, birth_year, nzcf_code, fide_code) VALUES
        (\"Aaron\", NOW(), 1234567, 1234567),
        (\"Brock\", NOW(), 1234567, 1234567),
        (\"Caleb\", NOW(), 1234567, 1234567),
        (\"Dominic\", NOW(), 1234567, 1234567)
    ");

    $conn->query("INSERT INTO games (black_member_id, white_member_id, tournament_id, result, moves) VALUES
        (1, 2, 1, 1, \"e4 e5 Nf3 Nc6 Bb5 a6 Ba4 Nf6 O-O Be7 Re1 b5 Bb3 d6 c3 O-O h3 Bb7 d4 Na5 Bc2 Nc4 b3 Nb6 Nbd2 Nbd7 b4 exd4 cxd4 a5 bxa5 c5 e5 dxe5 dxe5 Nd5 Ne4 Nb4 Bb1 Rxa5 Qe2 Nb6 Nfg5 Bxe4 Qxe4 g6 Qh4 h5 Qg3 Nc4 Nf3 Kg7 Qf4 Rh8 e6 f5 Bxf5 Qf8 Be4 Qxf4 Bxf4 Re8 Rad1 Ra6 Rd7 Rxe6 Ng5 Rf6 Bf3 Rxf4 Ne6+ Kf6 Nxf4 Ne5 Rb7 Bd6 Kf1 Nc2 Re4 Nd4 Rb6 Rd8 Nd5+ Kf5 Ne3+ Ke6 Be2 Kd7 Bxb5+ Nxb5 Rxb5 Kc6 a4 Bc7 Ke2 g5 g3 Ra8 Rb2 Rf8 f4 gxf4 gxf4 Nf7 Re6+ Nd6 f5 Ra8 Rd2 Rxa4 f6\"),
        (1, 3, 1, 1, \"e4 d6 d4 Nf6 Nc3 g6 f4 Bg7 a3 O-O Nf3 Bg4 h3 Bxf3 Qxf3 Nc6 Be3 e5 dxe5 dxe5 f5 Nd4 Qf2 Nd7 g4 c6 O-O-O b5 g5 f6 h4 a5 h5 fxg5 hxg6 h6 Ne2 c5 Nc3 b4 Bc4+ Kh8 Rxh6+ Bxh6 Qh2 Kg7 Qxh6+ Kxh6 Rh1+\"),
        (4, 2, 3, 1, \"e4 e5 Nf3 Nc6 Bc4 Bc5 c3 Nf6 d3 d6 O-O Bg4 h3 Bh5 Nbd2 Qe7 Re1 O-O-O Nf1 Bb6 Ng3 h6 b4 Rdg8 Qe2 Nd8 Bd2 c6 a4 Bg6 Qf1 Ne6 Be3 Kb8 Red1 Bh7 Kh1 g5 Bb3 Rg7 c4 Rhg8 d4 exd4 Nxd4 Nf4 f3 Qd7 Bf2 h5 Qe1 a6 Nf1 Qe8 Ng3 Qd7 Nf1 Qe8 Ne3 h4 b5 cxb5 axb5 axb5 cxb5 Nxe4 fxe4 Bxe4 Qf1 Bd8 Nc4 Be7 Ra8+ Kxa8 Ra1+ Kb8 Ra8+ Kxa8 Qa1+ Kb8 Qa7+ Kxa7 Nc6+ Ka8 Nb6\")
    ");

    header("Location: /");
    die();
?>