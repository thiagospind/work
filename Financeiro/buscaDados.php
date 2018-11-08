<?php

include_once 'conexao.php';
include_once 'ajudantes.php';

function buscaMensSede($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal in (1,2)
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensCBS($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal in (3,8)
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensOdonto($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal = 5
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensCPSI($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal = 6
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensScruz($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal = 9
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensPinheiral($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal = 13
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaMensBP($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select
            data, terminal, caixa_inicial, sum(diferenca) as diferenca, sum(debito) as debito, sum(credito) as credito, sum(mensalidades) as mensalidades,
            sum(procedimentos) as procedimentos, sum(dinheiro) as dinheiro, sum(cheque) as cheque, sum(cartao) as cartao,
            (caixa_inicial + sum(mensalidades) - sum(debito) + sum(credito) + sum(procedimentos)) as total
            from fechamento
            where terminal = 4
            and data between '$dt1F' and '$dt2F'
            group by data, terminal
            order by data, terminal, entrada";
    $con = conecta('aapvr');
    $result = mysqli_query($con,$sql);
    $mensalidades = array();
    if(mysqli_num_rows($result) > 0){
        while($mensalidade = mysqli_fetch_assoc($result)){
            $mensalidades[] = $mensalidade;
        }
        return $mensalidades;
    }
}

function buscaProcedCBS($data1,$data2){
    $dt1F = traduz_data_para_banco($data1);
    $dt2F = traduz_data_para_banco($data2);

    $sql = "select sum(valor_cobrado) as valor, data_pagamento as data, p.status,
            data_estorno, terminal, tipo_pagamento, a.procedimento, at.descricao
            from pagamentos p
            inner join agenda a on p.nsu = a.codigo
            inner join atendimento at on a.procedimento = at.codigo
            where p.status = 'P'
                and p.data_pagamento between '$dt1F' and '$dt2F'
            group by at.descricao
            order by at.descricao";
    $con = conecta('agenda');
    $result = mysqli_query($con,$sql);
    $procedimentos = array();
    if(mysqli_num_rows($result) > 0){
        while($procedimento = mysqli_fetch_assoc($result)){
            $procedimentos[] = $procedimento;
        }
        return $procedimentos;
    }
}

/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 30/08/2018
 * Time: 14:24
 */