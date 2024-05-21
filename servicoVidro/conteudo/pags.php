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

    <link rel="stylesheet" href="css/pags.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    <main>

        <article>
            <div class="pagsVidros">
                <div class="site">
                    <div class="servicoDegradeV">
                        <section>
                            <div>
                                <span>
                                    <img src="../imgServicos/CORRIMÃO.svg" alt="">
                                    <h2 class="h2servico">
                                        CORRIMÃO</h2>
                                </span>
                            </div>
                            <div class="texto">
                                <div>
                                    <p>
                                        Adicione segurança e requinte ao seu lar com nosso corrimão de vidro,oferecemos
                                        uma solução
                                        durável e moderna para escadas e varandas.
                                    </p>
                                </div>
                            </div>
                            <div class="envio">
                                <a href="">ORÇAMENTO</a>
                            </div>
                        </section>

                        <section>
                            <div>
                                <span>
                                    <img src="../imgServicos/BOX.svg" alt="">
                                    <h2 class="h2servicoV">BOX</h2>
                                </span>
                            </div>
                            <div class="texto">
                                <div>
                                    <p>
                                        Adicione segurança e requinte ao seu lar com nosso corrimão de vidro,oferecemos
                                        uma solução
                                        durável e moderna para escadas e varandas.
                                    </p>
                                </div>
                                <div class="envio">
                                    <a href="">ORÇAMENTO</a>
                                </div>
                        </section>
                    </div>
                </div>

        </article>

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