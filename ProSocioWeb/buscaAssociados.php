<?php

    /*$servidor = "10.12.10.230";
    $usuario = "prosocioweb";
    $senha="@prosocioweb$";
    $banco="aapvr";*/
    include "conexao.php";
    $sn_buscou = "";
    $nomeAssoc = ( $_GET['term'] ? $_GET['term'] : $_POST['term']);

    $conexaoPdc = conecta('aapvr'); //mysqli_connect($servidor,$usuario,$senha,$banco);

    if (mysqli_connect_errno()){
        echo "Problemas ao conectar com o banco de dados: ".mysqli_connect_error();
        die();
    }


    $sql = "(select matricula, nome,date_format(dt_nascimento,'%d/%m/%Y') as dt_nascimento from associados
             where nome like '$nomeAssoc%')
             union 
             (select matricula, nome, date_format(dt_nascimento,'%d/%m/%Y') as dt_nascimento from excluidos
             where nome like '$nomeAssoc%')              
             order by nome limit 300";

    $resultado = mysqli_query($conexaoPdc, $sql);
    $associados = array();
    $a_json = array();
    $a_json_row = array();
    //return mysqli_fetch_assoc($resultado);
    if (!$resultado){
        echo mysqli_error($resultado);
    }

    $a_json = array();
    $a_json_row = array();

    while ($associado = mysqli_fetch_array($resultado)) {
        $matricula = htmlentities(stripslashes($associado['matricula']));
        $nome = htmlentities(stripslashes($associado['nome']));
        $dt_nasc = htmlentities(stripslashes($associado['dt_nascimento']));
        $a_json_row["id"] = $matricula;
        $a_json_row["value"] = $nome . ' - ' . $dt_nasc;
        $a_json_row["label"] = $nome . ' - ' . $dt_nasc;
        array_push($a_json,$a_json_row);
    }

    //return $associados;
    echo json_encode($a_json);

