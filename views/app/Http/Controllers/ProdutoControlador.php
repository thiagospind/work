<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    public function listar(){
        $produtos = [
            "Notebook Dell",
            "Mouse e Teclado Microsoft",
            "Monitor 21 - Samsung",
            "Impressora HP",
            "HD SSD 512GB"
        ];
        return view('produtos',compact('produtos'));
    }

    public function secaoProdutos($palavra){
        return view('secaoProdutos',compact('palavra'));
    }

    public function mostrar_opcoes(){
        return view('mostrar_opcoes');
    }

    public function opcoes($opcao){
        return view('opcoes',compact('opcao'));
    }

    public function loopFor($n) {
        return view('loop_for',compact('n'));
    }

    public function loopForeach(){
        $produtos = [
            ["id" => 1, "nome"=>"Computador"],
            ["id" => 2, "nome"=>"Mouse"],
            ["id" => 3, "nome"=>"Teclado"],
            ["id" => 4, "nome"=>"Impressora"],
            ["id" => 5, "nome"=>"Monitor"],
        ];
        return view('foreach', compact('produtos'));
    }
}
