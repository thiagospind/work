<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 15:13
 */

$conn = new mysqli("localhost","root","aapvr","aapvr");

if ($conn->connect_error){
    echo " Erro: " . $conn->connect_error;
}

$result = $conn->query("select * from listagemplano where matricula = 99999");

$data = array();

while($row = $result->fetch_assoc()){
    array_push($data,$row);
}

echo json_encode($data);

