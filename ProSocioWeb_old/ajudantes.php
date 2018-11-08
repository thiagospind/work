<?php

function traduz_prioridade($codigo){
	
	$prioridade = '';
	switch ($codigo){
		case 1:
			$prioridade = 'Baixa';
			break;
		case 2:
			$prioridade = 'Média';
			break;
		case 3:
			$prioridade = 'Alta';
			break;
	}
	
	return $prioridade;
}

function traduz_data_para_banco($data){
	
	if ($data == "") {
		return "";
	}
	
	$dados = explode("/", $data);
	
	if (count($dados) != 3) {
		return $data;
	}
	
	$data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";
	
	return $data_mysql;
}

function traduz_data_para_exibir($data){
	
	if ($data == "" OR $data == "0000-00-00") {
		return "";
	}
	
	$dados = explode("-", $data);
	
	if (count($dados) != 3) {
		return $data;
	}
	
	$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
	
	return $data_exibir;
}


function traduz_concluida($concluida) {
	
	if ($concluida == 1) {
		return "Sim";
	}
	
	return "Não";
}

function tem_post() {
	
	if (count($_POST > 0)) {
		return true;	
	}
	return false;
}

function validar_data($data) {
	
	$padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
	$resultado = preg_match($padrao, $data);
	
	if (! $resultado) {
		return false;
	}
	
	$dados = explode('/', $data);
	
	$dia = $dados[0]; 
	$mes = $dados[1];
	$ano = $dados[2];
	
	$resultado = checkdate($mes, $dia, $ano);
	
	return $resultado;
}

function traduz_sexo($sexo){
    if($sexo == 'F'){
        return 'FEMININO';
    }else if($sexo == 'M'){
        return 'MASCULINO';
    }
}

function traduz_sim_nao($valor){
    if($valor == 'S'){
        return 'SIM';
    }else if($valor == 'N'){
        return 'NÃO';
    }
}

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    if ($val != ''){
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
    }
    return $maskared;
}

function verificaArquivo($arquivo){
    if (file_exists($arquivo)){
        return true;
    } else {
        return false;
    }
}

function copiaArquivo($origem,$destino) {
    if(!copy($origem,$destino)){
        return false;
    } else {
        return true;
    }
}

?>