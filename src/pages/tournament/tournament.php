<link rel="stylesheet" href="/src/pages/tournament/tournament.css">

<table class="tournament-table">
    <tr>
        <th>White</th>
        <th>Result</th>
        <th>Black</th>
    </tr>
    <?php

    $stmt = $dbconnect->prepare("SELECT * FROM games WHERE tournament_id = ?");
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
            <td><a href="/account?id=<?php echo $row['white_member_id']; ?>"><?php echo $white['name']; ?></a></td>
            <td><?php echo $row['result']; ?></td>
            <td><a href="/account?id=<?php echo $row['black_member_id']; ?>"><?php echo $black['name']; ?></a></td>
        </tr>
    <?php
    }
    ?>
</table>