<?php
require "vendor/autoload.php";

$client_id = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDcsInVzZXJfZW1haWwiOiJwYW5rYWpAcHN5Y2h4ODYuY29tIiwiZXhwIjoxNTkxNjI5OTkxLCJpYXQiOjE1OTE1ODY3OTEsInJvbGUiOjB9.GFGJmd0vEBk3dodwJo96JgXBMNxO-HIUVOtpNXI9-g4";
$client_secret = 'sha256$36BHlxFz$899fb42eca8a907e222c8bf9554a43a5b6ff5bfcf3d7d555b344bec8d052036c';
$class_notification_obj = new \Commicado\Notification\Notification();
$class_notification_obj->authorize($client_id, $client_secret);

// print_r(" ------------- sending email ---------------- ");
// $receivers_arr = array();
// array_push($receivers_arr, 'pankaj@psychx86.com');
// $sender = "alerts@page24.net";
// $subject = "this is emial subject";
// $header = "this is  header";
// $body = "this is email body";
// $attachments = array();

// $res = $class_notification_obj->send_email($sender, $receivers_arr, $subject, $body, $header, $attachments );
// print_r($res);