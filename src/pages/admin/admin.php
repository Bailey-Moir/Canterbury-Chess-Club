<!-- Bailey -->
<?php 
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) header("Location: /chessclub/");
?>
<div class="card">
    <div class="card-header">
        <h1>Admin Panel</h1>
    </div>
    <div class="card-body">
        <div class="responsive mx-auto my-4">
            <h3>Add Game</h3>
            <form action="/chessclub/src/admin/addgame.php" method="post">
                <div class="d-flex w-100 justify-content-between">
                    <div class="form-floating border-secondary" style="width:45%; padding-bottom:0px;">
                        <input type="text" class="form-control" id="floatingWhite" name="white_nzcf" >
                        <label for="floatingWhite">White player NZCF code</label>
                    </div>
                    <div class="form-floating border-secondary" style="width:45%; padding-bottom:0px;">
                        <input type="text" class="form-control" id="floatingBlack" name="black_nzcf" >
                        <label for="floatingBlack">Black player NZCF code</label>
                    </div>
                </div>
                <div class="d-flex w-100 justify-content-around">
                    <div class="form-check pb-2">
                        <label class="form-check-label" for="whiteCheck">
                            White won
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="whiteCheck">
                    </div>
                    <div class="form-check pb-2">
                        <label class="form-check-label" for="drawCheck">
                            Draw
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="drawCheck">
                    </div>
                    <div class="form-check pb-2">
                        <label class="form-check-label" for="blackCheck">
                            Black won
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="blackCheck">
                    </div>
                </div>

                <div class="form-floating border-secondary w-100">
                    <textarea class="form-control" style="height: 6rem;" id="floatingMoves" name="moves"></textarea>
                    <label for="floatingMoves">Moves</label>
                </div>
                
                <div class="form-floating border-secondary w-100">
                    <input type="number" class="form-control" id="floatingTourn" name="tournament_id" >
                    <label for="floatingTourn">Tournament ID</label>
                </div>

                <?php
                if (isset($_GET['err']) && $_GET['err'][0] == "g") {
                    ?>
                    <p class="p w-100 text-danger text-center mb-3"><?php
                             if ($_GET['err'] == "gInvalidTournament") echo "Invalid Tournament ID";
                        else if ($_GET['err'] == "gNoneChecked")       echo "No game result selected";
                        else if ($_GET['err'] == "gNoWhiteMember")     echo "Invalid White NZCF Code";
                        else if ($_GET['err'] == "gNoBlackMember")     echo "Invalid Black NZCF Code";
                        else if ($_GET['err'] == "gfail")              echo "Insert Failed";
                    ?></p>
                    <?php
                }
                ?>

                <input class="btn btn-primary w-100" type="submit">
            </form>


            <h3 class="mt-4">Add Tournament</h3>
            <form action="/chessclub/src/admin/addtournament.php" method="post">
                <div class="d-flex w-100 justify-content-between">
                    <div class="form-floating border-secondary" style="width: 45%;">
                        <input class="form-control" type="date" name="date_start" id="floatingDateStart">
                        <label for="floatingDateStart">Date Start</label>
                    </div>
                    <div class="form-floating border-secondary" style="width: 45%;">
                        <input class="form-control" type="date" name="date_end" id="floatingDateEnd">
                        <label for="floatingDateEnd">Date End</label>
                    </div>
                </div>
                <div class="form-floating border-secondary w-100">
                    <input type="text" class="form-control" id="floatingTournamentName" name="name" >
                    <label for="floatingTournamentName">Tournament Name</label>
                </div>
                
                <div class="form-floating border-secondary w-100">
                    <input type="number" class="form-control" id="floatingRounds" name="rounds" >
                    <label for="floatingRounds">Number of Rounds</label>
                </div>

                <?php
                if (isset($_GET['err']) && $_GET['err'][0] == "t") {
                    ?>
                    <p class="p w-100 text-danger text-center mb-3"><?php
                             if ($_GET['err'] == "temptyDateStart") echo "No start date provided";
                        else if ($_GET['err'] == "temptyDateEnd")   echo "No end date provided";
                        else if ($_GET['err'] == "temptyName")      echo "No tournament name given";
                        else if ($_GET['err'] == "temptyRound")     echo "Number of rounds not set";
                        else if ($_GET['err'] == "tinvalidRound")   echo "Invalid number of rounds (0-9)";
                        else if ($_GET['err'] == "tfail")           echo "Insert Failed";
                    ?></p>
                    <?php
                }
                ?>

                <input class="btn btn-primary w-100" type="submit">
            </form>

            <br/>

            <a href="/chessclub/src/admin/backup.php">Backup</a> <br/>
            <?php
            if (isset($_GET['err']) && $_GET['err'][0] == "b") {
                ?>
                <p class="p w-100 text-danger mb-3"><?php
                    if ($_GET['err'] == "bfail") echo "Backup failed";
                ?></p>
                <?php
            }
            ?>
            <a href="/chessclub/src/signout.php">Sign Out</a>

            <h3 class="text-danger mt-3">Danger Zone</h3>
            <form class="pb-3" action="/chessclub/src/admin/reset_to.php" method="post" enctype="multipart/form-data">
                <label class="text-danger" style="text-decoration: underline; cursor:pointer;" for="files">Reset to Backup</label>
                <input id="files" style="visibility:hidden; height:5px; width:5px;" type="file" name="backup">
            </form>
            <a class="text-danger" href="/chessclub/src/admin/reset.php">Reset Databse</a>
        </div>
    </div>
</div>
