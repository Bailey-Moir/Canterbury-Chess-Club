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
            <div class="col-8">
                
                <div class="card"> 
                    <?php include "modules/board/board.php"; ?>
                </div>

            </div>
        </div>
        
	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>