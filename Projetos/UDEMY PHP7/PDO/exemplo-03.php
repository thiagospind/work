<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 15:51
 */

$conn = new PDO("mysql:dbname=aapvr;host=localhost","root","aapvr");

$stmt = $conn->prepare("insert into matriculas (USUA, MATRICULA) values (:usua, :matricula)");

$usua = "Thiago Spindola";
$matricula = "53883";

$stmt->bindParam(":usua", $usua);
$stmt->bindParam(":matricula", $matricula);

$stmt->execute();

echo "Inserido OK";