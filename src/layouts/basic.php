<!-- Gavith -->
<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
    session_start();
    require PATH."/src/secure/dbconnect.php";
    require PATH."/src/header.php";
    $page->render_tags();
    ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php require PATH."/src/modules/navbar/navbar.php"; ?>
    <div id="main">
        <div id="main-strip">
            <?php require PATH.$page->pg.'.php'; ?>
        </div>
	</div>
	<?php require PATH."/src/modules/footer/footer.php"; ?>
</body>
</html>