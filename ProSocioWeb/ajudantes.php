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
    if (verificaArquivo($origem)) {
        if (!copy($origem, $destino)) {
            return false;
        } else {
            return true;
        }
    }
}

function traduz_motivo_exclusao($motivo){

    if(isset($motivo) && $motivo != ''){
        if ($motivo == 'E'){
            return 'DEMISSÃO';
        }
        elseif ($motivo == 'I'){
            return 'INADIMPLÊNCIA';
        }
        elseif ($motivo == 'F'){
            return 'FALECIMENTO';
        }else{
            return '';
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$associado = array(
    'matricula' => (isset($_POST['matricula'])) ? $_POST['matricula'] : '',
    'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
    'situacao'  => (isset($_POST['situacao'])) ? $_POST['situacao'] : '',
    'dt_nascimento'  => (isset($_POST['dt_nascimento'])) ? $_POST['dt_nascimento'] : '',
    'sexo'  => (isset($_POST['sexo'])) ? traduz_sexo($_POST['sexo']) : '',
    'identidade' => (isset($_POST['identidade'])) ? $_POST['identidade'] : '',
    'org_exp'  => (isset($_POST['org_exp'])) ? $_POST['org_exp'] : '',
    'cpf'  => (isset($_POST['cpf'])) ? $_POST['cpf'] : '',
    'cart_prof' => (isset($_POST['cart_prof'])) ? $_POST['cart_prof'] : '',
    'profissao' => (isset($_POST['profissao'])) ? $_POST['profissao'] : '',
    'n_benef' => (isset($_POST['n_benef'])) ? $_POST['n_benef'] : '',
    'dt_admissao' => (isset($_POST['dt_admissao'])) ? $_POST['dt_admissao'] : '',
    'cep' => (isset($_POST['cep'])) ? $_POST['cep'] : '',
    'endereco' => (isset($_POST['endereco'])) ? $_POST['numend'] : '',
    'numend' => (isset($_POST['numend'])) ? $_POST['numend'] : '',
    'complend' => (isset($_POST['complend'])) ? $_POST['complend'] : '',
    'bairro' => (isset($_POST['bairro'])) ? $_POST['bairro'] : '',
    'cidade' => (isset($_POST['cidade'])) ? $_POST['cidade'] : '',
    'estado' => (isset($_POST['estado'])) ? $_POST['estado'] : '',
    'telefone' => (isset($_POST['telefone'])) ? $_POST['telefone'] : '',
    'telefone2' => (isset($_POST['telefone2'])) ? $_POST['telefone2'] : '',
    'plano_ext' => (isset($_POST['plano_ext'])) ? $_POST['plano_ext'] : '',
    'jornal' => (isset($_POST['jornal'])) ? $_POST['jornal'] : '',
    'descontado' => (isset($_POST['descontado'])) ? $_POST['descontado'] : '',
    'agencia' => (isset($_POST['agencia'])) ? $_POST['agencia'] : '',
    'conta' => (isset($_POST['conta'])) ? $_POST['conta'] : '',
    'dv' => (isset($_POST['dv'])) ? $_POST['dv'] : '',
    'email' => (isset($_POST['email'])) ? $_POST['email'] : ''
);

$excluido = array(
    'matricula' => (isset($_POST['matricula'])) ? $_POST['matricula'] : '',
    'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
    'situacao'  => (isset($_POST['situacao'])) ? $_POST['situacao'] : '',
    'dt_nascimento'  => (isset($_POST['dt_nascimento'])) ? $_POST['dt_nascimento'] : '',
    'sexo'  => (isset($_POST['sexo'])) ? traduz_sexo($_POST['sexo']) : '',
    'identidade' => (isset($_POST['identidade'])) ? $_POST['identidade'] : '',
    'org_exp'  => (isset($_POST['org_exp'])) ? $_POST['org_exp'] : '',
    'cpf'  => (isset($_POST['cpf'])) ? $_POST['cpf'] : '',
    'cart_prof' => (isset($_POST['cart_prof'])) ? $_POST['cart_prof'] : '',
    'profissao' => (isset($_POST['profissao'])) ? $_POST['profissao'] : '',
    'n_benef' => (isset($_POST['n_benef'])) ? $_POST['n_benef'] : '',
    'dt_admissao' => (isset($_POST['dt_admissao'])) ? $_POST['dt_admissao'] : '',
    'cep' => (isset($_POST['cep'])) ? $_POST['cep'] : '',
    'endereco' => (isset($_POST['endereco'])) ? $_POST['numend'] : '',
    'numend' => (isset($_POST['numend'])) ? $_POST['numend'] : '',
    'complend' => (isset($_POST['complend'])) ? $_POST['complend'] : '',
    'bairro' => (isset($_POST['bairro'])) ? $_POST['bairro'] : '',
    'cidade' => (isset($_POST['cidade'])) ? $_POST['cidade'] : '',
    'estado' => (isset($_POST['estado'])) ? $_POST['estado'] : '',
    'telefone' => (isset($_POST['telefone'])) ? $_POST['telefone'] : '',
    'telefone2' => (isset($_POST['telefone2'])) ? $_POST['telefone2'] : '',
    'plano_ext' => (isset($_POST['plano_ext'])) ? $_POST['plano_ext'] : '',
    'jornal' => (isset($_POST['jornal'])) ? $_POST['jornal'] : '',
    'descontado' => (isset($_POST['descontado'])) ? $_POST['descontado'] : ''
);

$arrayErro = array(
    'erroAgencia' => '',
    'erroConta' => '',
    'erroDv' => ''
);

?>