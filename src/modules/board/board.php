<link rel="stylesheet" href="/src/modules/board/board.css">
<?php

$stmt = $dbconnect->prepare("SELECT * FROM games WHERE game_id = ?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$results = $stmt->get_result()->fetch_assoc();

$moves = preg_split("/(\r|\n| )+/", $results['moves']);
?>

<div class="board-container" id="board-container-<?php echo $results['game_id']; ?>">
    <div class="board white-view" id="board-<?php echo $results['game_id']; ?>">
        <?php    
        $piece_order = ['R', 'N', 'B', 'Q', 'K', 'B', 'N', 'R'];
        $alphabet = range('a', 'z');
        
        for ($i = 8; $i > 0; $i--) {
            echo "<div class=\"rank rank-$i\">";
            for ($j = 0; $j < 8; $j++) {
                echo "<div class=\"square ".(($j+$i) % 2 ? "black" : "white")." file-$alphabet[$j] rank-$i S$alphabet[$j]$i\">";
                
                $piece = null;
                    if ($i == 1 || $i == 8) $piece = $piece_order[$j];
                else if ($i == 2 || $i == 7) $piece = "P";
                
                if ($piece) echo "<div class=\"piece ".( $i > 4 ? "black" : "white" )." $piece\"></div>";

                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    </div>
    <div class="right">
        <div class="moves">
            <?php
            for ($i = 0; $i < count($moves); $i++) {
                echo "<div class=\"move move-$i\"> <p class=\"".($i%2 ? "black" : "white")."\"> $moves[$i] </p> </div>";
            }
            ?>
        </div>
        <div class="directions">
            <button class="last-move" id="last-move-<?php echo $results['game_id']; ?>"><</button>
            <button class="next-move" id="next-move-<?php echo $results['game_id']; ?>">></button>
        </div>
    </div>
</div>

<script>
    let board = new Board(<?php echo $results['game_id']; ?>);

    board.moves = [
        <?php echo "\"".implode('", "', $moves)."\""; ?>
    ];
</script>