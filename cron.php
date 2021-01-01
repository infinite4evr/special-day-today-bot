<?php

require 'config.php';

date_default_timezone_set('Asia/Kolkata');
$month = strtolower(date("F"));
$date = strtolower(date('d'));


if ($hours != 00) {
    return;
}

$special_days = file_get_contents('data/'.$month.'_'.$date.'.txt');

$result = $conn->query("select * from `user_details` where subscribed = true ");

while ($row = $result->fetch_assoc()) {
    $content = array(
        'chat_id' => $row['chat_id'],
        'text' => "$special_days\nHope you have a great day!",
    );
    $telegram->sendMessage($content);
    usleep(60000); // api limit for 20 messages/second
}
