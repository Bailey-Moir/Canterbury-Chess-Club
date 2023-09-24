<!-- Gavith -->
<h1>Tournaments</h1>

<p class="p">
    Club tournaments are played on Wednesday nights. The doors open from 7pm, pairings/draw is done at 7:15pm and games start at 7:30pm.
    <b>Players must be at the clubrooms or message the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook</a> page by 7:15pm to be included in the draw.</b>
    Players may request half-point byes in rapid and standard tournaments by messaging the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook</a> page by 7:15pm (or when entering for a first round bye) - maximum 2 per tournament, not available in a tournament's last 2 rounds.
    Players must be financial full, life, junior or trial members to play on Wednesday nights.
</p>

<div class="container-fluid content">
    <h3 class="text-center">Upcoming</h3>

    <div class="upcoming-tournaments justify-content-around d-flex flex-wrap">
        <!-- Bailey -->
        <?php
        $results = $conn->query("SELECT name FROM tournaments ORDER BY date_start LIMIT 6");

        while ($row = $results->fetch_assoc()) {
            ?>
            <a class="mx-3" href="/tournaments/<?php echo urlencode($row['name']); ?>">
                <div class="card">
                    <div class="card-header">
                        <p class="card-text"><?php echo $row['name'] ?></p>
                    </div>
                    <div class="card-body">
                        <img src="/res/tourney.JPG" class="card-img-top" alt="Chessboard"/>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
</div>

<h3 class="mt-4">Club Tournament Information</h3>
<p class="p">
    Club tournaments are played on Wednesday nights. The doors open from 7pm, pairings/draw is done at 7:15pm and games start at 7:30pm.

    Players must be at the clubrooms or message the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook</a> page by 7:15pm to be included in the draw.

    Players may request half-point byes in rapid and standard tournaments by messaging the club's <a href="https://www.facebook.com/CanterburyChessClub/">Facebook</a> page by 7:15pm (or when entering for a first round bye) - maximum 2 per tournament, not available in a tournament's last 2 rounds.

    Players must be financial full, life, junior or trial members to play on Wednesday nights.
</p>

<h3 class="mt-4">Laws of Chess</h3>
<p class="p">
    Wednesday night tournaments follow the <a href="https://handbook.fide.com/chapter/E012023">FIDE laws of Chess</a> (FIDE is the World Chess Federation) except that cellphones are only required to be on silent rather than turned off (but still can't be used while playing a tournament game except with permission and under supervision from the arbiter in urgent cases). 
    The default time is 30 minutes where applicable. Standard and rapid tournaments are 'touch-move' (The Laws of Chess cover this in Article 4) while lightnings and Grim Reapers are 'clock move' (players can change moves until they push the clock). 
    For standard tournaments, players must write the moves down (we provide scoresheets and pens)  - the Laws of Chess have an explanation in Appendix C or this is a <a href="https://www.chessable.com/blog/chess-notation-for-beginners/" style="none;">good guide from Chessable.</a>
</p> 

<h3 class="mt-4">Time Controls</h3>

<p class="p">
    We use chess clocks for all our Wednesday night tournaments
</p>
<ul class="list">
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
</ul>

<h3>NZCF Ratings</h3>

<p class="p">
    All long play and some rapid events are rated by NZCF (New Zealand Chess Federation) - note that NZCF rules require players who play in more than 1 rated event per year to be members of a club.
    
    Long play and rapid tournaments are run as six round Swiss tournaments except for our Club Championships. Please note that the Arie Nijman Trophy is for the Club Rapid Championship.
</p>
