<?php

file_get_contents($website . "/sendmessage?chat_id=594498135&text=cron called");

require 'config.php';
// file_get_contents("https://insulterbot.herokuapp.com/main.php");
date_default_timezone_set('Asia/Kolkata');

$data = getdate();
$month = $data['month'];
$date = $data['mday'];
$hours = $data['hours'];
$minute = $data['minutes'];

$month = ucwords($month);

if ($hours != 00) {
    today_cron("false");
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

if ($match == 0) {
    
    $sent= check_if_sent();
    if($sent==false)
    today_cron("true");
    else return;

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $result = $conn->query("select * from `user_details_experiment` ");

    while ($row = $result->fetch_assoc()) {
        file_get_contents($website . "/sendmessage?chat_id=" . $row['chat_id'] . "&text=Today's special day: Nothing special to celebrate today");
    }
    

} else {
    
    $sent= check_if_sent();
    if($sent==false)
    today_cron("true");
    else return;

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $result = $conn->query("select * from `user_details_experiment` ");

    while ($row = $result->fetch_assoc()) {
        $content = array(
            'chat_id' => $row['chat_id'],
            'text' => "$contents\nHope you have a great day!",
        );
        $telegram->sendMessage($content);
    }
    
}

function today_cron($true_false)
{
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $conn->query("INSERT INTO `today_cron`(`true_false`) VALUES ($true_false)");
}

function check_if_sent()
{
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $conn->query("select * from 'today_cron'");
    $row = $result->fetch_assoc();
    $status = $row['true_false'][0];
    if ($status == true) {
        return true;
    } else {
        return false;
    }
}

?>