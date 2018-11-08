<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 20/08/2018
 * Time: 13:06
 */

include_once "conexao.php";
include_once "ajudantes.php";

$telefone = (!empty(trim($_POST['telefone'])) ? preg_replace("/\D+/", "", $_POST['telefone']) : 'null');
$telefone2 =  (!empty(trim($_POST['telefone2'])) ? preg_replace("/\D+/", "", $_POST['telefone2']) : 'null');
$descontado = (!empty(trim($_POST['forma_desconto'])) ? $_POST['forma_desconto'] : 'null');
$agencia = (!empty(trim($_POST['agencia'])) ? $_POST['agencia'] : 'null');
$conta = (!empty(trim($_POST['conta'])) ? $_POST['conta'] : 'null');
$dv = (!empty(trim($_POST['dv'])) ? $_POST['dv'] : 'null');
$matricula = (!empty(trim($_POST['matricula'])) ? $_POST['matricula'] : 'null');
$email = (!empty(trim($_POST['email'])) ? $_POST['email'] : 'null');;

$conexaoPdc = conecta('aapvr');

$arrayErro = array();
$erro = '';
if ($descontado == 'ITAU' || $descontado == 'CEF' || $descontado == 'SANTANDER') {

    if ($agencia == 'null') {
        $arrayErro = ["erroAgencia" => "Informe a agência!"];
        $erro = 's';
    } else {
        $arrayErro = ["erroAgencia" => ""];
    }
    if ($conta == 'null') {
        $arrayErro += ["erroConta" => "Informe a conta!"];
        $erro = 's';
    } else {
        $arrayErro += ["erroConta" => ""];
    }
    if ($dv == 'null') {
        $arrayErro += ["erroDv" => "Informe o dígito verificador!"];
        $erro = 's';
    } else {
        $arrayErro += ["erroDv" => ""];
    }

    if ($descontado == 'CEF' && $erro != 's'){
        if (validaContaCEF($agencia.$conta,$dv) == false){
            $arrayErro = ["erroAgencia" => "Verifique a agência!"];
            $arrayErro += ["erroConta" => "Verifique a conta!"];
            $arrayErro += ["erroConta" => "Verifique o DV!"];
            $erro = 's';
        }
    } elseif ($descontado == 'SANTANDER' && $erro != 's'){

    }
}

if ($email != 'null'){
    if(validaemail($email) == true){
        $erro = '';
    }else{
        $arrayErro += ["erroEmail" => "Email Inválido!"];
        $erro = 's';
    }
}

function validaContaCEF($ageconta,$dv){
    $y=2;
    $res = 0;
    if (strlen($ageconta) == 15){
        for ($i = 15; $i <= 15; $i--){
            if ($y > 9){
                $y = 2;
            }
            $res += ($y * substr($ageconta,$i,1));
            $y += 1;
        }
        $res = $res * 10;
        $dvc = $res % 11;

        if ($dv == $dvc){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


if (isset($matricula) && $erro = ''){

    $sql = "update associados set ".
            "telefone = " . ($telefone != 'null' ? '\'' . $telefone . '\'' : $telefone) . ",".
            "telefone2 = " .($telefone2 != 'null' ?  '\'' . $telefone2 . '\'' : $telefone2) . ",".
            "descontado = " .($descontado != 'null' ?  '\'' . $descontado . '\'' : $descontado) . ",".
            "agencia = " . ($agencia != 'null' ? '\'' . $agencia . '\'' : $agencia) . ",".
            "conta = " . ($conta != 'null' ? '\'' . $conta . '\'' : $conta) . ",".
            "dv = " . ($dv != 'null' ? '\'' . $dv . '\'' : $dv) . ",".
            "usu_login = ". $_SESSION['login'] . " " .
            "where matricula = $matricula";

    //mysqli_set_charset($conexaoPdc,"UTF8");
    $resultado = mysqli_query($conexaoPdc,$sql);

    if (mysqli_affected_rows($conexaoPdc) > 0) {
        if (mysqli_error($conexaoPdc)) {
            echo "Erro ao editar dados!" . mysqli_error();
            die();
        }
    }else{
        echo "Dados alterados!";
        header('location:prosocio.php');
    }
}

function validaemail($email){
    //verifica se e-mail esta no formato correto de escrita
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $mensagem='erro';
        return $mensagem;
    }
    else{
        //Valida o dominio
        $dominio=explode('@',$email);
        if(!checkdnsrr($dominio[1],'A')){
            $mensagem='erro';
            return $mensagem;
        }
        else{return true;} // Retorno true para indicar que o e-mail é valido
    }
}