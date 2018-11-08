<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 03/10/2018
 * Time: 11:49
 */

class Documento{

    private $numero;

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
}