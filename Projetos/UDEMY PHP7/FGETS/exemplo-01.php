<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 10:55
 */

$filename = "usuarios.csv";

if(file_exists($filename)){
    $file = fopen($filename,"r");
    $headers = explode(",",fgets($file));
    $data = array();
    while($row = fgets($file)){
        $rowData = explode(",",$row);
        $linha = array();
        for ($i=0; $i < count($headers); $i++)
        {
            $linha[$headers[$i]] = $rowData[$i];

        }
        array_push($data,$linha);
    }
    fclose($file);

    echo json_encode($data);
}