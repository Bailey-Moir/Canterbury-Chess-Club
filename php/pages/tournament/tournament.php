<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	session_start();
	include "../../dbconnect.php";
	include "../../header.php"; 
	?>
	<link rel="stylesheet" href="/php/pages/tournament/tournament.css">
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "../../modules/navbar/navbar.php"; ?>
	<div id="main">
        <table>
            <tr>
                <th>White</th>
                <th>Result</th>
                <th>Black</th>
            </tr>
            <?php

            $stmt = $dbconnect->prepare("SELECT * FROM games");
            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();
            $results = $stmt->get_result();

            while ($row = $results->fetch_assoc()) {
                
                $white_results = $dbconnect->query("SELECT name FROM members WHERE member_id = ".row['white_member_id']);
                $white = $white_results->fetch_assoc();
                $black_results = $dbconnect->query("SELECT name FROM members WHERE user_imember_idd = ".row['black_member_id']);
                $black = $black_results->fetch_assoc();
            ?>
                <tr>
                    <td><a href="/php/pages/account/account.php?id=<?php echo row['white_member_id']; ?>"><?php echo white['name']; ?></a></td>
                    <td><?php echo row['result']; ?></td>
                    <td><a href="/php/pages/account/account.php?id=<?php echo row['black_member_id']; ?>"><?php echo black['name']; ?></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
	</div>
	<?php include "../../modules/footer/footer.php"; ?>
</body>
</html>