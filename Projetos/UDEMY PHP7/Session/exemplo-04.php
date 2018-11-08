<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 27/09/2018
 * Time: 09:16
 */

//session_id('fihpmp2lb6ls58726mmnhb7mpm');

require_once "config.php";

$_SESSION["nome"] = "Thiago";

//session_regenerate_id();

echo session_id();

echo "<br>";

var_dump($_SESSION);

if (session_status() == PHP_SESSION_DISABLED){

    echo "Sessões desabilitadas";

} elseif (session_status() == PHP_SESSION_NONE){

    echo "Sessões não existem";

} elseif (session_status() == PHP_SESSION_ACTIVE){

    echo "Sessões ativas";

}