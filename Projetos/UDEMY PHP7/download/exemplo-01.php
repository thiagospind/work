<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 17/10/2018
 * Time: 15:50
 */
$link = "https://www.google.com.br/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png";
$content = file_get_contents($link);
$parse = parse_url($link);
$basename = basename($parse["path"]);

$file = fopen($basename,"w+");
fwrite($file, $content);
fclose($file);
?>

<img src="<?= $basename; ?>">