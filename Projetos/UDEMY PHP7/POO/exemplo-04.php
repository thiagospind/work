<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 03/10/2018
 * Time: 09:09
 */
class Endereco {

    private $logradouro;
    private $numero;
    private $cidade;

    public function __construct($a, $b, $c){

        $this->logradouro = $a;
        $this->numero = $b;
        $this->cidade = $c;
    }

    public function __destruct()
    {
        //var_dump("Destriur");
    }

    public function __toString()
    {
        return $this->logradouro. " , ".$this->numero." , ".$this->cidade;
    }

}

$meuEndereco = new Endereco("Rua D","93","Volta Redonda");
echo $meuEndereco;