<?php
require "vendor/autoload.php";

$client_id = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJ1c2VyX2VtYWlsIjoicG9vbmFtQHBzeWNoeDg2LmNvbSIsImN1cnJlbnRfdGltZSI6IjE5OjQzOjI4LjYyMzY2MiJ9.QCnh0iOgXvDxlNYZkvsfiT9w6ncAeHoiqV_Te3bmeDg";
$client_secret = 'sha256$Ko6NSWYM$33a0c0dfdf4093275e1b6e567132dae1acbf4636424ff1004a832adcf9e7f49b';
$commicado = new \Commicado\Notification\Notification();
$res  = $commicado->authorize($client_id, $client_secret);

// $receivers = array();
// array_push($receivers, '9833427416');
// $message = "This is a test message";

print_r(" ------------- sending email with attachments---------------- ");
// $receivers_arr = array();
// array_push($receivers_arr, 'pankaj@psychx86.com');
$receivers_arr = ["pankaj@psychx86.com", "pankajagham1@gmail.com"];
// $receivers_arr = "pankaj@psychx86.com";
$sender = "alerts@page24.net";
$subject = "With html content in body ";
$header = "";
$request_service = "PPS";
// $body = "this is email body";
// $body_file = __DIR__ ."/attachment1.txt";
$body_file = " html content with attach";

$attach_file1 = __DIR__ ."/attachment2.txt";
$attachments = array();
$attach_file3 = __DIR__ ."/attachment3.txt";
$attach_file4 = __DIR__ ."/attachment4.html";

array_push($attachments, $attach_file3);
array_push($attachments, $attach_file4);
$res = $commicado->send_email($sender, $receivers_arr, $subject, $header, $body_file, $request_service, $attachments );
print_r($res);


// print_r(" ------------- sending email without attachments---------------- ");
// // $receivers_arr = array();
// // array_push($receivers_arr, 'pankaj@psychx86.com');
// $receivers_arr = ["pankaj@psychx86.com", "pankajagham1@gmail.com"];
// $sender = "alerts@page24.net";
// $subject = "email subject";
// $header = "";
// $request_service = "PPS";
// // $body = "this is email body";
// // $body_file = __DIR__ ."/attachment1.txt";
// $body_file = " body content";

// $attachments = array();
// $res = $commicado->send_email($sender, $receivers_arr, $subject, $header, $body_file, $request_service, $attachments );
// print_r($res);

// ------------------------ sending sms ---------------------------------------------

// $receivers = array();
// array_push($receivers, '9833427416');
// $message = "This is a test message";

// $res = $commicado->send_sms($receivers, $message);
// print_r($res);

// print_r(" ------------- sending voice message---------------- ");
// $receivers_arr = array();
// array_push($receivers_arr, '7972998543');
// $sender = "alerts@page24.net";
// $body = "this is email body";
// $request_service = "mcard";
// $notification_module = 1;
// $subject = "this is emial subject";
// $file = '@/path/to/file.txt';

// $res = $class_notification_obj->send_voice_call($sender, $receivers_arr, $subject, $body, $request_service, $notification_module, $file );
// print_r($res);