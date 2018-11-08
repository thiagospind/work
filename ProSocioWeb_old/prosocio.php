<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <script type="text/javascript" language="JavaScript" src="javascript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
    <title>Pro-Sócios Web</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="id" value="<?php echo $associado['matricula']; ?>" />
        <div id="logo">
            <div id="imgLogo"></div>
        </div>
        <?php
            include "ajudantes.php";
            include "consultaBanco.php";
            //include "associados.php";

            $associado = array(
                'matricula' => (isset($_POST['matricula'])) ? $_POST['matricula'] : '',
                'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
                'situacao'  => (isset($_POST['situacao'])) ? $_POST['situacao'] : '',
                'dt_nascimento'  => (isset($_POST['dt_nascimento'])) ? $_POST['dt_nascimento'] : '',
                'sexo'  => (isset($_POST['sexo'])) ? traduz_sexo($_POST['sexo']) : '',
                'identidade' => (isset($_POST['identidade'])) ? $_POST['identidade'] : '',
                'org_exp'  => (isset($_POST['org_exp'])) ? $_POST['org_exp'] : '',
                'cpf'  => (isset($_POST['cpf'])) ? $_POST['cpf'] : '',
                'cart_prof' => (isset($_POST['cart_prof'])) ? $_POST['cart_prof'] : '',
                'profissao' => (isset($_POST['profissao'])) ? $_POST['profissao'] : '',
                'n_benef' => (isset($_POST['n_benef'])) ? $_POST['n_benef'] : '',
                'dt_admissao' => (isset($_POST['dt_admissao'])) ? $_POST['dt_admissao'] : '',
                'cep' => (isset($_POST['cep'])) ? $_POST['cep'] : '',
                'endereco' => (isset($_POST['endereco'])) ? $_POST['numend'] : '',
                'numend' => (isset($_POST['numend'])) ? $_POST['numend'] : '',
                'complend' => (isset($_POST['complend'])) ? $_POST['complend'] : '',
                'bairro' => (isset($_POST['bairro'])) ? $_POST['bairro'] : '',
                'cidade' => (isset($_POST['cidade'])) ? $_POST['cidade'] : '',
                'estado' => (isset($_POST['estado'])) ? $_POST['estado'] : '',
                'telefone' => (isset($_POST['telefone'])) ? $_POST['telefone'] : '',
                'telefone2' => (isset($_POST['telefone2'])) ? $_POST['telefone2'] : '',
                'plano_ext' => (isset($_POST['plano_ext'])) ? $_POST['plano_ext'] : '',
                'jornal' => (isset($_POST['jornal'])) ? $_POST['jornal'] : '',
                'descontado' => (isset($_POST['descontado'])) ? $_POST['descontado'] : ''
            );


        if (isset($_POST['submit'])){
            if (isset($_POST['tipoPesq']) && ($_POST['tipoPesq'] === 'matricula')) {
                $associados = busca_socios($conexaoPdc, $_POST['buscaMatricula'],'M');
            }elseif (isset($_POST['tipoPesq']) && ($_POST['tipoPesq']) === 'nome'){
                $associados = busca_socios($conexaoPdc, $_POST['buscaMatricula'],'N');
            }
            $mensalidades = busca_mensalidades($conexaoPdc, $_POST['buscaMatricula']);
            $dependentes = busca_dependentes($conexaoPdc,$_POST['buscaMatricula']);
        }else{
            /*echo "Aguardando";*/
        }

        ?>
        <div class="container">
            <div class="divAssociados">
                <fieldset class="fieldsetBusca">
                    <legend>Informe os dados</legend>
                    <div class="divRadioBusca">
                        <input  type="radio" name="tipoPesq" value="matricula" id="matricula" onclick="getRadioValor()">
                        <label  for="matricula">Matrícula</label>
                        <input  type="radio" name="tipoPesq" value="nome" id="nome" onclick="getRadioValor()">
                        <label  for="nome">Nome</label>
                    </div>
                    <input id="caixaTextoBusca" type="text" name="buscaMatricula"  autofocus required placeholder="Selecione uma opção..." maxlength="80">
                    <button id="botao" type="submit" name="submit"><i class="fa fa-search"></i></button>
                </fieldset>
                <?php
                if (isset($associados)) {
                foreach ($associados as $associado) {
                    $base =
                        //dirname($_SERVER['PHP_SELF']);
                        //dirname(dirname($path));
                    $destino = "C:\\Fotos\\teste\\05391679753.jpg";
                        //"\\ProSocioWeb\\FotosSocios\\" . $associado['cpf'] . ".jpg";
                    if (!verificaArquivo($destino)){
                        $origem = "\\\\srvdata\\FotosSocios\\" . $associado['cpf'] . ".jpg";
                        copiaArquivo($origem,$destino);
                    }

                ?>
                <!--
                <fieldset class="fieldset">
                    <legend>Dados do Associado</legend>
                -->
                <button class="collapsible" type="button">&nbsp;Dados do Associado</button>
                    <div class="content">

                        <div class="divLinha">
                            <div class="fotoSocio">
                                <?php //$handle = fopen("\\\\srvdata\\FotosSocios\\".$associado['cpf']. ".jpg",'r')
                                    $filename = "file://srvdata/FotosSocios/" . $associado['cpf'] . ".jpg";
                                    //$handle = fopen($filename, "rb");
                                    //$data = file_get_contents($filename,FILE_BINARY);
                                    //$contents = fread($handle, filesize($filename));
                                    //fclose($handle);

                                    //header("content-type: image/jpeg");

                                    //echo $contents;
                                ?>
                                <img height="158px" width="118px" src="<?php echo "../../../../srvdata/FotosSocios/" . $associado['cpf'] . ".jpg"; ?>">

                            </div>
                            <div class="divColuna">
                                <div class="divLinha">
                                    <div class="divColuna40">
                                        <label class="label">Nome</label>
                                        <input class="caixaTexto" readonly name="nome"
                                               value="<?php echo $associado['nome']; ?>">
                                    </div>
                                    <div class="divColuna20">
                                        <label class="label">Matrícula</label>
                                        <input class="caixaTexto" readonly name="matricula"
                                               value="<?php echo $associado['matricula']; ?>">
                                    </div>
                                    <div class="divColuna20">
                                        <label class="label">Data Nascimento</label>
                                        <input class="caixaTexto" readonly name="dt_nascimento"
                                               value="<?php echo traduz_data_para_exibir($associado['dt_nascimento']); ?>">
                                    </div>
                                    <div class="divColuna20">
                                        <label class="label">Telefone</label>
                                        <input class="caixaTexto" readonly name="telefone"
                                               value="<?php echo mask($associado['telefone'], '(##) ####-####'); ?>">
                                    </div>
                                    <div class="divColuna20">
                                        <label class="label">Celular</label>
                                        <input class="caixaTexto" readonly name="telefone2"
                                               value="<?php echo mask($associado['telefone2'], '(##) #####-####'); ?>">
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
                                        <label class="label">Número Benefício</label>
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
                                <input class="caixaTexto" readonly name="endereco"
                                       value="<?php echo $associado['endereco']; ?>">
                            </div>
                        </div>
                        <div class="divLinha">
                            <div class="divColuna20">
                                <label class="label">Número</label>
                                <input class="caixaTexto" readonly name="numend"
                                       value="<?php echo $associado['numend']; ?>">
                            </div>
                            <div class="divColuna40">
                                <label class="label">Bairro</label>
                                <input class="caixaTexto" readonly name="bairro"
                                       value="<?php echo $associado['bairro']; ?>">
                            </div>
                            <div class="divColuna40">
                                <label class="label">Complemento</label>
                                <input class="caixaTexto" readonly name="complend"
                                       value="<?php echo $associado['complend']; ?>">
                            </div>
                        </div>
                        <div class="divLinha">
                            <div class="divColuna20">
                                <label class="label">CEP</label>
                                <input class="caixaTexto" readonly name="cep"
                                       value="<?php echo mask($associado['cep'], '##.###-###'); ?>">
                            </div>
                            <div class="divColuna40">
                                <label class="label">Cidade</label>
                                <input class="caixaTexto" readonly name="cidade"
                                       value="<?php echo $associado['cidade']; ?>">
                            </div>
                            <div class="divColuna40">
                                <label class="label">Estado</label>
                                <input class="caixaTexto" readonly name="estado"
                                       value="<?php echo $associado['estado']; ?>">
                            </div>
                        </div>
                        <div class="divLinha">
                            <div class="divColuna25">
                                <label class="label">Situação</label>
                                <input class="caixaTexto" readonly name="situacao" width="50px"
                                       value="<?php echo strtoupper($associado['situacao']); ?>">
                            </div>
                            <div class="divColuna25">
                                <label class="label">Plano de Saúde</label>
                                <input class="caixaTexto" readonly name="plano_ext"
                                       value="<?php echo $associado['plano_ext']; ?>">
                            </div>
                            <div class="divColuna25">
                                <label class="label">Recebe Jornal?</label>
                                <input class="caixaTexto" readonly name="Jornal"
                                       value="<?php echo traduz_sim_nao($associado['jornal']); ?>">
                            </div>
                            <div class="divColuna25">
                                <label class="label">Forma de Pagamento</label>
                                <input class="caixaTexto" readonly name="descontado"
                                       value="<?php echo $associado['descontado']; ?>">
                            </div>
                        </div>
                        <?php
                        }
                        }
                        ?>
                    </div>

                    <?php if (isset($dependentes)) {

                        ?>
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
                                        <label class="label">Data Nascimento</label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="label">Data Admissão</label>
                                    </div>
                                    <div class="divColuna15">
                                        <label class="label">Identidade</label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="label">CPF</label>
                                    </div>
                                    <div class="divColuna5">
                                        <label class="label">Sexo</label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="label">Plano Externo</label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="label">Universitário</label>
                                    </div>
                                </div>

                                <?php foreach ($dependentes as $dependente) {
                                ?>
                                <div class="divLinhaDep">
                                    <div class="divColuna20">
                                        <label class="labelMensalidade"><?php echo $dependente['nome_dep'] ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo $dependente['grau_dep'] ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo traduz_data_para_exibir($dependente['dt_nasci']) ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo traduz_data_para_exibir($dependente['dt_admiss']) ?></label>
                                    </div>
                                    <div class="divColuna15">
                                        <label class="labelMensalidade"><?php echo $dependente['rg_dep'] ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo mask($dependente['cpf_dep'],'###.###.###-##') ?></label>
                                    </div>
                                    <div class="divColuna5">
                                        <label class="labelMensalidade"><?php echo traduz_sexo($dependente['sexodep']) ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo $dependente['plano_ext'] ?></label>
                                    </div>
                                    <div class="divColuna10">
                                        <label class="labelMensalidade"><?php echo traduz_sim_nao($dependente['universitario']) ?></label>
                                    </div>
                                </div>
                                <?php
                                    }
                                }?>
                            </div>
                        </div>
                    <?php
                        if (isset($mensalidades)){
                    ?>

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
                        foreach ($mensalidades as $mensalidade){
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
                        ?>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
        <script type="text/javascript" src="scripts/jscript.js"></script>
    </form>
</body>
</html>