<?php



require('config.php');

if ($text == '/start') {
    
    // First response after receiving "/start" from userLang
    $content = array(
        'chat_id' => $chat_id,
        'text' => "    Hi, this is the official What's Special Today Telegram Bot!\n\nSometimes we miss important special days like World Health Day, Environment day etc. and you don't want to keep an app in your phone just to remind you of the special days\n\nThis bot only works as per Indian Timezone(GMT+5:30)\n\nType \"/\" :\n\nSelect /subscribe to begin with\n\nSelect /unsubscribe to stop receiving messages\n\nNote :\nThis Bot is only available in English language\nQuestions and feedback are very welcome contact: @infinite4evr\n\nTake care!"
    );
    $telegram->sendMessage($content);
}


else if ($text == '/subscribe') {
    
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $conn->query("INSERT INTO `user_details`(`chat_id`) VALUES (\"$chat_id\")");
    
    $content = array(
        'chat_id' => $chat_id,
        'text' => "
             Thank you for subscription,You have been subscribed\n\nI will remind you at around 12 Am (GMT+5:30)
             "
    );
    $telegram->sendMessage($content);
    
}

else if ($text == '/unsubscribe') {
    
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $conn->query("delete from `user_details` where chat_id=$chat_id");
    
    $content = array(
        'chat_id' => $chat_id,
        'text' => "
             We will miss you :( , You have been unsubscribed\n\nIf i caused you any problems then please contact my master @infinite4evr"
    );
    $telegram->sendMessage($content);
    
}



?>
       
        