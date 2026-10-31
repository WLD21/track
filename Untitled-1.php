<?php
$myfile = fopen(__DIR__ . "/location.txt", "w");
$txt = "lat: " . $_GET["lat"] . "\nlng: " . $_GET["lng"] . "\n";
fwrite($myfile, $txt);
fclose($myfile);

?>