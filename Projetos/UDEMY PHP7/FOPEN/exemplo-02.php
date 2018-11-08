<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 09:45
 */

require_once("config.php");

$sql = new Sql();

$usuarios = $sql->select("select * from usuarios where codigo > 1800");

$headers = array();

foreach($usuarios[0] as $key => $value){
    array_push($headers, ucfirst($key));
}

$file = fopen("usuarios.csv","w+");
fwrite($file,implode(",",$headers) . "\r\n");

foreach ($usuarios as $row) {
    $data = array();
    foreach ($row as $key => $value) {
        array_push($data, $value);
    } //End foreach de coluna
    fwrite($file, implode(",",$data) . "\r\n");
} //End foreach de linha
fclose($file);