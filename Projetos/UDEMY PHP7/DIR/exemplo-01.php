<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 09/10/2018
 * Time: 16:52
 */

$name = "images";

if (!is_dir($name)){
    mkdir($name);
    echo "Diretório criado com sucesso!";
} else {
    rmdir($name);
    echo "Diretorio $name já existe, foi removido!";
}