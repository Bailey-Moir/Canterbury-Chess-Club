<?php
$stmt = $conn->prepare(
    "SELECT 
        tournament_id AS id,
        name
    FROM tournaments
    WHERE name = ?;"
);
if (!$stmt) {
    die("Error in preparing the statement: " . $conn->error);
}
$str = urldecode($_GET["name"]);
$stmt->bind_param("s", $str);
$stmt->execute();
$tournaments_results = $stmt->get_result()->fetch_assoc();
?>

<h1><?php echo $tournaments_results['name']; ?></h1>

<center>
    <table class="tournament-table">
        <tr>
            <th>White</th>
            <th>Result</th>
            <th>Black</th>
        </tr>
        <?php
        $stmt = $conn->prepare(
            "SELECT 
                games.white_member_id AS white_member_id,
                games.black_member_id AS black_member_id,
                games.result AS result,
                bm.name AS black_name,
                wm.name AS white_name
            FROM games
            JOIN members bm ON games.black_member_id = bm.member_id
            JOIN members wm ON games.white_member_id = wm.member_id
            WHERE games.tournament_id = ".$tournaments_results['id'].";"
        );
        $stmt->execute();
        $game_results = $stmt->get_result();
        while ($row = $game_results->fetch_assoc()) {
            ?>
            <tr>
                <td><a href="#"><?php echo $row['white_name']; ?></a></td>
                <td><?php echo $row['result'] ? "White": "Black"; ?></td>
                <td><a href="#"><?php echo $row['black_name']; ?></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</center>