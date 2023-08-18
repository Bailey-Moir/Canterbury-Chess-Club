<?php

define("PATH", $_SERVER['DOCUMENT_ROOT']);

$uri = urldecode( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) );

class Page {
    public $uri = '';
    public $pg = '';
    public $lyt = '';
    public $tags = [];

    function __construct($uri, $pg, $lyt="/src/layouts/basic.php", $custom_js=NULL, $custom_css=NULL) {
        $this->uri = $uri;
        $this->pg = $pg;
        $this->lyt = $lyt;
        if ($custom_css != NULL) foreach ($custom_css as $css) $this->add_css($css);
        if ($custom_js != NULL) foreach ($custom_js as $js) $this->add_js($js);
    }

    function add_css($url) {
        $this->tags[] = '<link rel="stylesheet" href="'.$url.'">';
    }
    function add_js($url) {
        $this->tags[] = '<script src="'.$url.'"></script>';
    }

    function render_tags() {
        foreach ($this->tags as $tag) echo $tag;
    }
}

$pages = [
    new Page(
        uri: "/",
        pg: "/src/pages/home/home",
        custom_js: ["/src/modules/board/board-thumbnail.js"]
    ),
    new Page(
        uri: "/game",
        pg: "/src/pages/game/game"
    ),
    new Page(
        uri: "/tournaments",
        pg: "/src/pages/tournaments/tournaments"
    ),
    new Page(
        uri: "/tournament",
        pg: "/src/pages/tournament/tournament"
    ),
    new Page(
        uri: "/calendar",
        pg: "/src/pages/calendar/calendar"
    ),
    new Page(
        uri: "/coaching",
        pg: "/src/pages/coaching/coaching"
    ),
    new Page(
        uri: "/signin",
        pg: "/src/pages/signin/signin",
        lyt: "/src/layouts/empty.php"
    ),
    new Page(
        uri: "/signup",
        pg: "/src/pages/signup/signup",
        lyt: "/src/layouts/empty.php"
    ),
    new Page(
        uri: "/signin/forgotpassword",
        pg: "/src/pages/forgotpassword/forgotpassword",
        lyt: "/src/layouts/empty.php"
    ),
    new Page(
        uri: "/clubplayers",
        pg: "/src/pages/clubplayers/clubplayers"
    ),
    new Page(
        uri: "/contact",
        pg: "/src/pages/contact/contact"
    ),
    new Page(
        uri: "/contact",
        pg: "/src/pages/contact/contact"
    ),
    new Page(
        uri: "/forums",
        pg: "/src/pages/forums/forums"
    ),
    new Page(
        uri: "/location",
        pg: "/src/pages/location/location"
    ),
    new Page(
        uri: "/player",
        pg: "/src/pages/player/player"
    ),
    new Page(
        uri: "/players",
        pg: "/src/pages/players/players"
    ),
    new Page(
        uri: "/study",
        pg: "/src/pages/study/study"
    ),
    new Page(
        uri: "/account",
        pg: "/src/pages/account/account"
    ),
    new Page(
        uri: "/about",
        pg: "/src/pages/about/about"
    )
];

foreach($pages as $page) {
    if ($page->uri == $uri) {
        if (file_exists(PATH.$page->pg.'.css')) $page->add_css($page->pg.'.css');
        if (file_exists(PATH.$page->pg.'.js')) $page->add_js($page->pg.'.js');
        
        require PATH.$page->lyt;
        
        return;
    }
}

?>