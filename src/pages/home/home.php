<link rel="stylesheet" href="/src/pages/home/home.css">

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
        $ids = $dbconnect->query("SELECT game_id FROM games");

        while ($row = $ids->fetch_assoc()) {
            $id = $row['game_id'];
            ?>
            <div class="card">
                <a href="/game?id=<?php echo $id; ?>">
                    <div class="card-body bg-body-title">
                    <p class="card-text">Game Title</p>
                    </div>
                    <?php
                    include PATH."/src/modules/board/board-thumbnail.php";
                    ?>
                </a>
            </div>					
            <?php
        }
        ?>
    </div>
</div>