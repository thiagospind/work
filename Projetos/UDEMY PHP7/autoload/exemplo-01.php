<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 04/10/2018
 * Time: 10:13
 */

function __autoload($nomeclasse){
    var_dump($nomeclasse);
    require_once("$nomeclasse.php");
}

$carro = new DelRey();
$carro->acelerar("150");