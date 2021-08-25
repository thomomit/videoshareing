<?php
if(!isset($_POST['team-namae']) || $_POST['team-namae'] === "") {
    echo "NG1";
    return -1;
}
if(!isset($_POST['shogai-check']) || $_POST['shogai-check'] === "") {
    echo "NG2";
    return -1;
}
if(!isset($_POST['doi-check']) || $_POST['doi-check'] === "") {
    echo "NG3";
    return -1;
}
if(!isset($_POST['namae']) || $_POST['namae'] === "") {
    echo "NG4";
    return -1;
}
if(!isset($_POST['kana']) || $_POST['kana'] === "") {
    echo "NG5";
    return -1;
}
if(!isset($_POST['sisetu']) || $_POST['sisetu'] === "") {
    echo "NG6";
    return -1;
}
if(!isset($_POST['jusho']) || $_POST['jusho'] === "") {
    echo "NG7";
    return -1;
}
if(!isset($_POST['tel']) || $_POST['tel'] === "") {
    echo "NG8";
    return -1;
}
if(!isset($_POST['mail']) || $_POST['mail'] === "") {
    echo "NG9";
    return -1;
}
if(!isset($_POST['kyogi']) || $_POST['kyogi'] === "") {
    echo "NG10";
    return -1;
}

$memo = "";
if(isset($_POST['memo'])) {
    $memo = $_POST['memo'];
}

$savePath = microtime(true);

$buff = date("Y-m-d H:i:s");

$buff .= "\t".$_POST['kyogi'];
$buff .= "\t".$_POST['team-namae'];
$buff .= "\t".convertEOL($_POST['comment']);
$buff .= "\t".$_POST['shogai-check'];
$buff .= "\t".$_POST['doi-check'];
$buff .= "\t".$_POST['namae'];
$buff .= "\t".$_POST['kana'];
$buff .= "\t".$_POST['sisetu'];
$buff .= "\t".convertEOL($_POST['jusho']);
$buff .= "\t".$_POST['tel'];
$buff .= "\t".$_POST['mail'];
$buff .= "\t".convertEOL($_POST['memo']);
$buff .= "\t".$_POST['file-name'];
file_put_contents("/var/www/uploaded/".$savePath.".txt", $buff);
echo "OK";
return 0;

function convertEOL($string, $to = "[CR]")
{
    return preg_replace("/\r\n|\r|\n/", $to, $string);
}
?>