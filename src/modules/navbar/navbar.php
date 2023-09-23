<!-- Gavith -->
<link rel="stylesheet" href="/src/modules/navbar/navbar.css">

<div class="mnav">
        <a class="mnav-icon-cntr" href="/"><img src="/res/white_logo.svg" alt="Icon"/></a>

        <a class="mnav-btn" aria-current="page" href="/tournaments"><b>Tournaments</b></a>
        <a class="mnav-btn" aria-current="page" href="/calendar"><b>Calendar</b></a>
        <a class="mnav-btn" aria-current="page" href="/coaching"><b>Coaching</b></a>
        <a class="mnav-btn" aria-current="page" href="/about"><b>About</b></a>


        <div class="right">
            <a class="mnav-btn" href="https://www.facebook.com/CanterburyChessClub/"><img src="/res/facebook.svg"/><b>Facebook</b></a>
            <a class="mnav-btn" href="/signin"><img src="/res/<?php echo isset($_SESSION['logged_in']) ? "account_circle" : "login"; ?>.svg"/><b><?php echo isset($_SESSION['logged_in']) ? "Profile" : "Signin"; ?></b></a>
        </div>
</div>
