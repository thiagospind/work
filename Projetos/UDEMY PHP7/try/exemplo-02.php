<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 18/10/2018
 * Time: 11:33
 */


function trataNome($nome){
    if(!$nome){
        throw new Exception("Nenhum nome encontrado!",1);
    }
    echo ucfirst($nome)."<br>";
}

try {
    trataNome("João");
    trataNome("");
} catch(Exception $e){
    echo $e->getMessage();
} finally {
    echo "<br>"."Executou o try!";
}

