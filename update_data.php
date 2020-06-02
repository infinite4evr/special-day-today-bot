<?php

$file = file_get_contents('Data/specialdays.txt');



echo "<pre>";
$arr = json_decode(remove_utf8_bom($file), true);

print_r($arr);




function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}