<!-- Bailey -->
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

<table class="tournament-table">
    <tr>
        <th>White</th>
        <th>Result</th>
        <th>Black</th>
    </tr>
    <?php
    $stmt = $conn->prepare(
        "SELECT 
            white_member_id,
            black_member_id
        FROM games
        WHERE tournament_id = ".$tournaments_results['id'].";"
    );
    $stmt->execute();
    $game_results = $stmt->get_result();
    while ($row = $game_results->fetch_assoc()) {
        $stmt = $conn->query(
            "SELECT 
                bm.name AS black_name,
                wm.name AS white_name
            FROM members bm
            JOIN members wm ON wm.member_id = ".$row['white_member_id']."
            WHERE bm.member_id = ".$row['black_member_id'].";"
        );
        $member_results = $stmt->fetch_assoc();
    ?>
        <tr>
            <td><a href="/account?id=<?php echo $row['white_member_id']; ?>"><?php echo $member_results['white_name']; ?></a></td>
            <td><?php echo $row['result']; ?></td>
            <td><a href="/account?id=<?php echo $row['black_member_id']; ?>"><?php echo $member_results['black_name']; ?></a></td>
        </tr>
    <?php
    }
    ?>
</table>