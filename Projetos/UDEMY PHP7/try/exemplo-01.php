<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 18/10/2018
 * Time: 09:40
 */

try {
    throw new Exception("Erro teste",400);
} catch(Exception $e){
    echo json_encode(array(
        "message"=>$e->getMessage(),
        "line"=>$e->getLine(),
        "file"=>$e->getFile(),
        "code"=>$e->getCode()
    ));
}