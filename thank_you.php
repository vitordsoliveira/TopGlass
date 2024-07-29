<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado!</title>
    <link rel="icon" href="img/icone.ico" type="image/x-icon">

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
    <header>
        <div id="menuFixo" class="barra">
            <div class="site">
                <button class="abrirMenu"></button>
                <nav class="menu">
                    <button class="fecharMenu"></button>
                    <ul>
                        <li><a href="index.php"><span><img src="img/home.png" alt=""></span>HOME</a></li>
                        <li><a href="#"><span><img src="img/servicos.svg" alt="#"></span>SERVIÇOS+</a>
                            <ul class="subServico">
                                <div>
                                    <li><a href="pagBox.php">VIDROS</a></li>
                                    <li><a href="pagEspelho.php">ESPELHO</a></li>
                                    <li><a href="pagAluminio.php">ESQUADRIA</a></li>
                                </div>
                            </ul>
                        </li>
                        <li><a href="#"><span><img src="img/orcamento.svg" alt="#"></span>ORÇAMENTO</a></li>
                        <li><a href="https://www.google.com.br/maps/place/Top+Glass/@-23.5005135,-46.3947126,17z/data=!4m6!3m5!1s0x94ce63dc4928e219:0xb41341944e1c0845!8m2!3d-23.4999478!4d-46.3937148!16s%2Fg%2F11rz49br3d?entry=ttu"><span><img src="img/gps.svg" alt="#"></span>LOCALIZAÇÃO</a></li>
                        <li><a href="login.php"><span><img src="img/login.svg" alt="#"></span><h2>LOGIN</h2></a></li>
                        <li><a href="http://localhost/topglass/admin/sair.php">SAIR</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section class="thank-you-section">
            <div class="thank-you-message">
                <h1>Obrigado pelo seu orçamento!</h1>
                <p>Recebemos seu pedido e entraremos em contato em breve.</p>
                <a href="index.php" class="btn">Voltar à página inicial</a>
            </div>
        </section>
    </main>

    <?php require_once('conteudo/rodape.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/estilo.js"></script>
    <script src="js/wpp.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
