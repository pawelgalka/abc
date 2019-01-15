<?php
$file = file_get_contents("../blogi/".$_GET["blogname"]."/wiadomosci");
$lines = explode("\n",$file);
$result="";
$line = $_GET["nickname"].": ".$_GET["message"]."\n";

if (!isset($_COOKIE['lastUpdate'])) {
    setcookie('lastUpdate', 0); $_COOKIE['lastUpdate'] = 0;
}

$maxCapacity = 8;
if(count($lines)>$maxCapacity){
    for($x=count($lines)-$maxCapacity;$x<count($lines);$x++) $result=$result.$lines[$x]."\n";
    $result=substr($result,0,-1);
    file_put_contents('../blogi/'.$_GET["blogname"]."/wiadomosci", $result.$line);
}
else{
    file_put_contents('../blogi/'.$_GET['blogname']."/wiadomosci", $result.$line, FILE_APPEND);
}
setcookie('lastUpdate', filemtime('../blogi/'.$_GET['blogname']."/wiadomosci"));


?>
