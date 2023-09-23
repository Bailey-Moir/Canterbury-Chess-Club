<!-- Gavith -->
<h2 style="padding-bottom: 20px;">Canterbury Chess Club</h2>

<div class="container-fluid content">
    <h3>Club Nights</h3>
    <p>Club tournaments are held for competitive members on Wednesday nights from 7pm onwards.</p>
    <p>Social Chess for members and non-members are held alike on Thursday nights from 6:15pm till 9pm (first night free, $2 per night afterwards).</p>
    <p style="padding-bottom: 20px;">Beginners are more than welcome.</p>
</div>

<div class="container-fluid content">
    <h3>Recent Games</h3>
    
    <div class="games" style="padding-bottom: 30px;">
        <?php
        $results = $conn->query(
            "SELECT
                games.game_id AS id,
                games.moves as moves,
                bm.name AS black_name,
                wm.name AS white_name
            FROM games
            JOIN members bm ON games.black_member_id = bm.member_id
            JOIN members wm ON games.white_member_id = wm.member_id"
        );

        while ($row = $results->fetch_assoc()) {
            $id = $row['id'];
            ?>
            <div class="card">
                <a href="/games/<?php echo $id; ?>">
                    <div class="card-body bg-body-title">
                    <p class="card-text"><?php echo $row['black_name']." v. ".$row['white_name']; ?></p>
                    </div>
                    <?php
                    require PATH."/src/modules/board/board-thumbnail.php";
                    ?>
                </a>
            </div>					
            <?php
        }
        ?>
    </div>
</div>