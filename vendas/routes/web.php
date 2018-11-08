<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias',function (){
    $cats = DB::table('categorias')->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<hr>";

    //pluck retorna somente o campo que foi passado como parâmetro
    $nomes = DB::table('categorias')->pluck('nome');
    foreach ($nomes as $nome){
        echo "$nome <br>";
    }

    echo "<hr>";

    $cats = DB::table('categorias')->where('id',1)->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<hr>";

    $cats = DB::table('categorias')->where('id',1)->first();
    echo "id: " . $cats->id . "; ";
    echo "nome: " . $cats->nome . "<br>";

    echo "<p>Retorna um array utilizando like</p>";
    $cats = DB::table('categorias')->where('nome','like','%p%')->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Sentenças Lógicas</p>";
    $cats = DB::table('categorias')->where('id',1)->orWhere('id',2)->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Intervalos</p>";
    $cats = DB::table('categorias')->whereBetween('id',[2,4])->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Intervalos (negação)</p>";
    $cats = DB::table('categorias')->whereNotBetween('id',[3,4])->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Intervalos (conjuntos)</p>";
    $cats = DB::table('categorias')->whereIn('id',[1,4])->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Intervalos (negação - conjuntos)</p>";
    $cats = DB::table('categorias')->whereNotIn('id',[1,4])->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Consulta com Parametros Array</p>";
    $cats = DB::table('categorias')->where([
        ['id',1],
        ['nome','roupas']
    ])->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Ordenação crescente</p>";
    $cats = DB::table('categorias')->orderBy('nome')->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Ordenação decrescente</p>";
    $cats = DB::table('categorias')->orderBy('nome','desc')->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    echo "<p>Inserir</p>";
    $id = DB::table('categorias')->insertGetId(
        ['nome'=>'Carros']
        );
        echo "Novo id: $id <br>";
});

Route::get('/atualizandocategorias',function () {
    $cats = DB::table('categorias')->where('id',1)->first();
    echo "<p>Antes da atualização</p>";
    echo "id: " . $cats->id . "; ";
    echo "nome: " . $cats->nome . "<br>";

    DB::table('categorias')->where('id',1)->update(['nome'=>'Roupas Infantis']);

    $cats = DB::table('categorias')->where('id',1)->first();
    echo "<p>Depois da atualização</p>";
    echo "id: " . $cats->id . "; ";
    echo "nome: " . $cats->nome . "<br>";
});

Route::get('/removendocategorias',function () {
    $cats = DB::table('categorias')->get();
    echo "<p>Antes da atualização</p>";
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }

    DB::table('categorias')->whereNotIn('id',[2])->delete();

    echo "<br><p>Depois da atualização</p>";
    $cats = DB::table('categorias')->get();
    foreach($cats as $c){
        echo "id: " . $c->id . "; ";
        echo "nome: " . $c->nome . "<br>";
    }
});
