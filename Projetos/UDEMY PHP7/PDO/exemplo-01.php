<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 15:37
 */

$conn = new PDO("mysql:dbname=aapvr;host=localhost","root","aapvr");

$stmt = $conn->prepare("select matricula, nome from associados where matricula = 53883");

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row) {
    foreach($row as $key => $value){
        echo "<strong>".$key.": </strong>".$value."<br/>";
    }

    echo "===================================================";
}

//var_dump($result);