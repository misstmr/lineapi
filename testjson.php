<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
    'actions' => [$actions]
];

$msg = [
    'type' => 'template',
    'altText' => 'MIS MED CMU LOGIN',
    'template' => $template
];
$data = [
    'to' => 'sssss',
    'messages' => [$msg],
];
$post = json_encode($data);
var_dump($post);
?>
