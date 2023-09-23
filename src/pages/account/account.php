<!-- Gavith -->
<?php
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $decoded = urldecode($_GET['name']);
    $stmt->bind_param("s", $decoded);
    $stmt->execute();
    $user_results = $stmt->get_result()->fetch_assoc();
?>
<div class="card">
    <div class="card-header pb-4">
        <h2 class="pt-2"><?php echo $user_results['username'] ?></h2>
        <?php
        if ($_SESSION['logged_in'] && $_SESSION['logged_in']['name'] == $user_results['username']) {
            ?>
            <a href="/src/pages/account/signout.php"><button type="button" class="btn btn-primary">Sign Out</button></a>
            <?php
        }
        ?>
    </div>
    <div class="card-body">
        <div class="account-nav">
            <?php                 
            $pages = array("games", "tournaments");
            foreach ($pages as &$page) { 
                ?>
                <a href="/accounts/<?php echo $_GET['name']; ?>/<?php echo $page; ?>" class="nav-link_"><?php echo strtoupper($page); ?></a>
                <?php 
            }
            ?>
        </div>
        <div class="account-content">
            <?php
            if ($_GET["acc_page"] == "games") {
                // $stmt = $conn->prepare(
                //     "SELECT 
                //         games.game_id AS id,
                //         games.moves as moves,
                //         bm.name AS black_name,
                //         wm.name AS white_name 
                //     FROM games 
                //     JOIN members bm ON games.black_member_id = bm.member_id
                //     JOIN members wm ON games.white_member_id = wm.member_id
                //     WHERE games.black_member_id=? OR games.white_member_id=?"
                // );
                // $stmt->bind_param("ss", $user_results['member_id'], $user_results['member_id']);
                // $stmt->execute();
                // $game_results = $stmt->get_result()->fetch_assoc();
                // while ($row = $game_results->fetch_assoc()) {
                //     $id = $row['id'];
                //     ?\>
                //     <div class="card">
                //         <a href="/games/<?php echo $id; ?\>">
                //             <div class="card-body bg-body-title">
                //             <p class="card-text"><?php echo $row['black_name']." v. ".$row['white_name']; ?\></p>
                //             </div>
                //             <\?php
                //             require PATH."/src/modules/board/board-thumbnail.php";
                //             ?\>
                //         </a>
                //     </div>					
                //     <\?php
                // }
                echo "awaiting integration with club database (games)";
            } else if ($_GET["acc_page"] == "tournaments") {
                echo "awaiting integration with club database (tournaments)";
            } else echo "invalid page";
            ?>
        </div>
    </div>
</div>