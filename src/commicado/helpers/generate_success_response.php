<?php

function generate_success_response($data, $message){
    return array(
        "success" => true,
        "message" => $message,
        // "error_code" => $error_code,
        "data" => $data
    );
}