<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 04/10/2018
 * Time: 10:16
 */

interface Veiculo
{
    public function acelerar($velocidade);
    public function frenar($velocidade);
    public function trocaMarcha($marcha);
}

abstract class Automovel implements Veiculo {

    public function acelerar($velocidade)
    {
        echo "O veiculo acelerou até " . $velocidade . " km/h";
    }

    public function frenar($velocidade)
    {
        echo "O veículo frenou até " . $velocidade . " km/h";
    }

    public function trocaMarcha($marcha)
    {
        echo "O veículo engatou a marcha " . $marcha . " km/h";
    }
}

class DelRey extends Automovel {

    public function empurrar(){

    }
}

$carro = new DelRey();
$carro->acelerar(200);