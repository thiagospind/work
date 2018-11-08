<?php
    //session_start();
    include 'verificaSessao.php';
    if (!isset($_SESSION['login'])){
        session_destroy();
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" name="viewport">
    <script type="text/javascript" language="JavaScript" src="javascript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" language="JavaScript" src="javascript/jquery-ui.min.js"></script> -->
    <script type="text/javascript" language="JavaScript" src="jquery-validation-1.17.0/dist/jquery.validate.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css" type="text/css">
    <link rel="icon" type="image/png" href="img/icone_aapvr.png"/>
    <title>Pro-Sócios Web</title>
</head>
<body style="background-color: #f7f9fb">

        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #002a4d">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="img/icone_aapvr.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSite">
                    <ul class="navbar-nav">
                       <span class="navbar-text">
                            <?php echo "Bem vindo <b>" . $_SESSION['nome'] . "</b>!"?>
                        </span>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item float-right">
                            <a class="nav-link" href="<?php echo 'logout.php?token='.md5(session_id()); ?>">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

        <?php
            if (!isset($_SESSION['nivel'])){
                $_SESSION['nivel'] = '';
            }
            include_once "ajudantes.php";
            include_once "conexao.php";
            include_once "consultaBanco.php";
            //include "alteraSocio.php";

        if (isset($_POST['busca'])){
            //if (isset($_POST['tipoPesq']) && ($_POST['tipoPesq'] === 'matricula')) {
            $conexaoPdc = conecta('aapvr');
            $associados = busca_socios($conexaoPdc, $_POST['buscaMatricula'],'M');
            $dependentes = busca_dependentes($conexaoPdc, $_POST['buscaMatricula']);
            $excluidos = busca_socios_exc($conexaoPdc,$_POST['buscaMatricula']);
            $tiposdescontos = busca_tipo_desconto($conexaoPdc);
            if (!isset($associados) || (count($associados) <= 0)){
                $mensalidades = busca_mensalidades_exc($conexaoPdc, $_POST['buscaMatricula']);
            }else {
                $mensalidades = busca_mensalidades($conexaoPdc, $_POST['buscaMatricula']);
            }
        }elseif (isset($_POST['salvar'])){
            include_once "alteraSocio.php";
            /*echo "Aguardando";*/
        }else{

        }

        ?>

        <div class="container justify-content-md-center mt-2">
            <div class="card w-auto">
                <div class="card-body">
                    <div class="row justify-content-md-center">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                            <fieldset class="form-group">
                                <div class="mx-auto">
                                    <legend></legend>
                                        <input id="caixaTextoBusca" type="text" name="buscaMatricula"  autofocus required placeholder="Digite o nome ou a matrícula..." maxlength="80">
                                        <button id="botao" type="submit" name="busca"><i class="fa fa-search"></i></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <?php
                    if ((!isset($associados) || (count($associados) == 0 )) && ($sn_buscou =='S') && (!isset($excluidos) || (count($excluidos) == 0) )) {
                        echo '<script>alert("Associado(s) não encontrado(s)!")</script>';
                        die();
                    } elseif (isset($associados) && (count($associados) > 0)) {
                        foreach ($associados as $associado) {
                            $destino = realpath((dirname($_SERVER['SCRIPT_FILENAME']))) . "\\FotosSocios\\" . $associado['cpf'] . ".jpg";
                            if (!verificaArquivo($destino)) {
                                $origem = "\\\\srvdata\\FotosSocios\\" . $associado['cpf'] . ".jpg";
                                copiaArquivo($origem, $destino);
                            }
                        }
                    }
                    ?>
                    <!-- ?php if ((isset($associados) && (count($associados) > 0)) || (isset($excluidos) && (count($excluidos) > 0))) { ?> -->
                    <?php
                    /*if ( isset($associados) && (count($associados) > 0) ){
                        foreach ($associados as $associado) { */?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="formAssociados">
                            <button class="collapsible" type="button">&nbsp;Dados do Associado</button>

                                <div class="content" style="overflow-y: auto">
                                    <div class="divLinha">
                                        <div>
                                            <img class="fotoSocio" height="158px" width="118px"
                                                 src="<?php echo "/ProSocioWeb/FotosSocios/" . $associado['cpf'] . ".jpg"; ?>">
                                        </div>
                                            <div class="divColuna">
                                                <div class="divLinha">
                                                    <div class="divColuna40">
                                                        <label class="label" for="nome">Nome</label>
                                                        <input class="caixaTexto" readonly name="nome"
                                                               value="<?php echo $associado['nome']; ?>">
                                                    </div>
                                                    <div class="divColuna20">
                                                        <label class="label">Matrícula</label>
                                                        <input class="caixaTexto" readonly name="matricula"
                                                               value="<?php echo $associado['matricula']; ?>">
                                                    </div>
                                                    <div class="divColuna20">
                                                        <label class="label">Dt. Nascimento</label>
                                                        <input class="caixaTexto" readonly name="dt_nascimento"
                                                               value="<?php echo traduz_data_para_exibir($associado['dt_nascimento']); ?>">
                                                    </div>
                                                    <div class="divColuna20">
                                                        <label class="label">Telefone</label>
                                                        <?php echo "<input class=\"caixaTexto\"". ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . "name=\"telefone\" value=\"" . mask($associado['telefone'], '(##) ####-####') . "\" >"; ?>
                                                    </div>
                                                    <div class="divColuna20">
                                                        <label class="label">Celular</label>
                                                        <?php echo "<input class=\"caixaTexto\"" . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"telefone2\" value=\"" . mask($associado['telefone2'], '(##) #####-####') ."\" required>"; ?>
                                                    </div>
                                                </div>
                                                <div class="divLinha">
                                                    <div class="divColuna30">
                                                        <label class="label">RG / Org. Expedidor</label>
                                                        <input class="caixaTexto" readonly name="identidade"
                                                               value="<?php echo $associado['identidade'] . '/' . $associado['org_exp']; ?>">
                                                    </div>
                                                    <div class="divColuna30">
                                                        <label class="label">CPF</label>
                                                        <input class="caixaTexto" readonly name="cpf"
                                                               value="<?php echo mask($associado['cpf'], '###.###.###-##'); ?>">
                                                    </div>
                                                    <div class="divColuna30">
                                                        <label class="label">Sexo</label>
                                                        <input class="caixaTexto" readonly name="sexo"
                                                               value="<?php echo traduz_sexo($associado['sexo']); ?>">
                                                    </div>
                                                    <div class="divColuna30">
                                                        <label class="label" for="n_benef">Número Benefício</label>
                                                        <input class="caixaTexto" readonly name="n_benef"
                                                               value="<?php echo mask($associado['n_benef'], '##/###.###.###-#'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="divLinha">
                                            <div class="divColuna20">
                                                <label class="label">Carteira Profissional</label>
                                                <input class="caixaTexto" readonly name="cart_prof"
                                                       value="<?php echo $associado['cart_prof']; ?>">
                                            </div>
                                            <div class="divColuna30">
                                                <label class="label">Profissão</label>
                                                <input class="caixaTexto" readonly name="profissao"
                                                       value="<?php echo $associado['profissao']; ?>">
                                            </div>
                                            <div class="divColuna50">
                                                <label class="label">Endereço</label>
                                                <input class="caixaTexto" readonly name="endereco" id="endereco"
                                                       value="<?php echo $associado['endereco']; ?>">
                                            </div>
                                        </div>
                                        <div class="divLinha">
                                            <div class="divColuna20">
                                                <label class="label" for="cep">CEP</label>
                                                <?php
                                                    echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"cep\" id=\"cep\" value=\" " . mask($associado['cep'], '##.###-###') . "\" >";
                                                ?>
                                            </div>
                                            <div class="divColuna40">
                                                <label class="label">Bairro</label>
                                                <input class="caixaTexto" readonly name="bairro" id="bairro"
                                                       value="<?php echo strtoupper($associado['bairro']); ?>">
                                            </div>
                                            <div class="divColuna40">
                                                <label class="label">Complemento</label>
                                                <?php
                                                    echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel']  == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"complend\" id=\"complend\" value=\" " . strtoupper($associado['complend']) . "\" >";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="divLinha">
                                            <div class="divColuna20">
                                                <label class="label">Número</label>
                                                <?php
                                                    echo "<input type=\"number\" class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . "name=\"numend\" id=\"numend\"  value=\" " . $associado['numend'] . "\" required>";
                                                ?>

                                            </div>
                                            <div class="divColuna40">
                                                <label class="label">Cidade</label>
                                                <input class="caixaTexto" readonly name="cidade" id="cidade"
                                                       value="<?php echo $associado['cidade']; ?>">
                                            </div>
                                            <div class="divColuna40">
                                                <label class="label">Estado</label>
                                                <input class="caixaTexto" readonly name="estado" id="estado"
                                                       value="<?php echo $associado['estado']; ?>">
                                            </div>
                                        </div>
                                        <div class="divLinha">
                                            <div class="divColuna20">
                                                <label class="label">Situação</label>
                                                <input class="caixaTexto" readonly name="situacao" width="50px"
                                                       value="<?php echo strtoupper($associado['situacao']); ?>">
                                            </div>
                                            <div class="divColuna20">
                                                <label class="label">Plano de Saúde</label>
                                                <input class="caixaTexto" readonly name="plano_ext"
                                                       value="<?php echo $associado['plano_ext']; ?>">
                                            </div>
                                            <div class="divColuna20">
                                                <label class="label">Recebe Jornal?</label>
                                                <input class="caixaTexto" readonly name="Jornal"
                                                       value="<?php echo traduz_sim_nao($associado['jornal']); ?>">
                                            </div>
                                            <div class="divColuna40">
                                                <label class="label">Email</label>
                                                <?php
                                                    echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"email\" value=\" ". $associado['email'] . "\" >";
                                                ?>

                                            </div>

                                        </div>
                                    <?php /*if ($associado['descontado'] == 'BB' || $associado['descontado'] == 'ITAU' || $associado['descontado'] == 'CEF'):*/ ?>
                                    <div class="divLinha">
                                        <div class="divColuna25">
                                            <label class="label">Forma de Pagamento</label>
                                            <!--
                                            <input class="caixaTexto" readonly name="descontado"
                                                   value=" ?php echo $associado['descontado']; ?>">
                                            -->
                                            <select class="form-control form-control-sm" name="forma_desconto">
                                                <?php
                                                foreach($tiposdescontos as $tipos):
                                                    echo "<option value=" . $tipos['descr_fdesc'] . " " . ($tipos['descr_fdesc'] == $associado['descontado'] ? 'selected' : ''). ">" . $tipos['descr_fdesc'] . "</option>";
                                                endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="divColuna30">
                                            <label class="label">Agência</label>
                                            <?php
                                                echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"agencia\" value=\" " . $associado['agencia'] . "\" >";
                                            ?>
                                            <span class="error"><?php echo $arrayErro['erroAgencia'];?></span>
                                        </div>
                                        <div class="divColuna30">
                                            <label class="label">Conta</label>
                                            <?php
                                            echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"conta\" value=\" " . $associado['conta'] . "\" >";
                                            ?>
                                            <span class="error"><?php echo $arrayErro['erroConta'];?></span>
                                        </div>
                                        <div class="divColuna15">
                                            <label class="label">DV</label>
                                            <?php
                                            echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel'] == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"dv\" value=\" " . $associado['dv'] . "\" >";
                                            ?>
                                            <span class="error"><?php echo $arrayErro['erroDv'];?></span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button  type="submit" class="btn btn-outline-primary" name="salvar"> Salvar</button>
                                        <button type="submit" class="btn btn-outline-primary" formaction="excluiSocio.php" name="excluir"> Excluir</button>
                                        <br><br>
                                    </div>
                                    <?php /* endif; */ ?>

                                </div>
                            </form>
                        <?php
                            //}
                        //}?>

                        <?php
                        /* */?>
                            <button class="collapsible" type="button">&nbsp;Dependentes</button>
                            <div class="content">
                                <div class="scroll">
                                    <div class="divLinhaDepTitulo">
                                        <div class="divColuna20">
                                            <label class="label">Nome</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Grau</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Dt Nascimento</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Dt Admissão</label>
                                        </div>
                                        <div class="divColuna15">
                                            <label class="label">Identidade</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">CPF</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Sexo</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Plano Externo</label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="label">Universitário</label>
                                        </div>
                                    </div>

                                    <?php
                                    if((isset($dependentes)) && (count($dependentes))){
                                    foreach ($dependentes as $dependente) {?>
                                    <div class="divLinhaDep">
                                        <div class="divColuna20">
                                            <label class="labelMensalidade"><?php echo $dependente['nome_dep']; ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo $dependente['grau_dep']; ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo traduz_data_para_exibir($dependente['dt_nasci']); ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo traduz_data_para_exibir($dependente['dt_admiss']); ?></label>
                                        </div>
                                        <div class="divColuna15">
                                            <label class="labelMensalidade"><?php echo $dependente['rg_dep']; ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo mask($dependente['cpf_dep'],'###.###.###-##'); ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo traduz_sexo($dependente['sexodep']); ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo $dependente['plano_ext']; ?></label>
                                        </div>
                                        <div class="divColuna10">
                                            <label class="labelMensalidade"><?php echo traduz_sim_nao($dependente['universitario']); ?></label>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }?>
                            </div>
                        </div>
                    <!-- ?php if (isset($mensalidades) && count($mensalidades) > 0){ ?> -->

                        <button class="collapsible" type="button">&nbsp;Mensalidade</button>
                        <div class="content">

                            <div class="divLinhaMensTitulo">
                                <div class="divColuna15Mens">
                                    <label class="label">Data Pagamento</label>
                                </div>
                                <div class="divColuna15Mens">
                                    <label class="label">Mês Quite</label>
                                </div>
                                <div class="divColuna15Mens">
                                    <label class="label">Pagamentos</label>
                                </div>
                                <div class="divColuna15Mens">
                                    <label class="label">Valor</label>
                                </div>
                                <div class="divColuna40Mens">
                                    <label class="label">Terminal</label>
                                </div>
                            </div>

                            <?php
                                if ((isset($mensalidades)) && count($mensalidades)){
                                    foreach ($mensalidades as $mensalidade) {
                                ?>
                                <div class="divLinhaMens">
                                    <div class="divColuna15Mens">
                                        <label class="labelMensalidade"><?php echo traduz_data_para_exibir($mensalidade['DT_PAGA']); ?></label>
                                    </div>
                                    <div class="divColuna15Mens">
                                        <label class="labelMensalidade"><?php echo traduz_data_para_exibir($mensalidade['MES_QUITE']); ?></label>
                                    </div>
                                    <div class="divColuna15Mens">
                                        <label class="labelMensalidade"><?php echo $mensalidade['NUM_PAGO']; ?></label>
                                    </div>
                                    <div class="divColuna15Mens">
                                        <label class="labelMensalidade"><?php echo 'R$ ' . number_format($mensalidade['VALOR'], 2, ',', '.'); ?></label>
                                    </div>
                                    <div class="divColuna40Mens">
                                        <label class="labelMensalidade"><?php echo $mensalidade['TERMINAL']; ?></label>
                                    </div>

                                </div>
                                <?php
                                }
                            }
                                ?>
                            </div>
                                <!-- ?php if(isset($excluidos) && count($excluidos) > 0) { ?> -->
                                <button class="collapsible" type="button">&nbsp;Excluídos</button>
                                <div class="content">
                                    <div class="scroll">
                                        <div class="divLinhaExcTitulo">
                                            <div class="divColuna15">
                                                <label class="label">Nome</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Dt. Nascimento</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">RG / Org. Expedidor</label>
                                            </div>
                                            <div class="divColuna5">
                                                <label class="label">CPF</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Nº Benefício</label>
                                            </div>
                                            <div class="divColuna5">
                                                <label class="label">Situação</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Motivo Exclusão</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Dt. Exclusão</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Dt. Falecimento</label>
                                            </div>
                                            <div class="divColuna5">
                                                <label class="label">Sexo</label>
                                            </div>
                                            <div class="divColuna10">
                                                <label class="label">Grau Parentesco</label>
                                            </div>
                                        </div>

                                        <?php
                                        if (isset($excluidos) && count($excluidos)){
                                            foreach ($excluidos as $excluido) {
                                        ?>
                                            <div class="divLinhaExc">
                                                <div class="divColuna15">
                                                    <label class="labelMensalidade"><?php echo $excluido['nome']; ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo traduz_data_para_exibir($excluido['dt_nascimento']); ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo $excluido['identidade'] . '/' . $excluido['org_exp']; ?></label>
                                                </div>
                                                <div class="divColuna5">
                                                    <label class="labelMensalidade"><?php echo mask($excluido['cpf'], '###.###.###-##'); ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo mask($excluido['n_benef'],'##/###.###.###-#'); ?></label>
                                                </div>
                                                <div class="divColuna5">
                                                    <label class="labelMensalidade"><?php echo $excluido['situacao']; ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo traduz_motivo_exclusao($excluido['motivo_exc']); ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo traduz_data_para_exibir($excluido['excluido']); ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo traduz_data_para_exibir($excluido['falecido']); ?></label>
                                                </div>
                                                <div class="divColuna5">
                                                    <label class="labelMensalidade"><?php echo traduz_sexo($excluido['sexo']); ?></label>
                                                </div>
                                                <div class="divColuna10">
                                                    <label class="labelMensalidade"><?php echo $excluido['grau_parent']; ?></label>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>

                        <?php
                        $sn_buscou = "";
                        unset($associado);
                        ?>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="scripts/jscript.js"></script>
    <!-- <script type="text/javascript" src="scripts/buscaCEP.js"></script>
    <script>$("#formAssociados").validate();</script> -->
</body>
</html>