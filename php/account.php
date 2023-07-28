<?php
    session_start();
    if(!isset($_SESSION['logged_in'])) {
        header("Location: signin.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "header.php"; ?>
    <title>Canterbury Chess Club</title>
</head>
<body>
    <?php include "modules/navbar/navbar.php"; ?>
    <div id="main">

        <div class="row justify-content-center" style="width: 100%;">
            <div class="col-6">

                <div class="card" style="border-radius: 0px; padding-bottom: 20px; background-color: rgb(1, 22, 30);">
                    <div style="width: 80%;">
                        <h2 class="card-header">
                            <span class="material-symbols-outlined">account_circle</span>Username
                        </h2>
                        <div class="card-body1">
                            Full name <h6 style="float: right;">online</h6>
                        </div>
                    </div>
                    <hr>
                    <div style="width: 80%;">
                        <div class="card-body1" style="text-align: center !important;">
                            Used Forums:
                            
                            <div class="row">
                                <div class="col-sm">
                                    <a href="forums.php">Forum 1</a>
                                </div>

                                <div class="col-sm">
                                    <a href="forums.php">Forum 2</a>   
                                </div>

                                <div class="col-sm">
                                    <a href="forums.php">Forum 3</a>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

                    <div style="width: 80%;">
                        <div class="card-body1" style="text-align: center !important;">
                            Games and Studies
                            
                            <div class="row">
                                <div class="col-sm">
                                    <a href="study.php">Study 1</a>
                                </div>

                                <div class="col-sm">
                                    <a href="study.php">Study 2</a>  
                                </div>

                                <div class="col-sm">
                                    <a href="study.php">Study 3</a>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <?php include "modules/footer/footer.php"; ?>
</body>

</html>