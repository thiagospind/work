<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 18/10/2018
 * Time: 11:53
 */
header("Content-Type: application/json; charset=utf-8");
function error_handler ($code,$message, $file, $line){
    echo json_encode(array(
        "code"=>$code,
        "message"=>$message,
        "file"=>$file,
        "line"=>$line
    ));
}

set_error_handler("error_handler");

echo 100/0;