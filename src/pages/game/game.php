<?php
$stmt = $conn->prepare(
    "SELECT
        games.game_id AS id,
        games.moves as moves,
        tournaments.name as tournament_name,
        bm.name AS black_name,
        wm.name AS white_name
    FROM games
    JOIN members bm ON games.black_member_id = bm.member_id
    JOIN members wm ON games.white_member_id = wm.member_id
    JOIN tournaments ON games.tournament_id = tournaments.tournament_id
    WHERE games.game_id = ?;"
);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$board_results = $stmt->get_result()->fetch_assoc();
?>

<div class="row justify-content-center" style="width: 100%;">
    <div class="col-8">
        <div class="card">
            <h1><?php echo $board_results['black_name']." v. ".$board_results['white_name']; ?></h1>
            <h5><a href="/tournaments/<?php echo urlencode($board_results['tournament_name']); ?>"><?php echo $board_results['tournament_name']; ?></a></h5>
            <?php require PATH."/src/modules/board/board.php"; ?>
        </div>
    </div>
</div>