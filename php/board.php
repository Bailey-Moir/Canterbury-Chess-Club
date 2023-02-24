<div class="board black-view">
    <?php    
    $piece_order = ['R', 'N', 'B', 'Q', 'K', 'B', 'N', 'R'];
    $alphabet = range('a', 'z');
    
    for ($i = 0; $i < 8; $i++) {
        ?>
        <div class="rank rank-<?php echo 8 - $i; ?>">
        <?php

        for ($j = 0; $j < 8; $j++) {
            ?>
            <div class="square <?php echo $alphabet[$j].(8 - $i); ?>"> 
            <?php
            
            $piece = "";
            if ($i == 0 || $i == 7) $piece = $piece_order[$j];
            if ($i == 1 || $i == 6) $piece = "P";
            
            if ($piece != "") {
                $color = $i < 4 ? "black" : "white";

                ?>
                <div class="piece <?php echo $color." ".$piece; ?>"></div>
                <?php
            }
            
            ?>
            </div>
            <?php
        }

        ?>
        </div>
        <?php
    }
    ?>
</div>