<?php

require 'config.php';
file_get_contents("https://insulterbot.herokuapp.com/main.php");
date_default_timezone_set('Asia/Kolkata');

$month = strtolower(date("F"));

$date = strtolower(date('d'));

file_get_contents($website . "/sendmessage?chat_id=330959283&text=Cron Called");


if ($hours != 00) {
    return;
}

$special_days = file_get_contents('data/'.$month.'_'.$date.'.txt');



$content = array(
    'chat_id' => '330959283',
    'text' => "$special_days\nHope you have a great day!",
);
$telegram->sendMessage($content);
usleep(60000); // api limit for 20 messages/second


$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$result = $conn->query("select * from `user_details` ");

while ($row = $result->fetch_assoc()) {
    $content = array(
        'chat_id' => '330959283',
        'text' => "$special_days\nHope you have a great day!",
    );
    $telegram->sendMessage($content);
    usleep(60000); // api limit for 20 messages/second
}
