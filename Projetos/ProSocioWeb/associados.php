<?php
    //include "consultaBanco.php";
//$associados = array();
$associados = array(
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

?>