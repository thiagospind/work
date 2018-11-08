<html>
<head>
    <link href="{{URL::to('css/app.css')}}" rel="stylesheet">
</head>
<body>
    @if(isset($produtos))
        @if(count($produtos)==0)
            <h1>Nenhum produto</h1>
        @elseif(count($produtos)===1)
            <h1>Um produto</h1>
        @else
            <h1>Vários produtos</h1>
        @endif

        @foreach($produtos as $p)
            <p>Produto: {{$p}}</p>
        @endforeach

    @else
        <h1>Variável produtos não foi passado como parâmetro!</h1>
    @endif

    @empty($produtos)
        <h2>Nada em produtos!</h2>
    @endempty
    <script src="{{URL::to('js/app.js')}}" type="text/javascript"></script>
</body>
</html>
