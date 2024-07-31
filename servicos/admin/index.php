<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina Auto Mestre</title>

    <!-- reset do site-->
    <link rel="stylesheet" href="css/reset.css">

    <!-- fonte do site-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/animacao.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>
    <!-- CABEÇALHO -->
    <?php require_once ('conteudo/cont-topo.php'); ?>
    <!-- BANNER -->
    <section class="banner">
        <img src="imagens/1920x600.svg" alt="Banner Oficina Auto Mestre">
        <img src="img/1920x600-3.svg" alt="Banner Oficina Auto Mestre">
        <img src="img/1920x600-2.svg" alt="Banner Oficina Auto Mestre">
    </section>

    <main>
        <!-- SOBRE -->
        <?php require_once ('conteudo/cont-sobre.php'); ?>

        <!-- SERVIÇO -->
        <?php require_once('conteudo/cont-servicos.php'); ?>

        <!-- TECNOLOGIA -->
        <?php require_once('conteudo/cont-tecnologia.php');?>

        <!-- GALERIA -->
        <?php require_once('conteudo/cont-galeria.php'); ?>

        <!-- DEPO -->
        <?php require_once ('conteudo/cont-depo.php'); ?>

        <!--PROJETO-->
        <?php require_once('conteudo/cont-projeto.php'); ?>

        <!--LOGOS-->
        <?php require_once('conteudo/cont-logos.php'); ?>
    </main>

        <!-- RODAPE -->
       <?php require_once('conteudo/rodape.php'); ?>


    <!--jQuery sempre antes de acabar o body-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!--SLICK JS-->
    <script src="js/slick.min.js"></script>

    <!--WOW-->
    <script src="js/wow.min.js"></script>

    <!--meu JS no final-->
    <script src="js/animacoes.js"></script>
</body>
</html>