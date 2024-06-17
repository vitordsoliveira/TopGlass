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

        <div class="titulo">
            <div class="siteServico">
                <h2>
                    SERVIÇOS VIDROS E ESPELHOS
                </h2>
            </div>
        </div>

        <article class="servicoVidro">

            <div class="siteServico">
                <div class="ajuste">
                    <div class="servicoDegradePV">
                        <span>
                            <img src="imgServicos/EspelhoParede.svg" alt="">
                            <h2 class="h1servico">ESPELHO</h2>
                        </span>
                    </div>
                    <div class="textoLateral">
                        <h1>ESPELHO</h1>
                        <p>
                            Desfrute da facilidade de manutenção e da sensação de luminosidade que ele proporciona.<br>
                            Reflita o melhor do seu espaço.<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                            INFO<br>
                        </p>
                    </div>
                </div>


                <div class="botao">
                    <a href="servicos.php">
                        <input type="submit" value="ORÇAMENTO">
                    </a>
                </div>
                <div class="prox">
                    <div>
                        <span><a href="pagCorrimao.php"><img src="img/setae.png" alt=""></a></span>
                        <p>PÁGINA ANTERIOR
                            |
                            PRÓXIMA PÁGINA</p><span><a href="pagJanela.php"><img src="img/setad.png" alt=""></a></span>
                    </div>
                </div>


            </div>

        </article>

        <section class="wppServico">
            <div>
                <a href=""><img src="img/whatsapp (1).png" alt=""></a>
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