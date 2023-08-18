<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
    session_start();
    include PATH."/src/dbconnect.php";
    include PATH."/src/header.php";
    $page->render_tags();
    ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include PATH."/src/modules/navbar/navbar.php"; ?>
    <div id="main">
        
        <?php require PATH.$page->pg.'.php'; ?>
        
	</div>
	<?php include PATH."/src/modules/footer/footer.php"; ?>
</body>
</html>