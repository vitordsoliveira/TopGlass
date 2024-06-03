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

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/estiloServico.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    </article>

    <main>

        <div class="wow titulo animate__animated animate__fadeInUp">
            <div class="siteServico">
                <h2>
                    SERVIÇOS VIDROS E ESPELHOS
                </h2>
            </div>
        </div>

        <article class="wow servicoVidro animate__animated animate__fadeInUp">

            <div class="siteServico">
                <div class="servicosVE">
                    <div class="servicoDegradePV">
                        <span>
                            <img src="imgServicos/CORRIMÃO.svg" alt="">
                            <h2 class="h1servico">CORRIMÃO</h2>
                        </span>
                    </div>
                    <div class="textoLateral">
                        <h1>CORRIMÃO</h1>
                        <p>
                            Adicione segurança e requinte ao seu lar com nosso corrimão de vidro,oferecemos uma solução
                            durável e moderna para escadas e varandas!<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                        </p>
                    </div>

                    <div class="botao">
                        <a href="">ORÇAMENTO</a>
                    </div>
                    <div class="prox">
                        <a href="pagBox.php"><img src="img/setae.png" alt=""></a>
                        <p>PÁGINA ANTERIOR | PRÓXIMA PÁGINA</p>
                        <a href="pagBox.php"><img src="img/setad.png" alt=""></a>
                    </div>

                </div>
            </div>

        </article>

        <section class="wppV animate__animated animate__shakeY animate__slow animate__infinite">
            <div>
                <a href=""><img src="./img/whatsapp (1).png" alt=""></a>
            </div>
        </section>

        </article>

    </main>

    <!-- RODAPÉ -->
    <?php require_once ('conteudo/rodape.php'); ?>

    <!--jQuery sempre antes de acabar o body-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>