<?php
session_start();
$login = $_POST['login'];
$senha = hash_pbkdf2('sha256',$_POST['senha'],'rvpaa',256,0,false);

$servidor = "localhost";
$usuariobd = "prosocioweb";
$senhabd="@prosocioweb$";
$banco="acesso";

$conexao = mysqli_connect($servidor,$usuariobd,$senhabd,$banco);

if (mysqli_connect_error()){
    echo "Problemas ao conectar com o banco de dados: ".mysqli_connect_error();
    die();
}

mysqli_set_charset($conexao, "UTF8");

/*$sql = "select u.usu_login, u.set_codigo, u.uni_codigo, u.usu_nome, u.usu_apelido, u.usu_dt_nascimento,".
       " u.usu_senha, u.usu_status, us.uss_nivel".
       " from usuario u".
       " inner join usuario_sistema us on u.usu_login = us.usu_login".
       " inner join sistema s on us.sis_codigo = s.sis_codigo".
       " where u.usu_login = '$login' and u.usu_senha ='$senha'".
       " and s.sis_nome = 'PRO-SÓCIO WEB' and us.uss_ativo = 'A' and u.usu_status = 'A'";
*/

$sql = "select u.usu_login, u.set_codigo, u.uni_codigo, u.usu_nome, u.usu_apelido, u.usu_dt_nascimento,
        u.usu_senha, u.usu_status, us.uss_nivel
        from usuario u
        inner join usuario_sistema us on u.usu_login = us.usu_login
        inner join sistema s on us.sis_codigo = s.sis_codigo
        where u.usu_login = '$login' and u.usu_senha ='$senha'
        and s.sis_nome = 'PRO-SÓCIO WEB' and us.uss_ativo = 'A' and u.usu_status = 'A'";

$resultado = mysqli_query($conexao,$sql);

$usuario = array();

if (!$resultado){
    echo 'Erro ao buscar o usuário: ' . mysqli_error($resultado);
}

if (mysqli_num_rows($resultado) > 0){
    while ($usu = mysqli_fetch_assoc($resultado)) {
        $usuario[] = $usu;
    }
    foreach ($usuario as $usua) {

        $_SESSION['login'] = $login;
        $_SESSION['setor'] = $usua['set_codigo'];
        $_SESSION['nome'] = $usua['usu_nome'];
        $_SESSION['nivel'] = $usua['uss_nivel'];
    }
    header('location:prosocio.php');
} else {
    unset($_SESSION['login']);
    unset($_SESSION['setor']);
    unset($_SESSION['nome']);
    unset($_SESSION['nivel']);
    session_destroy();
    header('location:index.php');
}
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 15/08/2018
 * Time: 09:50
 */