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

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    <main class="wow login animate__animated animate__fadeInUp">

        <div class="site">
            <div class="loginTop">
                <img src="img/login1.svg" alt="">
                <h2>LOGIN</h2>
            </div>
            <form action="#" method="POST">

                <div>
                    <div>
                        <label for="email">
                            <p>Digite seu E-mail:</p>
                        </label>
                        <input type="text" name="email" placeholder="Digite aqui seu email completo" required>
                    </div>

                    <div>
                        <label for="senha">
                            <p>Digite sua senha:</p>
                        </label>
                        <input type="text" name="senha" placeholder="Digite aqui sua senha" required>
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
                        <input type="submit" value="ENTRAR">
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

</body>

</html>