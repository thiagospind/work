<?php
    include_once 'ajudantes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script type="text/javascript" language="JavaScript" src="javascript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="javascript/popper.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="javascript/bootstrap.min.js"></script>
    <title>Consulta de Valores de Mensalidade e Procedimentos</title>
    <link rel="icon" type="image/png" href="img/icone_aapvr.png"/>
</head>
<body>
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
                           <span class="navbar-text">Bem vindo!</span>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item float-right">
                        <a class="nav-link" href="<?php echo 'logout.php?token='.md5(session_id()); ?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <?php
            if (isset($_POST['buscaSede'])){
                include_once 'buscaDados.php';

                $mensSede = buscaMensSede($_POST['datainicio'],$_POST['datafim']);
                $mensCBS = buscaMensCBS($_POST['datainicio'],$_POST['datafim']);
                $mensOdonto = buscaMensOdonto($_POST['datainicio'],$_POST['datafim']);
                $mensCPSI = buscaMensCPSI($_POST['datainicio'],$_POST['datafim']);
                $mensSC = buscaMensScruz($_POST['datainicio'],$_POST['datafim']);
                $mensPinheiral = buscaMensPinheiral($_POST['datainicio'],$_POST['datafim']);
                $mensBP = buscaMensBP($_POST['datainicio'],$_POST['datafim']);
            } elseif (isset($_POST['buscaProc'])) {
                include_once 'buscaDados.php';

                $procCBS = buscaProcedCBS($_POST['datainicioProc'],$_POST['datafimProc']);
            }
        ?>
        <div class="align-items-center">
            <div class="card">
                <div class="card-body w-100">
                    <h5 class="card-title">Relação de Pagamentos de Mensalidades e Procedimentos</h5>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <?php
                            echo "<a class=\"nav-link " . (isset($_POST['buscaSede']) ? 'active' : '') . "\"  data-toggle=\"tab\" href=\"#mensalidade\" >MENSALIDADES</a>";

                            //echo "<input class=\"caixaTexto\" " . ($_SESSION['nivel']  == 'ADMINISTRADOR' ? '' : 'readonly') . " name=\"complend\" id=\"complend\" value=\" " . strtoupper($associado['complend']) . "\" >";
                            ?>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link ?php echo isset($_POST['buscaProc']) ? 'active' : ''; ?>" data-toggle="tab" href="#procedimento">PROCEDIMENTOS</a> -->
                            <?php
                            echo "<a class=\"nav-link " . (isset($_POST['buscaProc']) ? 'active' : '') . "\"  data-toggle=\"tab\" href=\"#procedimento\" >PROCEDIMENTOS</a>";
                            ?>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="mensalidade" class="tab-pane">
                            <div class="container-fluid">
                                <div id="accordion">
                                    <div class="container-fluid mt-3 mx-auto">
                                        <div class="form-group">
                                            <div class="row">
                                                <span class="h6" for="datainicio">Informe o Período</span>
                                            </div>
                                            <div class="row">
                                                <input class="form-control col-2 mr-1" type="date" name="datainicio" min="2010-01-01">
                                                <input class="form-control col-2 mr-1" type="date" name="datafim">
                                                <input type="submit" class="btn btn-outline-primary" id="buscaSede" name="buscaSede" value="Pesquisar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#sede">
                                                SEDE
                                            </a>
                                        </div>
                                        <div id="sede" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                        if(isset($mensSede) && count($mensSede) > 0) {
                                                            foreach ($mensSede as $mensalidade) {?>
                                                                <div class="rowZebra">
                                                                    <div class="col">
                                                                        <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo $mensalidade['terminal']; ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <!--
                                                                    <div class="col">
                                                                        <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                    </div>
                                                                    -->
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#cbs">
                                                CBS
                                            </a>
                                        </div>
                                        <div id="cbs" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensCBS) && count($mensCBS) > 0) {
                                                        foreach ($mensCBS as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#odonto">
                                                CENTRO ODONTOLÓGICO
                                            </a>
                                        </div>
                                        <div id="odonto" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensOdonto) && count($mensOdonto) > 0) {
                                                        foreach ($mensOdonto as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#cpsi">
                                                CPSI - CENTRO DE PREVENÇÃO À SAÚDE DO IDOSO
                                            </a>
                                        </div>
                                        <div id="cpsi" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensCPSI) && count($mensCPSI) > 0) {
                                                        foreach ($mensCPSI as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#scruz">
                                                SANTA CRUZ
                                            </a>
                                        </div>
                                        <div id="scruz" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensSC) && count($mensSC) > 0) {
                                                        foreach ($mensSC as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#pinheiral">
                                                PINHEIRAL
                                            </a>
                                        </div>
                                        <div id="pinheiral" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensPinheiral) && count($mensPinheiral) > 0) {
                                                        foreach ($mensPinheiral as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#bp">
                                                BARRA DO PIRAÍ
                                            </a>
                                        </div>
                                        <div id="bp" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Data</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Terminal</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Caixa Inicial</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Mensalidades</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Dinheiro</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cheque</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Cartão</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Diferença</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Total</label>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    if(isset($mensBP) && count($mensBP) > 0) {
                                                        foreach ($mensBP as $mensalidade) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo traduz_data_para_exibir($mensalidade['data']); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo $mensalidade['terminal']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['caixa_inicial'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['mensalidades'],2,',','.'); ?></label>
                                                                </div>
                                                                <!--
                                                                <div class="col">
                                                                    <label><php echo $mensalidade['procedimentos']; ?></label>
                                                                </div>
                                                                -->
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['dinheiro'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cheque'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['cartao'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['diferenca'],2,',','.'); ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($mensalidade['total'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="procedimento" class="tab-pane">
                            <div class="container-fluid">
                                <div id="accordion">
                                    <div class="container-fluid mt-3 mx-auto">
                                        <div class="form-group">
                                            <div class="row">
                                                <span class="h6" >Informe o Período</span>
                                            </div>
                                            <div class="row">
                                                <input class="form-control col-2 mr-1" type="date" name="datainicioProc" min="2010-01-01">
                                                <input class="form-control col-2 mr-1" type="date" name="datafimProc">
                                                <input type="submit" class="btn btn-outline-primary" id="buscaProc" name="buscaProc" value="Pesquisar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#cbs">
                                                CBS
                                            </a>
                                        </div>
                                        <div id="cbs" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <div class="row h6">
                                                        <div class="col">
                                                            <label>Procedimento</label>
                                                        </div>
                                                        <div class="col">
                                                            <label>Valor</label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if(isset($procCBS) && count($procCBS) > 0) {
                                                        foreach ($procCBS as $procedimento) {?>
                                                            <div class="rowZebra">
                                                                <div class="col">
                                                                    <label><?php echo $procedimento['descricao']; ?></label>
                                                                </div>
                                                                <div class="col">
                                                                    <label><?php echo 'R$ ' . number_format($procedimento['valor'],2,',','.'); ?></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 28/08/2018
 * Time: 17:12
 */