<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 17/10/2018
 * Time: 16:55
 */

$cep = "27250500";
$link = "https://viacep.com.br/ws/$cep/json/";

$ch = curl_init($link);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response,true);
print_r($data["localidade"]);
print_r($data["bairro"]);