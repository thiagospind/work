<?php

function conecta($banco)
{
    $host = 'banco';
    $user = 'root';
    $passw = 'aapvr';
    $conexao = mysqli_connect($host,$user,$passw,$banco);
    if (empty(mysqli_connect_error($conexao))){
        return $conexao;
    } else {
        echo "Erro ao conectar ao banco de dados!" . mysqli_connect_error($conexao);
    }
}

/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 30/08/2018
 * Time: 14:14
 */