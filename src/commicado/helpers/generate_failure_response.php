<?php

function generate_failure_response($error_code, $message){
    return array(
        "success" => false,
        "error_message" => $message,
        "error_code" => $error_code,
        "data" => new \stdClass()
    );
}