<?php

// (A) SETTINGS
$chrome = "C:\Program Files\Mozilla Firefox\\ firefox.exe"; // path to chrome
$saveas = __DIR__ . DIRECTORY_SEPARATOR . "demoA.png"; // save screenshot
$size = "1080,1920"; // height, width
$url = "localhost/php/game.php"; // url to access
 
// (B) HEADLESS CHROME
$cmd = <<<CMD
"$chrome" --headless --screenshot="$saveas" --window-size=$size "$url"
CMD;
exec($cmd);

?>