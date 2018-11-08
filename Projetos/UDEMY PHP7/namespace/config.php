<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 04/10/2018
 * Time: 15:23
 */

spl_autoload_register(function($nameClass){
    $dirClass = "class";
    $filenname = $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php";

    if (file_exists($filenname)){
        require_once($filenname);
    }
});