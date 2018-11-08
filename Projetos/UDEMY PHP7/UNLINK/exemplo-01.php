<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 10:45
 */

$file = fopen("teste.txt","w+");
fclose($file);
unlink("teste.txt");

echo "removido com sucesso";
