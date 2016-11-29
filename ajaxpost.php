
<?php



$access_token = $_POST['access_token'];

// Validate parsed JSON data
// Loop through each event
// Reply only when message sent is in 'text' format
$text = "sent by notify";


// Get replyToken
$toid = "Uc306e0332ff28d6e2ba20889702f90fd";

// Build message to reply back
$messages = [
    'type' => 'text',
    'text' => $text
];

// Make a POST Request to Messaging API to reply to sender
$url = 'https://notify-api.line.me/api/notify';
$data = [
   
    'message' => $text
];
$post = 'message='.$_POST['message'];
$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result . "\r\n";



echo "OK";
?>