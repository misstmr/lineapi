<?php


if($_POST['status']){
$access_token = 'QhRuEnlYYgUqhkE6xvQcy3z66LhecJXz3bgDLTgX4LW4fpmzV/cPuUa05MDCI//m88sddrwZnjs8xHqjEOp3uq9YfzhzGVFqnQtIriZMqyb0IOAZVtnp25AO4Bm2+W3KpSXDMQyYewTzRHzboD/+DgdB04t89/1O/w1cDnyilFU=';

// Validate parsed JSON data
// Loop through each event
// Reply only when message sent is in 'text' format
$text = $_POST['msg'];


// Get replyToken
$toid = $_POST['uid'];

// Build message to reply back
$messages = [
    'type' => 'text',
    'text' => $text
];

// Make a POST Request to Messaging API to reply to sender
$url = 'https://api.line.me/v2/bot/message/push';
$data = [
    'to' => $toid,
    'messages' => [$messages],
];
$post = json_encode($data);
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
}else{
    
    echo "not";
    
    
}
?>

<html>
    <body>
        <form method="post" action="">
            <input type="hidden" name="status" width="200" value="true">
            uid : <input name="uid" value=""  size="50"> <br>
            msg : <textarea name="msg" width="200"  ></textarea><br>
            <input type="submit" value="send" >
        </form>
    </body>    
</html>
