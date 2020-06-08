<?php
namespace Commicado\Notification;
use function Functions\call_http_method;
use function Functions\generate_failure_response;

class Notification extends \Commicado\Authentication\Authentication{
    public function __construct() {
        $this->base_url = "http://api.comunicado.in";
        parent::__construct();
        $this->token = "";
    }

    public function generate_token($client_id, $client_secret){
        print_r(" -- inside generate token -- ");
        $get_token_res = parent::get_token($client_id, $client_secret);

        if($get_token_res == false){
            return false; //indicating token is not generated
        }else{
            $this->token = $get_token_res;
            return true; //indiacting the token is generated
        }
    }

    // public function show_new_token(){
    //     print_r(" -- token showing -- ");
    //     print_r($this->token);
    // }

    public function send_email($sender, $receiver, $subject, $message, $headers, $attachments ){
        print_r("emial notification");
        if(empty($sender) || empty($receiver) || empty($subject) || empty($message)){
            print_r("compulsary fields missing");
            // return false;
            return generate_failure_response(9999, 'Compulsary fields are missing');
        }

        //return if token is not generated
        if($this->token == ""){
            return generate_failure_response(9999, 'Token is not generated. Please generate token and try again.'); 
        }

        $body_data = array(
            "sender" => $sender,
            "receiver" => $receiver,
            "subject" => $subject,
            "header" => $headers,
            "body" => $message,
            "notification_type" => "email",
            "request_service" => "mcard"
        );

        // $headers_data = array(
        //     "Content-Type: application/json",
        //     "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDcsInN0YXR1cyI6MiwiZXhwIjoxNTkxNDA2MjU1LCJpYXQiOjE1OTEzNjMwNTUsInJvbGUiOjB9.qMF1WsCELTtseADGFzTCE_GAsoNkJXJffDa4GwiaPn0"
        // );

        $headers_data = array(
              'Content-Type' => 'application/json',
            'Authorization' => $this->token
            //   'User-Agent' => 'commicado/wordpress;php',
        );

        $route = "/api/notification";
        $url = $this->base_url . $route;
        $http_type = "POST";
        $post_body_content_type = "application_json";
        $api_res = call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type );

        if($api_res['response']){
          return $api_res['response'];
        }else{
          return generate_failure_response(9999, 'Something went wrong.');
        }
    }

    public function send_sms($receivers, $message){
        if(empty($receivers) || empty($message) || !is_array($receivers)){
            print_r("compulsary fields missing");
            // return false;
            return generate_failure_response(9999, 'Compulsary fields are missing');
        }

        //return if token is not generated
        if($this->token == ""){
            return generate_failure_response(9999, 'Token is not generated. Please generate token and try again.'); 
        }
        
        $body_data = array(
            "receiver" => $receivers,
            "body" => $message,
            "notification_type" => "sms",
            "request_service" => "test",
            "sms_type" => "transactional",
            "flag" => "k"
        );
    
        $headers_data = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token
            //   'User-Agent' => 'commicado/wordpress;php',
        );
        $route = "/api/notification";
        $url = $this->base_url . $route;
        $http_type = "POST";
        $post_body_content_type = "application_json";
        $api_res = call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type );

        if($api_res['response']){
            return $api_res['response'];
        }else{
            return generate_failure_response(9999, 'Something went wrong.');
        }
    }

    public function send_app_notification(
        $receiver,
        $subject,
        $message_body,
        $image = '',
        $low_priority = '',
        $timeout = '5',
        $message_icon = '',
        $sound = '',
        $condition = '',
        $collapse_key = '',
        $delay_while_idle = '',
        $time_to_live = '',
        $restricted_package_name = '',
        $dry_run = false,
        $click_action = '',
        $badge = '',
        $color = '#600000',
        $tag = '',
        $body_loc_key = '',
        $body_loc_args = '',
        $title_loc_key = '',
        $title_loc_args = '',
        $content_available = '',
        $android_channel_id = ''
        ){

        if( empty($receiver) || empty($subject) || empty($message_body) || !is_array($receiver)){
            print_r("compulsary fields missing");
            return generate_failure_response(9999, 'Compulsary fields are missing');
        }

        //return if token is not generated
        if($this->token == ""){
            return generate_failure_response(9999, 'Token is not generated. Please generate token and try again.'); 
        }
        
        //handling the empty inputs for some arguments
        $image = empty($image) == true ? "https://www.freepngimg.com/thumb/kylie_jenner/85565-jenner-sims-coloring-accessory-hair-kylie.png" : $image;
        $low_priority = is_bool($low_priority) != true ? false : $low_priority;
        $timeout = empty($timeout) == true ? "5" : $timeout;
        $message_icon = empty($message_icon) == true ? "https://www.freepngimg.com/thumb/tattoo/3-tattoo-png-image.png" : $message_icon;
        $dry_run = is_bool($dry_run) != true ? false : $dry_run;
        $color = empty($color) == true ? '#600000' : $color;

        $body_data = array(
            "subject" => $subject,
            "body" => $message_body,
            "notification_type" => "app_notification",
            "request_service" => "mcard",
            "receiver" => $receiver,
            "image" => $image,
            "low_priority" => $low_priority,
            "timeout" => $timeout,
            "message_icon" => $message_icon,
            "sound" => $sound,
            "condition" => $condition,
            "collapse_key" => $collapse_key,
            "delay_while_idle" => $delay_while_idle,
            "time_to_live" => $time_to_live,
            "restricted_package_name" => $restricted_package_name,
            "dry_run" => $dry_run,
            "click_action" => $click_action,
            "badge" => $badge,
            "color" => $color,
            "tag" => $tag,
            "body_loc_key" => $body_loc_key,
            "body_loc_args" => $body_loc_args,
            "title_loc_key" => $title_loc_key,
            "title_loc_args" => $title_loc_args,
            "content_available" => $content_available,
            "android_channel_id" => $android_channel_id
        );

        $headers_data = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token
            //   'User-Agent' => 'commicado/wordpress;php',
        );

        $route = "/api/notification";
        $url = $this->base_url . $route;
        $http_type = "POST";
        $post_body_content_type = "application_json";
        $api_res = call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type );

        if($api_res['response']){
            return $api_res['response'];
        }else{
            return generate_failure_response(9999, 'Something went wrong.');
        }
    }

    public function get_services(){
        print_r("get servives");

        //return if token is not generated
        if($this->token == ""){
            return generate_failure_response(9999, 'Token is not generated. Please generate token and try again.'); 
        }
        $body_data =  false;
        $headers_data = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token
        );

        $route = "/api/service";
        $url = $this->base_url . $route;
        $http_type = "GET";
        $post_body_content_type = "false";
        $api_res = call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type );

        if($api_res['response']){
          return $api_res['response'];
        }else{
          return generate_failure_response(9999, 'Something went wrong.');
        }
    }
}