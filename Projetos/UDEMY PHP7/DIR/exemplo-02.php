<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 09:00
 */

$images = scandir("images");
$data = array();

foreach($images as $img){
    if (!in_array("$img",array(".",".."))){
        $filename = "images" . DIRECTORY_SEPARATOR . $img;
        $info = pathinfo($filename);
        $info["size"] = filesize($filename);
        $info["modified"] = date("d/m/Y H:i:s",filemtime($filename));
        $info["url"] = "http://localhost:63342/UDEMY%20PHP7/DIR/".str_replace("\\","/",$filename);
        array_push($data,$info);
    }
}

echo json_encode($data);