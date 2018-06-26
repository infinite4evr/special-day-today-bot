
<?php

    $bot_token = "Bot token";

    // Required
	$dbhost     ="localhost";  
	$dbname     ="What are you here for ?";
	$dbusername ="Nah, this is not yours";
	$dbpassword ="You suck";

	// Using the TelegramBotPHP library by Eleirbag89 - https://github.com/Eleirbag89/TelegramBotPHP
	require ("Telegram.php");

	$telegram = new Telegram($bot_token);
	$website='https://api.telegram.org/bot'."$bot_token";

	$text = $telegram->Text();
	$data = $telegram->getData();
	$chat_id = $telegram->ChatID();



?>





