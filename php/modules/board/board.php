<link rel="stylesheet" href="/php/modules/board/board.css">
<script src="/php/modules/board/board.js"></script>
<div class="board white-view">
    <?php    
    $piece_order = ['R', 'N', 'B', 'Q', 'K', 'B', 'N', 'R'];
    $alphabet = range('a', 'z');
    
    for ($i = 8; $i > 0; $i--) {
        echo "<div class=\"rank rank-$i\">";
        for ($j = 0; $j < 8; $j++) {
            echo "<div class=\"square ".(($j+$i) % 2 ? "black" : "white")." $alphabet[$j]$i\">";
            
            $piece = null;
                if ($i == 1 || $i == 8) $piece = $piece_order[$j];
            elseif ($i == 2 || $i == 7) $piece = "P";
            
            if ($piece) echo "<div class=\"piece ".( $i > 4 ? "black" : "white" )." $piece\"></div>";

            echo "</div>";
        }
        echo "</div>";
    }
    ?>
</div>