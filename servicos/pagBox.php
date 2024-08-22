<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Glass</title>
    <link rel="icon" href="../img/iconeDesk.ico" type="image/x-icon">

    <link rel="stylesheet" href="../css/reset.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="../css/estilo.css">

    <link rel="stylesheet" href="../css/estiloServico.css">

    <link rel="stylesheet" href="../css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->

        <?php require_once ('../conteudo/faixa-topo.php'); ?>

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
                            <img src="../imgServicos/boxVidro.svg" alt="">
                            <h2 class="h1servico">BOX</h2>
                        </span>
                    </div>
                    <div class="textoLateral">
                        <h1>BOX</h1>
                        <p>
                            Desfrute de momentos relaxantes e elegantes em seu banheiro com nosso box de vidro,
                            proporcionando um ambiente sofisticado e garantindo estilo!<br>
                            <br>
                            Temperado:<br>
                            Milimetros Disponiveis:<br>
                            Cores Disponiveis:<br>
                            Modelo Jateado:<br>
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
                        <span><a href=""><img src="../img/setae.png" alt=""></a></span>
                        <p>PÁGINA ANTERIOR | PRÓXIMA PÁGINA</p>
                        <span> <a href=""><img src="../img/setad.png" alt=""></a></span>
                    </div>
                </div>

            </div>

        </article>

        <?php require_once ('../conteudo/wppServico.php'); ?>

        </article>

    </main>

    <!-- RODAPÉ -->
    <?php require_once ('../conteudo/rodape.php'); ?>

</body>

</html>