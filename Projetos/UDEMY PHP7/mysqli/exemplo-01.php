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

$stmt = $conn->prepare("insert into listagemplano (matricula) values (?)");

$matr = "99876";

$stmt->bind_param("i",$matr);

$stmt->execute();


