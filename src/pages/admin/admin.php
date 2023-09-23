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
                <div class="d-flex flex-wrap w-100 justify-content-between">
                    <div class="form-floating border-secondary" style="width:45%; padding-bottom:0px;">
                        <input type="text" class="form-control" id="floatingBlack" name="black_nzcf" >
                        <label for="floatingBlack">Black player NZCF code</label>
                    </div>
                    <div class="form-floating border-secondary" style="width:45%; padding-bottom:0px;">
                        <input type="text" class="form-control" id="floatingWhite" name="white_nzcf" >
                        <label for="floatingWhite">White player NZCF code</label>
                    </div>
                    
                    <div class="form-check pb-2" style="width:45%;">
                        <label class="form-check-label" for="blackCheck">
                            Black won
                        </label>
                        <input class="form-check-input" type="checkbox" value="" name="blackCheck">
                    </div>
                    <div class="form-check pb-2" style="width:45%;">
                        <label class="form-check-label" for="blackCheck">
                            White won
                        </label>
                        <input class="form-check-input" type="checkbox" value="" name="whiteCheck">
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
