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

            $temp = explode(':', $event['message']['text']);
            $num = count($temp);
            if ($num >= 1) {
                if ($temp[0] == 'mis') {
                    if ($num >= 2) {
                        switch ($temp[1]) {
                            case "regis":
                                
                                $actions = [
                                    'type' => 'uri',
                                    'label' => 'View detail',
                                    'uri' => 'http://www.med.cmu.ac.th'
                                ];

                                $template = [
                                    'type' => 'buttons',
                                    'thumbnailImageUrl' => 'https://secure-earth-92819.herokuapp.com/login_icon.jpeg',
                                    'title' => 'Menu',
                                    'text' => 'Please select',
                                    'actions' => $actions
                                ];

                                $msg = [
                                    'type' => 'template',
                                    'altText' => 'MIS MED CMU LOGIN',
                                    'template' => $template
                                ];

                                break;
                            case "blue":
                                $text = "Your favorite color is blue!";
                                break;
                            case "green":
                                $text = "Your favorite color is green!";
                                //  $text = "รายการ " . $temp[1] . " ยังไม่มีบริการ";
                                $msg = [
                                    'type' => 'text',
                                    'text' => $text
                                ];
                                break;
                            default:
                                $text = "รายการ " . $temp[1] . " ยังไม่มีบริการ" . $event['source']['type'] . $event['source']['userId'];
                                $msg = [
                                    'type' => 'text',
                                    'text' => $text
                                ];
                        }
                    } else {
                        $text = 'ยังไม่มีบริการ "' . $temp[1] . '" ช่วยเหลือพิมพ์ "mis:?"';
                        $msg = [
                            'type' => 'text',
                            'text' => $text
                        ];
                    }

                    // Get replyToken
                    $replyToken = $event['replyToken'];
                    $replyToken = $event['source']['userId'];
                    // Build message to reply back
                    $messages = $msg;




                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $url = 'https://api.line.me/v2/bot/message/push';
                    $data = [
                        'to' => $replyToken,
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
                } else {
                    $text = 'ยังไม่มีบริการในรายการนี้ ช่วยเหลือพิมพ์ "mis:?"';
                }
            } else {
                $text = 'ยังไม่มีบริการในรายการนี้ ช่วยเหลือพิมพ์ "mis:?"';
            }
        }
    }
}
echo "OK";
?>
