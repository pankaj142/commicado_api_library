<?php
    namespace Functions;
    if( ! function_exists('greetings') ) {
        function greetings(string $firstname): string {
            return "Howdy $firstname!";
        }
    }

    if( ! function_exists('call_http_method')){
        function call_http_method($url, $body_data, $http_type, $headers_data, $post_body_content_type ){
        //$post_body_content_type values  => 
        //1. application_json
        //2. form_data
        //3. false    => in case not applicable

        //$http_type values =>
        //1. POST
        //2. GET

        //$headers_data values =>
        //

            print_r("------------- INSIDE HTTP METHOD CALL ----------- ");
            print_r($body_data);
            print_r("------------- INSIDE HTTP METHOD CALL ----------- ");

        if($http_type == "POST"){
            $curl = \curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            if($headers_data !=  false){ //if header is applicable
                print_r("headers provided");
                $headers = array(
                    'Content-Type: ' .$headers_data['Content-Type'],
                    'Authorization: '. $headers_data['Authorization']
                );
                // Set HTTP Header for POST request 
                curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
            }

            if($post_body_content_type == 'application_json'){
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body_data));
            }elseif ($post_body_content_type == 'form_data'){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data);
            }else{ //in other cases
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($body_data));
            }
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 5);

            $response = curl_exec($curl);
            $response_info = curl_getinfo($curl);
            $response_status_code = $response_info['http_code'];
            curl_close($curl);

            if($response_status_code >= 200 && $response_status_code < 300){ //successful responses
            $res = json_decode($response);
            return array(
                "status" => $response_status_code,
                "message" => "success",
                "response" => $res
            );
            }elseif($response_status_code >= 300 && $response_status_code < 400){ //redirect errors
            return array(
                "status" => $response_status_code,
                "message" => "redirect errors",
                "response" => json_decode($response)
            );
            }elseif($response_status_code >= 400 && $response_status_code < 500){ //client side error
            return array(
                "status" => $response_status_code,
                "message" => "client side errors",
                "response" => json_decode($response)
            );
            }elseif($response_status_code >= 500 && $response_status_code < 600){ //server side error
            return array(
                "status" => $response_status_code,
                "message" => "server side errors",
                "response" => json_decode($response)
            );
            }else{ //for other status codes
            return array(
                "status" => $response_status_code,
                "message" => "something went wrong",
                "response" => json_decode($response)
            );
            }
        }elseif($http_type == "GET"){
            $curl = \curl_init($url);
            if($headers_data !=  false){ //if header is applicable
                print_r("headers provided");
                $headers = array(
                    // 'Content-Type: ' .$headers_data['Content-Type'],
                    'Authorization: '. $headers_data['Authorization']
                );
                // Set HTTP Header for POST request 
                curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
            }

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $response_info = curl_getinfo($curl);
            $response_status_code = $response_info['http_code'];
            curl_close($curl);

            if($response_status_code >= 200 && $response_status_code < 300){ //successful responses
            $res = json_decode($response);
            return array(
                "status" => $response_status_code,
                "message" => "success",
                "response" => $res
            );
            }elseif($response_status_code >= 300 && $response_status_code < 400){ //redirect errors
            return array(
                "status" => $response_status_code,
                "message" => "redirect errors",
                "response" => json_decode($response)
            );
            }elseif($response_status_code >= 400 && $response_status_code < 500){ //client side error
            return array(
                "status" => $response_status_code,
                "message" => "client side errors",
                "response" => json_decode($response)
            );
            }elseif($response_status_code >= 500 && $response_status_code < 600){ //server side error
            return array(
                "status" => $response_status_code,
                "message" => "server side errors",
                "response" => json_decode($response)
            );
            }else{ //for other status codes
            return array(
                "status" => $response_status_code,
                "message" => "something went wrong",
                "response" => json_decode($response)
            );
            }
        }
        }
    }

    if( ! function_exists('generate_failure_response') ) {
        function generate_failure_response($error_code, $message){
            return array(
                "success" => false,
                "error_message" => $message,
                "error_code" => $error_code,
                "data" => new \stdClass()
            );
        }
    }

    if( ! function_exists('generate_success_response') ) {
        function generate_success_response($data, $message){
            return array(
                "success" => true,
                "message" => $message,
                // "error_code" => $error_code,
                "data" => $data
            );
        }
    }
?>