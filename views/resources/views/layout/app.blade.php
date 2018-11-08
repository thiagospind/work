<html>
    <head>
        <title>Meu título - @yield('titulo')</title>
    </head>
    <body>
        @section('barralateral')
            Esta parte da seção é do template pai
        @show
        <div>
            @yield('conteudo')
        </div>
    </body>
</html>
