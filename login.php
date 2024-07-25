<?php
$nomeCliente = isset($_SESSION['nomeCliente']) ? $_SESSION['nomeCliente'] : null;
require_once ('admin/class/ClassCliente.php');
session_start(); // Inicia uma sessão
$tipo = ''; // Inicializa a variável $tipo como uma string vazia

// Verifica se a variável de sessão 'idFuncionario' está definida
if (isset($_SESSION['idCliente'])) {
    // Define a variável $tipo como 'funcionario'
    $tipo = 'cliente';
    // Criar uma instância do ClassFuncionario e obter o nome
    $cliente = new ClassCliente($_SESSION['idCliente']);
    $nomeCliente = $cliente->nomeCliente;
} else {
    $nomeCliente = '';
}

require_once ('admin/class/ClassGaleria.php');
$Galeria = new ClassGaleria();
$lista = $Galeria->Listar();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Glass</title>

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->

        <div id="menuFixo" class="barra ">
            <div class="site">
                <button class="abrirMenu"></button>
                <nav class="menu">
                    <button class="fecharMenu"></button>
                    <ul>
                        <li>
                            <a href="index.php">
                                <span>
                                    <img src="img/home.png" alt="">
                                </span>HOME
                            </a>
                        </li>
                        <li>
                            <a href="#"><span><img src="img/servicos.svg" alt="#"></span>SERVIÇOS+</a>
                            <ul class="subServico">
                                <div>
                                    <li><a href="pagBox.php">VIDROS</a></li>
                                    <li><a href="pagEspelho.php">ESPELHO</a></li>
                                    <li><a href="pagAluminio.php">ESQUADRIA</a></li>
                                </div>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span><img src="img/orcamento.svg" alt="#"></span>ORÇAMENTO</a>
                        </li>
                        <li>
                            <a
                                href="https://www.google.com.br/maps/place/Top+Glass/@-23.5005135,-46.3947126,17z/data=!4m6!3m5!1s0x94ce63dc4928e219:0xb41341944e1c0845!8m2!3d-23.4999478!4d-46.3937148!16s%2Fg%2F11rz49br3d?entry=ttu"><span><img
                                        src="img/gps.svg" alt="#"></span>LOCALIZAÇÃO</a>
                        </li>
                        <li>
                            <a href="login.php">
                                <span><img src="img/login.svg" alt="#"></span>
                                <h2><?php echo ($nomeCliente ?? 'LOGIN'); ?></h2>
                            </a>
                        </li>

                        <li>
                            <a href="http://localhost/topglass/admin/sair.php">SAIR</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </header>

    <main class="wow login animate__animated animate__fadeInUp">

        <div class="site">
            <div class="loginTop">

                <h2>LOGIN</h2>
            </div>
            <form id="formLoginAdmin" action="#" method="POST">
                <div>
                    <div>
                        <label for="email">
                            <p>Digite seu E-mail:</p>
                        </label>
                        <input type="text" name="email" title="email" placeholder="Digite aqui seu email completo"
                            required>
                    </div>

                    <div>
                        <label for="senha">
                            <p>Digite sua senha:</p>
                        </label>
                        <input type="password" name="senha" title="senha" placeholder="Digite aqui sua senha" required>
                    </div>
                    <ul>
                        <li>
                            <a href="registro.php">SE REGISTRAR</a>
                        </li>
                        <li>
                            <a href="">ESQUECI MINHA SENHA</a>
                        </li>
                    </ul>
                    <div class="logar">
                        <button onclick="LoginAdmin()" type="submit" value="ENTRAR" input="ENTRAR" text="ENTRAR">
                    </div>
                </div>
            </form>
        </div>

    </main>

    <!-- RODAPÉ -->
    <?php require_once ('conteudo/rodape.php'); ?>

    <!--jQuery sempre antes de acabar o body-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!--SLICK JS-->
    <script src="js/slick.min.js"></script>

    <script src="js/wow.min.js"></script>

    <!--meu JS no final-->
    <script src="js/estilo.js"></script>

    <script src="js/login.js"></script>

</body>

</html>