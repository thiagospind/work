<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 28/09/2018
 * Time: 16:43
 */
class Pessoa {

    public $nome; //Atributo

    public function falar(){ //Método

        return "O meu nome é: " . $this->nome;

    }
}

$thiago = new Pessoa();
$thiago->nome = "Thiago Spindola";
echo $thiago->falar();
