<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 14:29
 */

require_once("config.php");

use Cliente\Cadastro;

$cad = new Cadastro();

$cad->setNome("Djalma Sindeaux");
$cad->setEmail("djalma@hcode.com.br");
$cad->setSenha("123456");

$cad->registrarVenda();

//echo $cad;