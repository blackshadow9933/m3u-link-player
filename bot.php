
<?php

// Define your bot token
define('BOT_TOKEN', '8097432687:AAFnmdykVYoUxANa5GzPCJiaLb_AK5KJ0d4');

// Get the incoming update from Telegram
$update = json_decode(file_get_contents("php://input"), TRUE);

// Check if the update contains a message
if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $username = $update["message"]["chat"]["username"] ?? 'Guest';

    // Send a response back to the user
    $response = "Chat ID: $chat_id\nUsername: $username";
    sendMessage($chat_id, $response);
}

// Function to send a message via the Telegram Bot
function sendMessage($chat_id, $text) {
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage";
    
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];

    // Use cURL to send the request
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

?>