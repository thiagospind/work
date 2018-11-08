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

use App\Categoria;

Route::get('/', function () {
    $categorias = Categoria::all();
    foreach ($categorias as $c){
        echo "id: " . $c->id . " ";
        echo "nome: " . $c->nome . "<br>";
    }
});

Route::get('/inserir/{nome}',function($nome){
    $cat = new Categoria();
    $cat->nome = $nome;
    $cat->save();
    return redirect('/');
});

Route::get('/categoria/{id}',function($id){
    $cat = Categoria::find($id);
    if (isset($cat)) {
        echo "id: " . $cat->id . " ";
        echo "nome: " . $cat->nome . "<br>";
    } else {
        echo "Categoria não encontrada";
    }
});

Route::get('/atualizar/{id}/{nome}',function($id,$nome){
    $cat = Categoria::find($id);
    if (isset($cat)) {
        $cat->nome = $nome;
        $cat->save();
        return redirect('/');
    } else {
        echo "<h1>Categoria não encontrada</h1>";
    }
});
