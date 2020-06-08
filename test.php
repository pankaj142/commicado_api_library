<?php

require_once __DIR__. '/src/commicado/class/class-auth.php';
foreach(glob( __DIR__ . '/src/commicado/helpers/*.php') as $file){
    print_r(" --wwww-- ");
    require_once $file;
}
foreach(glob( __DIR__ . '/src/commicado/class/*.php') as $file){
    print_r(" -xxx--- ");
    require_once $file;
}

$client_id = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDcsInVzZXJfZW1haWwiOiJwYW5rYWpAcHN5Y2h4ODYuY29tIiwiZXhwIjoxNTkxNjI5OTkxLCJpYXQiOjE1OTE1ODY3OTEsInJvbGUiOjB9.GFGJmd0vEBk3dodwJo96JgXBMNxO-HIUVOtpNXI9-g4";
$client_secret = 'sha256$36BHlxFz$899fb42eca8a907e222c8bf9554a43a5b6ff5bfcf3d7d555b344bec8d052036c';
$class_notification_obj = new \Commicado\Notification\Notification();
$class_notification_obj->generate_token($client_id, $client_secret);
// $class_notification_obj->show_new_token();

// ------------------------ sending emil ---------------------------------------------
// print_r(" ------------- sending email ---------------- ");
$receivers_arr = array();
array_push($receivers_arr, 'pankaj@psychx86.com');
$sender = "alerts@page24.net";
$subject = "this is emial subject";
$header = "this is  header";
$body = "this is email body";
$attachments = array();

$res = $class_notification_obj->send_email($sender, $receivers_arr, $subject, $body, $header, $attachments );
print_r($res);

// ------------------------ sending sms ---------------------------------------------

// $receivers = array();
// array_push($receivers, '9975277142');
// $message = "This is testing sms from pankaj";

// $res = $class_notification_obj->send_sms($receivers, $message);
// print_r($res);



// ------------------------ sending app notification---------------------------------------------

// $receivers = array();
// array_push($receivers, '9975277142');
// $message = "This is app notification from pankaj";
// $subject = "this is subject";

// $res = $class_notification_obj->send_app_notification($receivers, $subject, $message);
// print_r($res);


// ------------------------ get services---------------------------------------------


// $res = $class_notification_obj->get_services();
// print_r($res);