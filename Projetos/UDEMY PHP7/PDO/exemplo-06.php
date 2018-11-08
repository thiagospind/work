<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 15:51
 */

$conn = new PDO("mysql:dbname=aapvr;host=localhost","root","aapvr");

$conn->beginTransaction();

$stmt = $conn->prepare("delete from matriculas where matricula = ?");

$matricula = 53883;

//$stmt->bindParam(":usua", $usua);
//$stmt->bindParam(":matricula", $matricula);

$stmt->execute(array($matricula));

//$conn->rollBack();

$conn->commit();

echo "Delete OK";