<link rel="stylesheet" href="/php/modules/navbar/navbar.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg bg-body-nav">

    <div class="container-fluid">
        <a class="navbar-brand" href="/php/pages/home/index.php"><img src="/res/white_logo.svg" alt="Icon"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/php/pages/tournaments/tournaments.php"><b>Tournaments</b></a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                   
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>     

                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/php/calendar.php"><b>Calendar</b></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/php/pages/coaching/coaching.php"><b>Coaching</b></a>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <button class="btn text-white" type="submit"><span class="material-symbols-outlined align-middle">search</span><b>Search</b></button>  
            </form>

            <a href="https://www.facebook.com/CanterburyChessClub/"><button class="btn text-white" type="submit"><span class="material-symbols-outlined align-middle">account_circle</span><b>facebook</b></button></a>

            <a href="/php/pages/signin/signin.php"><button class="btn text-white" type="submit"><span class="material-symbols-outlined align-middle">account_circle</span><b>Profile</b></button></a>

        </div>
    </div>
</nav>
