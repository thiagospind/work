<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 28/09/2018
 * Time: 14:47
 */

$dt = new DateTime();

$periodo = new DateInterval("P15D");

echo $dt -> format("d/m/Y H:i:s")."<br>";

$dt -> add($periodo);

echo $dt -> format("d/m/Y H:i:s");

