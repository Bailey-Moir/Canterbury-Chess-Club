<!-- Bailey -->
<?php
define("UPATH", "/chessclub");
define("PATH", $_SERVER['DOCUMENT_ROOT'].UPATH);

$uri = $_GET['page'] ?? "";

class Page {
    public $uri = '';
    public $pg = '';
    public $lyt = '';
    public $tags = [];

    function __construct($uri, $pg, $custom_js=NULL, $custom_css=NULL, $lyt="/src/layouts/basic.php") {
        $this->uri = $uri;
        $this->pg = $pg;
        $this->lyt = $lyt;
        if (file_exists(PATH.$pg.".css")) $this->add_css($pg.".css");
        if (file_exists(PATH.$pg.".js")) $this->add_js($pg.".js");
        if ($custom_css != NULL) foreach ($custom_css as $css) $this->add_css($css);
        if ($custom_js != NULL) foreach ($custom_js as $js) $this->add_js($js);
    }

    function add_css($url) {
        $this->tags[] = '<link rel="stylesheet" href="'.UPATH.$url.'">';
    }
    function add_js($url) {
        $this->tags[] = '<script src="'.UPATH.$url.'"></script>';
    }

    function render_tags() {
        foreach ($this->tags as $tag) echo $tag;
    }
}

$pages = [
    new Page(
        "", // uri 
        "/src/pages/home/home", // pg
        ["/src/modules/board/board-thumbnail.js"] // custom_js
    ),
    new Page(
        "game",
        "/src/pages/game/game",
        ["/src/modules/board/board.js"]
    ),
    new Page(
        "tournaments",
        "/src/pages/tournaments/tournaments"
    ),
    new Page(
        "tournament",
        "/src/pages/tournament/tournament"
    ),
    new Page(
        "calendar",
        "/src/pages/calendar/calendar"
    ),
    new Page(
        "coaching",
        "/src/pages/coaching/coaching"
    ),
    new Page(
        "signin",
        "/src/pages/signin/signin",
        NULL,
        NULL,
        "/src/layouts/empty.php"
    ),
    new Page(
        "signup",
        "/src/pages/signup/signup",
        NULL,
        NULL,
        "/src/layouts/empty.php"
    ),
    new Page(
        "signin/forgotpassword",
        "/src/pages/forgotpassword/forgotpassword",
        NULL,
        NULL,
        "/src/layouts/empty.php"
    ),
    // new Page(
    //     "clubplayers",
    //     "/src/pages/clubplayers/clubplayers"
    // ),
    // new Page(
    //     "forums",
    //     "/src/pages/forums/forums"
    // ),
    // new Page(
    //     "player",
    //     "/src/pages/player/player"
    // ),
    // new Page(
    //     "players",
    //     "/src/pages/players/players"
    // ),
    // new Page(
    //     "study",
    //     "/src/pages/study/study"
    // ),
    new Page(
        "account",
        "/src/pages/account/account",
        ["/src/modules/board/board-thumbnail.js"]
    ),
    new Page(
        "about",
        "/src/pages/about/about"
    ),
    new Page(
        "admin",
        "/src/pages/admin/admin"
    )
];

$found = false;
foreach($pages as $page) {
    if ($page->uri == $uri) {
        $found = true;
        
        require PATH.$page->lyt;
        
        return;
    }
}

$page404 = new Page(
    "NA",
    "/src/pages/404/404"
);

if (!$found) {
    $page = $page404;

    require PATH.$page->lyt;
    
    return;   
}

?>