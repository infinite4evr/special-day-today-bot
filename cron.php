<?php

require 'config.php';
file_get_contents("https://insulterbot.herokuapp.com/main.php");
date_default_timezone_set('Asia/Kolkata');

$data = getdate();
$month = $data['month'];
$date = $data['mday'];
$hours = $data['hours'];
$minute = $data['minutes'];

file_get_contents($website . "/sendmessage?chat_id=330959283&text=Cron Called");

if ($minute >= 30) {
    return;
}

$month = ucwords($month);

if ($hours != 00) {
    return;
}

$special_days = file_get_contents('Data/specialdays.txt');
$special_days = explode("\n", $special_days);
$date = (string) $date;
$today_date = $month . " $date";
$contents = "Today's special day\n";

$match = 0;

foreach ($special_days as $today) {

    if (strstr($today, $today_date)) {
        $pos = strpos($today, $today_date);

        if (strlen($date) == 1) {
            if (isset($today[$pos + strlen($today_date) + 1])) {
                continue;
            }

        }

        $match = 1;
        $length = strlen($today);
        $today[$length - 1] = " ";
        $contents = $contents . "\n" . $today;
    }
}
//$match is if there is any special day in database as of today
if ($match == 0) {

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $result = $conn->query("select * from `user_details` ");

    while ($row = $result->fetch_assoc()) {
        file_get_contents($website . "/sendmessage?chat_id=" . $row['chat_id'] . "&text=Today's special day: Nothing special to celebrate today");
    }

} else {
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $result = $conn->query("select * from `user_details` ");

    while ($row = $result->fetch_assoc()) {
        $content = array(
            'chat_id' => $row['chat_id'],
            'text' => "$contents\nHope you have a great day!",
        );
        $telegram->sendMessage($content);
        usleep(60000); // api limit for 20 messages/second
    }
}
