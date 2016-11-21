<?php

$access_token = 'QhRuEnlYYgUqhkE6xvQcy3z66LhecJXz3bgDLTgX4LW4fpmzV/cPuUa05MDCI//m88sddrwZnjs8xHqjEOp3uq9YfzhzGVFqnQtIriZMqyb0IOAZVtnp25AO4Bm2+W3KpSXDMQyYewTzRHzboD/+DgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent			
            if ($event['message']['text'] == "โหน่ง") {
                $text = "สวัสดี โหน่ง จิตราพร จอมวงค์";
            } else {
                if ($event['message']['text'] == "หญิง") {
                    $text = "สวัสดี หญิง อรชพร";
                } else {
                    if ($event['message']['text'] == "เบนซ์") {
                        $text = "สวัสดี เบนซ์ สุดหล่อ";
                    } else {
                        if ($event['message']['text'] == "เหน่ง") {
                            $text = "สวัสดี เหน่ง Y NOT 7 สุดหล่อ";
                        } else {
                            $text = $event['message']['text'];
                        }
                    }
                }
            }
            $text .= $text .'uid:'.$event['source']['userId'];
            // Get replyToken
            $replyToken = $event['replyToken'];

            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $text
            ];

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
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
        }
    }
}
echo "OK";
?>