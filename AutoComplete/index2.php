<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste Autocomplete</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

</head>
<body>
    <form action="" method="post">
        <label>Input Teste:</label>
        <input type="text" id="caixaTexto" class="auto">
    </form>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $("#caixaTexto").autocomplete({
            minLength: 3,
            source: 'busca.php'
        });
    </script>
</body>
</html>
