<?php

$host = "10.12.10.230";
$usuario = "root";
$senha = "aapvr";
$banco = "aapvr";

$nome = ($_GET['term'] ? $_GET['term'] : $_POST['term']);

$conexao = mysqli_connect($host,$usuario,$senha,$banco);

$sql = " select matricula, nome, dt_nascimento
        from associados where nome like '$nome%'";

$resultado = mysqli_query($conexao,$sql);
$associados = array();

while($associado = mysqli_fetch_assoc($resultado)){
    $associados[] = $associado['nome'];
}

echo json_encode($associados);

/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 03/08/2018
 * Time: 15:11
 */