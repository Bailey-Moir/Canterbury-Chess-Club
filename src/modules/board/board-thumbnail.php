<!-- Bailey -->
<link rel="stylesheet" href="<?php echo UPATH; ?>/src/modules/board/board.css">

<?php
$moves = preg_split('/\s+/', str_replace("\\r", "", $row['moves']));
?>

<div class="board-container board-container-thumbnail" style="width: 15rem; height: 15rem;" id="board-container-<?php echo $id; ?>">
    <div class="board-thumbnail white-view" id="board-<?php echo $id; ?>" >
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
</div>

<script>
    board = new Board(<?php echo $id; ?>);

    board.moves = [
        <?php echo '"'.preg_replace('/\s+/', '", "', str_replace("\\r", "", $row['moves'])).'"'; ?>
    ];

    board.setMove(2*<?php echo count($moves); ?>);
</script>