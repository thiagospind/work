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

use Illuminate\Http\Request;

Route::get('/', function () {
    //return view('welcome');
    return "<h1>Laravel</h1>";
});

Route::get('/olas', function (){
   return "<h1>Seja bem vindo</h1>";
});

Route::get('/ola/sejabemvindo', function (){
    return view('welcome');
});

Route::get('/nome/{nome}/{sobrenome}', function($nome, $sn){
    return "<h1>Ola, $nome $sn!</h1>";
});

Route::get('/repetir/{nome}/{n}', function($nome, $n){
    if (is_integer($n)) {
        for ($i = 0; $i < $n; $i++) {
            echo "<h1>Ola, $nome!</h1>";
        }
    } else {
        echo "Você não digitou um inteiro!";
    }
});

Route::get('/seunomecomregra/{nome}/{n}', function($nome, $n){
    for ($i = 0; $i < $n; $i++) {
        echo "<h1>Ola, $nome! ($i)</h1>";
    }
})->where('n','[0-9]+')->where('nome','[A-Za-z]+');

Route::get('/seunomesemregra/{nome?}', function($nome=null){
    if (isset($nome)) {
        echo "<h1>Ola, $nome!</h1>";
    } else {
        echo "Você não passou nenhum nome!";
    }
});

Route::prefix('app')->group(function(){
    Route::get("/",function(){
        return "Página principal do APP";
    });
    Route::get("/profile",function(){
        return "Página Profile";
    });
    Route::get("/about",function(){
        return "Página About";
    });
});

Route::redirect('/aqui', '/olas', 301);

Route::view('/hello','hello');

Route::view('/hellonome','hellonome',
    ['nome'=>'Thiago','sobrenome'=>'Spindola']);

Route::get('/hellonome/{nome}/{sobrenome}', function($nome,$sn){
    return view('hellonome',['nome'=>$nome,
        'sobrenome'=>$sn]);
});

Route::get('/rest/hello',function(){
    return "Hello (Get)";
});

Route::post('/rest/hello',function(){
    return "Hello (Post)";
});

Route::delete('/rest/hello',function (){
    return "Hello (Delete)";
});

Route::put('/rest/hello',function (){
    return "Hello (Put)";
});

Route::patch('/rest/hello',function (){
    return "Hello (Patch)";
});

Route::options('/rest/hello',function (){
    return "Hello (Options)";
});

Route::post('/rest/imprimir',function(Request $req){
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade anos)!";
});

Route::match(['get','post'],'/rest/hello2',function (){
    return "Hello World 2";
});

Route::any('/rest/hello3',function (){
    return "Hello World 3";
});

Route::get('/produtos',function (){
    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li>Notebook</li>";
    echo "<li>Impressora</li>";
    echo "<li>Mouse</li>";
    echo "</ol>";
})->name('meusprodutos');

Route::get('/linkprodutos',function (){
    $url = route('meusprodutos');
    echo "<a href=\"".$url."\">Meus produtos</a>";
});

Route::get("/redirecionarprodutos",function (){
    return redirect()->route('meusprodutos');
});
