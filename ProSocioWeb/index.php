<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>AAP-VR - Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/my-login.css">
</head>
<body class="my-login-page">
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #002a4d">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/icone_aapvr.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSite">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Esqueci a senha</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container h-100 mt-2">
        <div class="row justify-content-md-center">
            <div class="card-wrapper">
                <div class="card fat">
                    <div class="card-body">
                        <div>
                            <span class="h5 text-danger"><?php echo isset($_GET['msgLogin']) ? urldecode($_GET['msgLogin']) : ''; ?></span>
                        </div>
                        <h4 class="card-title">Login</h4>
                        <form method="post" action="login.php">

                            <div class="form-group">
                                <label for="login">Usuário</label>
                                <input id="login" type="text" class="form-control" name="login" value="" required autofocus>
                            </div>

                            <div class="form-group">
                                 <label for="senha">Senha
                                <a href="#" class="float-right">Esqueceu a senha?</a></label>
                                <input type="password" id="senha" class="form-control" name="senha" required data-eye>
                            </div>

                            <div class="form-group no-margin">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/popper.js/dist/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 15/08/2018
 * Time: 08:46
 */