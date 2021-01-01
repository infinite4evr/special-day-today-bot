
<?php

$bot_token = "Bot token";

// Required
$dbhost = "localhost";
$dbname = "What are you here for ?";
$dbusername = "Nah, this is not yours";
$dbpassword = "You suck";

// Using the TelegramBotPHP library by Eleirbag89 - https://github.com/Eleirbag89/TelegramBotPHP
require "Telegram.php";

$telegram = new Telegram($bot_token);
$api = 'https://api.telegram.org/bot' . $bot_token;
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

?>





