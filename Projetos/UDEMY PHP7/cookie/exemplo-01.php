<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 17/10/2018
 * Time: 17:10
 */

$data = array(
    "empresa"=>"Hcode Treinamentos"
);

setcookie("NOME_DO_COOKIE",json_encode($data),time() + 3600);
echo "OK";
