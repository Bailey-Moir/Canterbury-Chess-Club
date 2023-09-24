<!-- Gavith -->
<link rel="stylesheet" href="<?php echo UPATH; ?>/src/modules/navbar/navbar.css">

<div class="mnav">
        <a class="mnav-icon-cntr" href="/chessclub/"><img src="<?php echo UPATH; ?>/res/white_logo.svg" alt="Icon"/></a>

        <a class="mnav-btn" aria-current="page" href="/chessclub/tournaments"><b>Tournaments</b></a>
        <a class="mnav-btn" aria-current="page" href="/chessclub/calendar"><b>Calendar</b></a>
        <a class="mnav-btn" aria-current="page" href="/chessclub/coaching"><b>Coaching</b></a>
        <a class="mnav-btn" aria-current="page" href="/chessclub/about"><b>About</b></a>


        <div class="right">
            <a class="mnav-btn" href="https://www.facebook.com/CanterburyChessClub/"><img src="<?php echo UPATH; ?>/res/facebook.svg"/><b>Facebook</b></a>
            <a class="mnav-btn" href="/chessclub/signin"><img src="<?php echo UPATH; ?>/res/<?php echo isset($_SESSION['logged_in']) ? "account_circle" : "login"; ?>.svg"/><b><?php echo isset($_SESSION['logged_in']) ? "Profile" : "Signin"; ?></b></a>
        </div>
</div>
