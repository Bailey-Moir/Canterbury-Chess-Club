<!-- Bailey -->
<?php 
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']['admin'] == FALSE) header("Location: /");
?>
<div class="card">
    <div class="card-header">
        <h1>Admin Panel</h1>
    </div>
    <div class="card-body">
        <div class="responsive mx-auto my-4">
            <h3>Add Game</h3>
            <form action="/src/admin/addgame.php" method="post">
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
                    <textarea class="form-control" style="height: 6rem;" id="floatingMoves" name="moves"><?php isset($_POST['moves']) ? $_POST['moves'] : ''; ?></textarea>
                    <label for="floatingMoves">Moves</label>
                </div>
                
                <div class="form-floating border-secondary w-100">
                    <input type="number" class="form-control" id="floatingTourn" name="tournament_id" >
                    <label for="floatingTourn">Tournament ID</label>
                </div>

                <?php
                if (isset($_GET['err'])) {
                    ?>
                    <p class="p w-100 text-danger text-center mb-3"><?php
                             if ($_GET['err'] == "gameInvalidTournament") echo "Invalid Tournament ID";
                        else if ($_GET['err'] == "gameNoneChecked")       echo "No game result selected";
                        else if ($_GET['err'] == "gameNoWhiteMember")     echo "Invalid White NZCF Code";
                        else if ($_GET['err'] == "gameNoBlackMember")     echo "Invalid Black NZCF Code";
                        else if ($_GET['err'] == "gameNoBlackMember")     echo "Insert Failed";
                    ?></p>
                    <?php
                }
                ?>

                <input class="btn btn-primary w-100" type="submit">
            </form>


            <h3 class="mt-4">Add Tournament</h3>

            <br/>
            
            <a href="/src/signout.php">Sign Out</a>

            <h3 class="text-danger mt-5">Danger Zone</h3>
            <a class="text-danger" href="/src/admin/reset.php">Reset Databse</a>
        </div>
    </div>
</div>
