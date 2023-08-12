<link rel="stylesheet" href="/php/modules/board/board.css">
<script src="/php/modules/board/board.js"></script>

<div class="board-container">
    <div class="board white-view">
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
            $moves = array(
                "e4",
                "e5",
                "Nf3",
                "...f6?",
                "Nxe5",
                "...fxe5?",
                "Qh5+",
                "...Ke7",
                "Qxe5+",
                "...Kf7",
                "Bc4+",
                ".... d5!",
                "Bxd5+",
                "... Kg6",
                "h4",
                "... h5",
                " Bxb7!!",
                "... Bxb7?",
                "Qf5+",
                "... Kh6",
                "d4+",
                "... g5",
                "Qf7!",
                "... Qe7",
                "hxg5+",
                "... Qxg5",
                "Rxh5#"
            );

            for ($i = 0; $i < count($moves); $i++) {
                echo "<div class=\"move move-$i\"> <p class=\"".($i%2 ? "black" : "white")."\"> $moves[$i] </p> </div>";
            }
            ?>
        </div>
        <div class="directions">
            <button class="last-move"><</button>
            <button class="next-move">></button>
        </div>
    </div>
</div>