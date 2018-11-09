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

Route::get('/remover/{id}',function($id){
    $cat = Categoria::find($id);
    if (isset($cat)) {
        $cat->delete();
        return redirect('/');
    } else {
        echo "<h1>Categoria não encontrada</h1>";
    }
});

Route::get('/categoriapornome/{nome}', function($nome){
    $cat = Categoria::where('nome',$nome)->get();
    foreach ($cat as $c){
        echo "ID: " . $c->id . " , ";
        echo "Nome: " . $c->nome . "<br>";
    }
});

Route::get('/categoriaidmaior/{id}', function($id){
    $cat = Categoria::where('id','>=',$id)->get();
    foreach ($cat as $c){
        echo "ID: " . $c->id . " , ";
        echo "Nome: " . $c->nome . "<br>";
    }

    $count = Categoria::where('id','>=',$id)->count();
    echo "<h1>Count: $count</h1>";
    $max = Categoria::where('id','>=',$id)->max('id');
    echo "<h1>Max id: $max</h1>";
});

Route::get('/ids123', function(){
    $cat = Categoria::find([1,2,3]);
    foreach ($cat as $c){
        echo "ID: " . $c->id . " , ";
        echo "Nome: " . $c->nome . "<br>";
    }
});

Route::get('/todas', function () {
    $categorias = Categoria::withTrashed()->get();
    foreach ($categorias as $c){
        echo "id: " . $c->id . " ";
        echo "nome: " . $c->nome;
        //Trashed retorna registro apagado com soft delete
        if ($c->trashed()){
            echo " (Apagado) ";
        }
        echo "<br>";
    }
});

Route::get('/ver/{id}',function($id){
    $cat = Categoria::withTrashed()->find($id);
    if (isset($cat)) {
        echo "id: " . $cat->id . " ";
        echo "nome: " . $cat->nome . "<br>";
    } else {
        echo "Categoria não encontrada";
    }
});

Route::get('/verwhere/{id}',function($id){
    $cat = Categoria::withTrashed()->where('id',$id)->get()->first();
    if (isset($cat)) {
        echo "id: " . $cat->id . " ";
        echo "nome: " . $cat->nome . "<br>";
    } else {
        echo "Categoria não encontrada";
    }
});

Route::get('/somenteapagadas',function(){
    $cat = Categoria::onlyTrashed()->get();
    foreach ($cat as $c){
        echo "id: " . $c->id . " ";
        echo "nome: " . $c->nome;
        //Retorna somente os apagados com soft delete
        if ($c->trashed()){
            echo " (Apagado) ";
        }
        echo "<br>";
    }
});

Route::get('/restaurar/{id}',function($id){
    $cat = Categoria::withTrashed()->find($id);
    if (isset($cat)) {
        $cat->restore();
        echo "Categoria restaurada: " . $cat->id . "<br>";
        echo "<a href=\"/\">Listar todas</a>";
    } else {
        echo "Categoria não encontrada";
    }
});

Route::get('/apagarpermanente/{id}',function($id){
    $cat = Categoria::withTrashed()->find($id);
    if (isset($cat)) {
        $cat->forceDelete();
        return redirect('/todas');
    } else {
        echo "Categoria não encontrada";
    }
});
