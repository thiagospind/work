<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 05/10/2018
 * Time: 14:51
 */

namespace Cliente;

class Cadastro extends \Cadastro {

    public function registrarVenda(){
        echo "Foi registrada uma venda para o cliente " . $this->getNome();
    }
}