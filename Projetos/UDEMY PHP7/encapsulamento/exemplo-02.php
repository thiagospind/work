<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 03/10/2018
 * Time: 09:30
 */

class Pessoa{

    public $nome = "Rasmus Lerdof";
    protected $idade = 48;
    private $senha = "123456";

    public function verDados(){

        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>";
    }
}

class Programador extends Pessoa {

    public function verDados(){

        echo get_class($this) . "<br>";

        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>";

    }

}

$objeto = new Programador();

//echo $objeto->senha . "<br/>";

$objeto->verDados();