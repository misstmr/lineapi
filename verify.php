<?php
$access_token = 'QhRuEnlYYgUqhkE6xvQcy3z66LhecJXz3bgDLTgX4LW4fpmzV/cPuUa05MDCI//m88sddrwZnjs8xHqjEOp3uq9YfzhzGVFqnQtIriZMqyb0IOAZVtnp25AO4Bm2+W3KpSXDMQyYewTzRHzboD/+DgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
