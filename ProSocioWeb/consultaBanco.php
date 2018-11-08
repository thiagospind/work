<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 18/07/2018
 * Time: 16:51
 */


$sn_buscou = "";

function busca_socios($conexao,$campo,$tipo){

    if (isset($tipo) && $tipo==='M') {
        $sql = "select matricula, nome, matr_cbs, situacao, profissao, dt_admissao, dt_nascimento,
         identidade, org_exp, cpf, cart_prof, n_benef, descontado, matr_cbs_desc, endereco,
         bairro, cidade, estado, isento, telefone, plano_ext, cep, num_mens, sexo, codmens, 
         dt_alt, obs, numend, complend, readmissao, carencia, cod_empresa, pj, cod_vendedor, 
         cod_setor, telefone2, email, jornal, id_prop, cartao_sus, beneficio_plano, estatutario, 
         agencia, conta, dv, sn_sms, sntelemarket, justtelemarket, salario_13, votante, codigo_etiqueta,
         tipo_recebimento_jornal from associados
         where matricula = '$campo' 
         order by nome";
    }

    $resultado = mysqli_query($conexao, $sql);
    $associados = array();
    //return mysqli_fetch_assoc($resultado);
    if (!$resultado){
        echo mysqli_error($resultado);
    }
    global $sn_buscou;
    $sn_buscou = "s";
    if (mysqli_num_rows($resultado) > 0) {
        while ($associado = mysqli_fetch_assoc($resultado)) {
            $associados[] = $associado;
        }
        return $associados;
    }
}

function busca_socios_exc($conexao,$campo){

        $sql = "select matricula, nome, matr_cbs, situacao, profissao, dt_admissao, dt_nascimento,
         identidade, org_exp, cpf, cart_prof, n_benef, descontado, matr_cbs_desc, endereco,
         bairro, cidade, estado, isento, telefone, plano_ext, cep, num_mens, sexo, codmens,
         dt_alt, obs, numend, complend, cod_empresa,
         telefone2, email, cartao_sus, estatutario,
         agencia, conta, dv, sn_sms, sntelemarket, justtelemarket, tipo_recebimento_jornal,
         excluido, motivo_exc, falecido, grau_parent
         from excluidos 
         where matricula = '$campo' 
         order by nome";

    $resultado = mysqli_query($conexao, $sql);
    $excluidos = array();
    //return mysqli_fetch_assoc($resultado);
    if (!$resultado){
        echo mysqli_error($resultado);
    }
    if (mysqli_num_rows($resultado) > 0) {
        global $sn_buscou;
        $sn_buscou = "s";
        if (mysqli_num_rows($resultado) > 0) {
            while ($excluido = mysqli_fetch_assoc($resultado)) {
                $excluidos[] = $excluido;
            }
            return $excluidos;
        }
    }
}

function busca_mensalidades($conexao,$matricula){
    $sql = "(select MATRICULA, VALOR, DT_PAGA, MES_QUITE, NUM_PAGO, NOSSO_NUMERO,
             concat(ter_procedimento,'/',ter_local) as TERMINAL
             from mensalidade M
             inner join terminal T on M.terminal = T.ter_codigo 
             where matricula = '$matricula')
             union
             (select MATRICULA, VALOR, DT_PAGA, MES_QUITE, NUM_PAGO, NOSSO_NUMERO,
             concat(ter_procedimento,'/',ter_local) as TERMINAL
             from mensalidade2 M
             inner join terminal T on M.terminal = T.ter_codigo              
             where matricula = '$matricula')
             order by mes_quite desc, dt_paga desc limit 12";
    $resultado = mysqli_query($conexao,$sql);
    $mensalidades = array();
    if (!$resultado){
        echo mysqli_error($resultado);
    }
    while($mensalidade = mysqli_fetch_assoc($resultado)){
        $mensalidades[] = $mensalidade;
    }
    return $mensalidades;
}

function busca_mensalidades_exc($conexao,$matricula){
    $sql = "select MATRICULA, VALOR, DT_PAGA, MES_QUITE, NUM_PAGO,
             concat(ter_procedimento,'/',ter_local) as TERMINAL
             from meninativo M
             inner join terminal T on M.terminal = T.ter_codigo 
             where matricula = '$matricula'            
             order by mes_quite desc, dt_paga desc limit 12";
    $resultado = mysqli_query($conexao,$sql);
    $mensalidades = array();
    if (!$resultado){
        echo mysqli_error($resultado);
    }
    while($mensalidade = mysqli_fetch_assoc($resultado)){
        $mensalidades[] = $mensalidade;
    }
    return $mensalidades;
}

function busca_dependentes($conexao,$matricula){
    $sql = "select codigo, nome_dep, grau_dep, dt_nasci, dt_admiss, ident, org_exp_dep, concat(ident,'/',org_exp_dep) as rg_dep,
            cpf_dep, outros_doc,matricula,
            matr_cbs, sexodep, obs, estatuto, plano_ext, cartao_sus, beneficio_plano, isento, universitario
            from dependentes
            where matricula = '$matricula' 
            order by nome_dep";
    $resultado = mysqli_query($conexao,$sql);
    if (!$resultado){
        $erro = mysqli_error($resultado);
        echo $erro;
    }
    $dependentes = array();
    while($dependente = mysqli_fetch_assoc($resultado)){
        $dependentes[] = $dependente;
    }
    return $dependentes;
}

function busca_dependentes_exc($conexao,$matricula){
    $sql = "select codigo, nome_dep, grau_dep, dt_nasci, dt_admiss, ident, org_exp_dep, concat(ident,'/',org_exp_dep) as rg_dep,
            cpf_dep, outros_doc,matricula,
            matr_cbs, sexodep, obs, estatuto, plano_ext, cartao_sus, beneficio_plano, isento, universitario
            from dependentes
            where matricula = '$matricula' 
            order by nome_dep";
    $resultado = mysqli_query($conexao,$sql);
    if (!$resultado){
        $erro = mysqli_error($resultado);
        echo $erro;
    }
    $dependentes = array();
    while($dependente = mysqli_fetch_assoc($resultado)){
        $dependentes[] = $dependente;
    }
    return $dependentes;
}

function busca_tipo_desconto($conexao){
    $sql = "select cod_fdesc, descr_fdesc, tipo_fdesc, nomebanco 
        from formadesconto
        where tipo_fdesc <> 'riaam' and tipo_fdesc <> 'empresa' 
        and tipo_fdesc <> 'banco' order by descr_fdesc";

    $resultado = mysqli_query($conexao,$sql);
    if (!$resultado){
        echo mysqli_error($resultado);
    }

    $descontos = array();
    while($desconto = mysqli_fetch_assoc($resultado)){
        $descontos[] = $desconto;
    }
    return $descontos;
}