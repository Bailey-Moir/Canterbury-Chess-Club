<!-- Bailey -->
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

<div id="game-page" class="card">
    <div class="card-header">
        <!-- Note this is member name not username -->
        <h1><a class="dark-link" href="/chessclub/accounts/<?php echo urlencode($board_results['white_name']); ?>/games"><?php echo $board_results['white_name']?></a> v. <a class="dark-link" href="/chessclub/accounts/<?php echo urlencode($board_results['black_name']); ?>/games"><?php echo$board_results['black_name']; ?></a></h1>
        <h5 class="text-center"><a class="dark-link" href="/chessclub/tournaments/<?php echo urlencode($board_results['tournament_name']); ?>"><?php echo $board_results['tournament_name']; ?></a></h5>
    </div>
    <div class="card-body">
        <div class="game-board">
            <?php require PATH."/src/modules/board/board.php"; ?>
        </div>
    </div>
</div>