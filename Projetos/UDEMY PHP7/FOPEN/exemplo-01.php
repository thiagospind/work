<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 09:29
 */

$file = fopen("log.txt","a+");

fwrite($file,date("Y-m-d H:i:s"). "\r\n");
fclose($file);
echo "Arquivo criado";