<!-- Bailey, but debateable, see https://github.com/Bailey-Moir/Canterbury-Chess-Club/commits/main/src/pages/home/home.php -->
<h1 class="pb-1">Canterbury Chess Club</h1>

<div class="container-fluid content">
    <h3>Club Nights</h3>
    <p class="p pb-2">
        Club tournaments are held for competitive members on Wednesday nights from 7pm onwards. 
        Social Chess for members and non-members alike are held on Thursday nights from 6:15pm 
        till 9pm (first night free, $2 per night afterwards). Beginners are more than welcome.
    </p>

    <h3 class="text-center">Recent Games</h3>
    
    <div class="games justify-content-around d-flex flex-wrap">
        <?php
        $results = $conn->query(
            "SELECT
                games.game_id AS id,
                games.moves as moves,
                bm.name AS black_name,
                wm.name AS white_name
            FROM games
            JOIN members bm ON games.black_member_id = bm.member_id
            JOIN members wm ON games.white_member_id = wm.member_id
            LIMIT 6"
        );

        while ($row = $results->fetch_assoc()) {
            $id = $row['id'];
            ?>
            <div class="card">
                <a href="/games/<?php echo $id; ?>">
                    <div class="card-header">
                        <p class="card-text"><?php echo $row['black_name']." v. ".$row['white_name']; ?></p>
                    </div>
                    <div class="card-body">
                        <?php
                        require PATH."/src/modules/board/board-thumbnail.php";
                        ?>
                    </div>
                </a>
            </div>					
            <?php
        }
        ?>
    </div>
</div>