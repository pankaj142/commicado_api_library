<?php
namespace Commicado\Authentication;
use function Helpers\call_http_method;

class Authentication{
    public function __construct() {
        print_r("inside Auth contructor");
        // $this->base_url = "http://api.comunicado.in";
        $this->base_url = "http://apialt.comunicado.in";
        // $this->client_id = $client_id;
        // $this->client_secret = $client_secret;
    }
    // public $token = '';

    public function get_token($client_id, $client_secret){
        print_r(" -- inside get token");        

        $body_data = array(
            "client_id" => $client_id,
            "client_secret" => $client_secret
        );
        $route = "/api/get-auth-token";
        $url = $this->base_url . $route;
        $http_type = "POST";
        $post_body_content_type = "get_auth_token";
        $headers_data = false; //header is not applicabel in this api

        $api_res = call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type );

        if($api_res['status'] == 200){
          $token = $api_res['response']->data->token;
          // print_r($token);
          return $token;
        }else{
          print_r(" -- token not generated. -- ");
          return false;
        }
        return false;
    }
}