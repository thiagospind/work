<?php
session_start();

include "banco.php";
include "ajudantes.php";

$exibir_tabela = true;
$tem_erros = false;

$erros_validacao = array();

//if (isset($_POST['nome']) && $_POST['nome'] != '') {
if (tem_post()) {
    $tarefa = array();
	
	if (isset($_POST['nome']) && strlen($_POST['nome']) > 0 ) {
		$tarefa['nome'] = $_POST['nome'];
	} else {
		$tem_erros = true;
		$erros_validacao['nome'] = 'O nome da tarefa é obrigatório';
	}
	
	
    if (isset($_POST['descricao'])) {
        $tarefa['descricao'] = $_POST['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }
    if (isset($_POST['prazo']) && strlen($_POST['prazo']) > 0) {
		if (validar_data($_POST['prazo'])) {
			$tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
		} else {
			$tem_erros = true;
			$erros_validacao['prazo'] = 'O prazo não é uma data válida!';
		}		
	} else {
        $tarefa['prazo'] = '';
    }
	
    $tarefa['prioridade'] = $_POST['prioridade'];
    if (isset($_POST['concluida'])) {
        $tarefa['concluida'] = 1;
    } else {
        $tarefa['concluida'] = 0;
    }
    //$_SESSION['lista_tarefas'][] = $tarefa;
	
	if (! $tem_erros) {
		gravar_tarefa($conexao, $tarefa);
		header('Location: tarefas.php');
		die();
	}
}
$lista_tarefas = buscar_tarefas($conexao);

//print_r($lista_tarefas);

$tarefa = array(
	'id' => 0,
	'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
	'descricao' => (isset($_POST['descricao'])) ? $_POST['descricao'] : '',
	'prazo' => (isset($_POST['prazo'])) ? traduz_data_para_banco($_POST['prazo']) : '',
	'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : '',
	'concluida' => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
);

include "template.php";

/*

if (isset($_SESSION['lista_tarefas'])) {
    $lista_tarefas = $_SESSION['lista_tarefas'];
} else {
    $lista_tarefas = array();
}*/
?>


