<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 08/10/2018
 * Time: 09:15
 */

spl_autoload_register(function($class_name){
    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if (file_exists($filename)){
        require_once ($filename);
    }
});