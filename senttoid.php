<?php

$access_token = 'QhRuEnlYYgUqhkE6xvQcy3z66LhecJXz3bgDLTgX4LW4fpmzV/cPuUa05MDCI//m88sddrwZnjs8xHqjEOp3uq9YfzhzGVFqnQtIriZMqyb0IOAZVtnp25AO4Bm2+W3KpSXDMQyYewTzRHzboD/+DgdB04t89/1O/w1cDnyilFU=';

// Validate parsed JSON data
// Loop through each event
// Reply only when message sent is in 'text' format
$text = "สวัสดี เบนซ์ สุดหล่อ new";


// Get replyToken
$toid = "Uc306e0332ff28d6e2ba20889702f90fd";

// Build message to reply back
$messages = [
    'type' => 'template',
    'text' => $text
];

// Make a POST Request to Messaging API to reply to sender
$url = 'https://api.line.me/v2/bot/message/push';
$data = [
    'to' => $toid,
    'messages' => [$messages],
];
$post = json_encode($data);

$post = '{
	"to": "Uc306e0332ff28d6e2ba20889702f90fd",
	"messages" :[{
  "type": "template",
  "altText": "this is a confirm template",
  "template": {
      "type": "confirm",
      "text": "Are you sure?",
      "actions": [
          {
            "type": "message",
            "label": "Yes",
            "text": "yes"
          },
          {
            "type": "message",
            "label": "No",
            "text": "no"
          }
      ]
  }
 }]
}';
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

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
