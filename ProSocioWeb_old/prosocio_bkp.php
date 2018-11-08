<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <title>Pro-Sócios Web</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="id" value="<?php echo $associados['matricula']; ?>" />
        <div id="logo">
            <div id="imgLogo"></div>
        </div>
        <div class="container">

            <fieldset class="fieldsetBusca">
                <legend>Informe os dados</legend>
                <div class="divRadioBusca">
                    <input  type="radio" name="tipoPesq" value="matricula" id="matricula">
                    <label  for="matricula">Matrícula</label>
                    <input  type="radio" name="tipoPesq" value="nome" id="nome">
                    <label  for="nome">Nome</label>
                </div>
                <input id="caixaTextoBusca" type="text" name="buscaMatricula"  autofocus required>
                <button id="botao" type="submit" name="submit"><i class="fa fa-search"></i></button>
            </fieldset>
            <?php
            include "ajudantes.php";
            include "consultaBanco.php";
            if (isset($_POST['submit'])){
                if (isset($_POST['tipoPesq']) && ($_POST['tipoPesq'] === 'matricula')) {
                    $associados = busca_socio($conexaoPdc, $_POST['buscaMatricula'],'M');
                }elseif (isset($_POST['tipoPesq']) && ($_POST['tipoPesq']) === 'nome'){
                    $associados = busca_socio($conexaoPdc, $_POST['buscaMatricula'],'N');
                }
                $mensalidades = busca_mensalidades($conexaoPdc, $_POST['buscaMatricula']);
            }else{
                echo "Aguardando";
            }
            ?>
            <fieldset class="fieldset">
                <legend>Dados do Associado</legend>
                    <div class="divLinha">
                        <img height="158px" width="118px" src="<?php echo "FotosSocios/" . $associado['cpf'] . ".jpg"; ?>">
                        <div class="divColuna">
                            <div class="divLinha">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                            </div>
                            <div class="divLinha">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                                <input type="text" class="caixaTexto">
                            </div>
                        </div>
                    </div>
                <input type="text" class="caixaTexto">
            </fieldset>
        </div>
    </form>
</body>
</html>