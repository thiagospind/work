<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 17/10/2018
 * Time: 17:18
 */

if (isset($_COOKIE["NOME_DO_COOKIE"])){
    $obj = json_decode($_COOKIE["NOME_DO_COOKIE"]);
    echo $obj->empresa;
}