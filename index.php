<?php

// Importar classes do PHPMailer para o espaço de nomes global
// Estas devem estar no topo do seu script, não dentro de uma função
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ok = 0;

if (isset($_POST['email'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $num = $_POST['num'];
    $end = $_POST['end'];
    $servicosVidro = $_POST['servicosVidro'];
    $servicosEsquadria = $_POST['servicosEsquadria'];
    $coment = $_POST['coment'];

    // Carregar o autoloader do Composer
    require 'mailer/Exception.php';
    require 'mailer/PHPMailer.php';
    require 'mailer/SMTP.php';

    // Criar uma instância; passar `true` habilita exceções
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor

        /* $mail->SMTPDebug = SMTP::DEBUG_SERVER;    */                   // Habilitar saída de depuração detalhada
        $mail->isSMTP();                                            // Enviar usando SMTP
        $mail->Host = 'smtp.hostinger.com.br';                // Definir o servidor SMTP para enviar
        $mail->SMTPAuth = true;                                   // Habilitar autenticação SMTP
        $mail->Username = 'topglass@ti22.smpsistema.com.br';                 // Nome de usuário SMTP
        $mail->Password = 'Senac@topglass01';                                // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar criptografia TLS
        $mail->Port = 465;                                    // Porta TCP para conectar-se

        // Destinatários
        $mail->setFrom('topglass@ti22.smpsistema.com.br', 'Orcamento ');
        $mail->addAddress('orcamentostg@gmail.com');                 // Adicionar um destinatário

        // Conteúdo
        $mail->isHTML(true);                                        // Definir formato de e-mail para HTML
        $mail->Subject = 'ORCAMENTO';

        $mail->Body = "
            <strong> Mensagem do site ... ... </strong>
            <br><br>
            <strong> Nome: </strong> $nome <br>
            <strong> Email: </strong> $email <br>
            <strong> Telefone: </strong> $num <br>
            <strong> Endereço: </strong> $end <br>
            <strong> Serviço de Vidro: </strong> $servicosVidro <br>
            <strong> Serviço de Esquadria: </strong> $servicosEsquadria <br>
            <strong> Comentário do Serviço: </strong> $coment 
        ";

        $mail->Body = "
            <strong> Mensagem do site ... ... </strong>
            <br><br>
            <strong> Nome: </strong> $nome <br>
            <strong> Email: </strong> $email <br>
            <strong> Telefone: </strong> $num <br>
            <strong> Endereço: </strong> $end <br>
            <strong> Serviço de Vidro: </strong> $servicosVidro <br>
            <strong> Serviço de Esquadria: </strong> $servicosEsquadria <br>
            <strong> Comentário do Serviço: </strong> $coment <br>
        ";

        $mail->send();
        $ok = 1;
    } catch (Exception $e) {
        $ok = 2;
        echo "Erro do Mailer: {$mail->ErrorInfo}";
    }
}


require_once ('./admin/class/ClassCliente.php');
session_start(); // Inicia uma sessão
$tipo = ''; // Inicializa a variável $tipo como uma string vazia

// Verifica se a variável de sessão 'idFuncionario' está definida
if (isset($_SESSION['idCliente'])) {
    // Define a variável $tipo como 'funcionario'
    $tipo = 'Cliente';

    // Criar uma instância do ClassFuncionario e obter o nome
    $Cliente = new ClassCliente($_SESSION['idCliente']);
    $nomeCliente = $Cliente->nomeCliente;

} 

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Glass</title>
    <link rel="icon" href="img/icone.ico" type="image/x-icon">

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/estiloServico.css">

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->
        <h1 class="h1h1">topglass,vidro,esquadria,serviço de vidro,serviço de aluminio,vidraçaria</h1>

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    <!--LOGO E BANNER DA EMPRESA-->
    <article class="wow banner animate__animated animate__fadeInUp">

        <span class="bannerLogo"> <img src="img/fundo.jpg" alt="Banner TOPGLASS" class="bannerImage"></span>
        <img src="img/logo.svg" alt="Logotipo" class="logoImage">

    </article>

    <main>

        <!-- SOBRE NOS-->
        <?php require_once ('conteudo/sobre.php'); ?>

        <!-- TITULO VIDRO-->
        <?php require_once ('conteudo/titulo-vidro.php'); ?>

        <!--SERVICOS VIDRO-->
        <?php require_once ('conteudo/servico-vidro.php'); ?>

        <!-- TITULO ESQUADRIA -->
        <?php require_once ('conteudo/titulo-esqua.php'); ?>

        <!--SERVICOS ESQUADRIA-->
        <?php require_once ('conteudo/servico-esqua.php'); ?>

        <!--BANNER ROTATIVO-->
        <?php require_once ('conteudo/banner-rotativo.php'); ?>

        <!-- LOCALIZAÇÃO -->
        <?php require_once ("conteudo/cont-map.php"); ?>

        <!-- EMPRESAS -->
        <?php require_once ("conteudo/marcas.php"); ?>

        <!-- ORÇAMENTO -->
        <?php require_once ('conteudo/cont-orcamento.php'); ?>

        <!--WHATS APP-->
        <?php require_once ('conteudo/wpp.php'); ?>

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