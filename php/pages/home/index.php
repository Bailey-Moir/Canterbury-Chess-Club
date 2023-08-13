<?php

session_start();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../../header.php"; ?>
	
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "../../modules/navbar/navbar.php"; ?>
	<div id="main">
		
		<h2 style="padding-bottom: 20px;">Canterbury Chess Club</h2>

		<h3>Club Nights</h3>

			<div class="container-fluid content" style="text-align: left !important; width: 95%;">
				<p>Club tournaments are held for competitive members on Wednesday nights from 7pm onwards.</p>
				<p>Social Chess for members and non-members are held alike on Thursday nights from 6:15pm till 9pm (first night free, $2 per night afterwards).</p>
				<p style="padding-bottom: 20px;">Beginners are more than welcome.</p>
			</div>

			<div class="container-fluid content">
				<h3>Recent Games</h3>
				<div class="row justify-content-around" style="padding-bottom: 30px;">
					
					<div class="col-1 ">
						<div class="card" >
							<a href="/php/game.php">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>
					<div class="col-1 ">
						<div class="card" >
							<a href="/php/game.php">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>

					<div class="col-1 ">
						<div class="card" >
							<a href="/php/game.php">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>

				</div>
			</div>

			<div class="row justify-content-around">
					
					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>
					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>

					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Game Title</p>
								</div>
								<img src="/res/recent_game.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard with any moves yet to be played">
							</a>
						</div>
					</div>

				</div>
		
	</div>
	<?php include "../../modules/footer/footer.php"; ?>
</body>
</html>