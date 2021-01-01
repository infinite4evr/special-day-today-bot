<?php

require 'config.php';

$text = $telegram->Text();
$data = $telegram->getData();
$chat_id = $telegram->ChatID();


if ($text == '/start') {
    $statement = $conn->prepare("INSERT INTO `users`(`chat_id`, `username`) VALUES (?,?)");
    $statement->bind_param("ss", $chat_id, $data['message']['from']['username']);
    $statement->execute();
    $content = [
        'chat_id' => $chat_id,
        'text' => "Hi, I am What's Special Today Telegram Bot!\n\nSometimes we miss important special days like World Health Day, Environment day etc. and you don't want to keep an app in your phone just to remind you of the special days\n\nThis bot only works as per Indian Timezone(GMT+5:30)\n\nType \"/\" :\n\nSelect /subscribe to begin with\n\nSelect /unsubscribe to stop receiving messages\n\nNote :\nThis Bot is only available in English language\nQuestions and feedback are very welcome contact: @infinite4evr\n\nTake care!",
    ];
    $telegram->sendMessage($content);
} elseif ($text == '/subscribe') {
    $statement = $conn->prepare("update `users` set subscribed = true where chat_id = ?");
    $statement->bind_param("s", $chat_id);
    if ($statement->execute()) {
        $content = [
            'chat_id' => $chat_id,
            'text' => "
                 Thank you for subscription,You have been subscribed\n\nI will remind you at around 12 Am (GMT+5:30)
                 ",
        ];
        $telegram->sendMessage($content);
    }
} elseif ($text == '/unsubscribe') {
    $statement = $conn->prepare("update `users` set subscribed = false where chat_id = ?");
    $statement->bind_param("s", $chat_id);
    if ($statement->execute()) {
        $content = [
        'chat_id' => $chat_id,
        'text' => "
             We will miss you :( , You have been unsubscribed\n\nIf i caused you any problems then please contact my master @infinite4evr",
        ];
        $telegram->sendMessage($content);
    }
}
