<?php
    if(!isset($_SESSION['logged_in'])) {
        header("Location: /signin");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $decoded = urldecode($_GET['name']);
    $stmt->bind_param("s", $decoded);
    $stmt->execute();
    $user_results = $stmt->get_result()->fetch_assoc();
?>
<div class="card">
    <div class="card-header">
        <h2 class="m-t-10 m-b-5"><?php echo $user_results['username'] ?></h2>
        <?php
        if ($_SESSION['logged_in']['name'] == $user_results['username']) {
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
                echo "awaiting integration with club database (games";
            } else if ($_GET["acc_page"] == "forums") {
                echo "awaiting integration with club database (tournaments)";
            } else echo "invalid page";
            ?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
            <!-- begin profile -->
            <div class="profile">
                <div class="profile-header">
                    <!-- BEGIN profile-header-cover --> 
                    <div class="profile-header-cover"></div>
                    <!-- END profile-header-cover -->
                    <!-- BEGIN profile-header-content -->
                    <div class="profile-header-content">
                        <!-- BEGIN profile-header-img -->
                        <div class="profile-header-img">
                            <img src="/res/avatar.png" alt="standard avatar icon"/>
                        </div>
                        <!-- END profile-header-img -->
                        <!-- BEGIN profile-header-info -->
                        <div class="profile-header-info">
                            <br/>
                            <h2 class="m-t-10 m-b-5"><?php echo $user_results['username'] ?></h2>
                            <button type="button" class="btn btn-primary"><a href="/src/pages/account/signout.php">Sign Out</a></button>
                            <!-- <p class="m-b-10">Full Name</p> -->
                            <!-- <a href="#" class="btn btn-sm btn-info mb-2">Edit Profile</a> -->
                        </div>
                        <!-- END profile-header-info -->
                    </div>
                    <br/>
                    <!-- END profile-header-content -->
                    <!-- BEGIN profile-header-tab -->
                    <ul class="profile-header-tab nav nav-tabs">
                        <?php                 
                        $pages = array("games", "tournaments");
                        foreach ($pages as &$page) { 
                            ?>
                            <li class="nav-item"><a href="/accounts/<?php echo $_GET['name']; ?>/<?php echo $page; ?>" class="nav-link_"><?php echo strtoupper($page); ?></a></li>
                            <?php 
                        }
                        ?>
                    
                    </ul>
                    <!-- END profile-header-tab -->
                </div>

            </div>
            <!-- end profile -->

            <!-- being profile content -->
            <div class="profile-content">
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
                    echo "awaiting integration with club database";
                } else if ($_GET["acc_page"] == "forums") {
                    //
                }
                ?>
            </div>
            <!-- end profile-content -->
        </div>
    </div>
</div>