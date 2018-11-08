<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 22/08/2018
 * Time: 17:51
 */
function conecta($banco){

    $usuario = "prosocioweb";
    $senha="@prosocioweb$";
    $servidor = "localhost";

    $nomeAssoc = (isset($_POST['buscaMatricula']) ? $_POST['buscaMatricula'] : '');

    $conexaoPdc = mysqli_connect($servidor,$usuario,$senha,$banco);
    if (mysqli_connect_errno()){
        echo "Problemas ao conectar com o banco de dados: ".mysqli_connect_error();
        die();
    }else{
        mysqli_set_charset($conexaoPdc, "UTF8");
        return $conexaoPdc;
    }

}