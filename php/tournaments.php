<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "modules/navbar/navbar.php"; ?>
	<div id="main">
		
		<h2>Canterbury Chess Club</h2>
		<!--
			<p style="width: 80%;">
				Club tournaments are played on Wednesday nights. The doors open from 7pm, pairings/draw is done at 7:15pm and games start at 7:30pm.
				Players must be at the clubrooms or message the club's Facebook page by 7:15pm to be included in the draw.
				Players may request half-point byes in rapid and standard tournaments by messaging the club's Facebook page by 7:15pm (or when entering for a first round bye) - maximum 2 per tournament, not available in a tournament's last 2 rounds.
				Players must be financial full, life, junior or trial members to play on Wednesday nights.
			</p>
		-->
			<div class="container-fluid content">
				<h3>Upcoming</h3>
	
				<div class="row justify-content-around">
					
					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 1</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>

					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 2</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>

					<div class="col-1 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 3</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>
				</div>

				<h3 style="margin-top: 10px;">Recent</h3>
				<div class="row justify-content-around">
					
					<div class="col-2 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 4</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>

					<div class="col-2 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 5</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>

					<div class="col-2 ">
						<div class="card" >
							<a href="#">
								<div class="card-body bg-body-title">
								<p class="card-text">Tourney 6</p>
								</div>
								<img src="/res/tourney.JPG" class="card-img-top" style="width: 15rem;" alt="Chessboard">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="row justify-content-around"> 
				<h1 style="margin-top: 20px">Club Tournament Information</h1>

				<p style="padding-left: 20px; padding-right: 20px;">
					Club tournaments are played on Wednesday nights. The doors open from 7pm, pairings/draw is done at 7:15pm and games start at 7:30pm.

					Players must be at the clubrooms or message the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook page</a> by 7:15pm to be included in the draw.

					Players may request half-point byes in rapid and standard tournaments by messaging the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook page</a> by 7:15pm (or when entering for a first round bye) - maximum 2 per tournament, not available in a tournament's last 2 rounds.

					Players must be financial full, life, junior or trial members to play on Wednesday nights.
				</p> 
				<br>
				<h3>Laws of Chess</h3>

				<p style="padding-left: 20px; padding-right: 20px;">
					Wednesday night tournaments follow the <a href="https://handbook.fide.com/chapter/E012023">FIDE laws of Chess</a> (FIDE is the World Chess Federation) except that cellphones are only required to be on silent rather than turned off (but still can't be used while playing a tournament game except with permission and under supervision from the arbiter in urgent cases). 
					The default time is 30 minutes where applicable. Standard and rapid tournaments are 'touch-move' (The Laws of Chess cover this in Article 4) while lightnings and Grim Reapers are 'clock move' (players can change moves until they push the clock). 
					For standard tournaments, players must write the moves down (we provide scoresheets and pens)  - the Laws of Chess have an explanation in Appendix C or this is a <a href="https://www.chessable.com/blog/chess-notation-for-beginners/" style="none;">good guide from Chessable.</a>
				</p> 
				
				<h3>Time Controls</h3>

				<p style="padding-left: 20px; padding-right: 20px;">
					We use chess clocks for all our Wednesday night tournaments
					<li>
						Standard (long play): 1 hour 15 minutes + 30 seconds increment from move 1.
					</li>
						
					<li>
						Rapid: 25 minutes + 10 seconds increment from move 1.
					</li>
						
					<li>
						Lightning: 5 minutes.
					</li>

					<li>
						Blitz: 3 minutes + 2 seconds increment from move 1.
					</li>
				</p> 

				<h3>NZCF Ratings</h3>

				<p>
					All long play and some rapid events are rated by NZCF (New Zealand Chess Federation) - note that NZCF rules require players who play in more than 1 rated event per year to be members of a club.
					
					Long play and rapid tournaments are run as six round Swiss tournaments except for our Club Championships. Please note that the Arie Nijman Trophy is for the Club Rapid Championship.
				</p>

			</div>



		
	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>