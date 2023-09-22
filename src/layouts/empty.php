<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
    session_start();
    require PATH."/src/dbconnect.php";
    require PATH."/src/header.php";
    $page->render_tags();
    ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
    <div id="main">
        <div class="row justify-content-center" style="width: 100%; margin-top: 10%;">
            <p><a class="navbar-brand" href="/"><img src="/res/black_logo.svg" alt="Icon"/></a></p>
            <div class="col-6">

                <div class="card" style="border-radius: 0px;"> 

                    <?php require PATH.$page->pg.'.php'; ?>
                    
                </div>

            </div>
        </div>
	</div>
</body>
</html>