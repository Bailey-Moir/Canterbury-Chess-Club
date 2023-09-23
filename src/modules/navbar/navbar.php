<!-- Gavith -->
<link rel="stylesheet" href="/src/modules/navbar/navbar.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<div class="mnav">
        <a class="mnav-icon-cntr" href="/"><img src="/res/white_logo.svg" alt="Icon"></a>

        <a class="mnav-btn" aria-current="page" href="/tournaments"><b>Tournaments</b></a>
        <a class="mnav-btn" aria-current="page" href="/calendar"><b>Calendar</b></a>
        <a class="mnav-btn" aria-current="page" href="/coaching"><b>Coaching</b></a>


        <div class="right">
            <a class="mnav-btn" href="https://www.facebook.com/CanterburyChessClub/"><span class="material-symbols-outlined">account_circle</span><b>Facebook</b></a>
            <a class="mnav-btn" href="/signin"><span class="material-symbols-outlined">account_circle</span><b><?php if (isset($_SESSION['logged_in'])) echo "Profile"; else echo "Signin"; ?></b></a>
        </div>
</div>
