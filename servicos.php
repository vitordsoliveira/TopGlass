<?php

// Importar classes do PHPMailer para o espaço de nomes global
// Estas devem estar no topo do seu script, não dentro de uma função
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ok = 0;

if(isset($_POST['email'])){

    $nome   = $_POST['nome'];
    $email  = $_POST['email'];
    $fone   = $_POST['fone'];
    $mens   = $_POST['mens'];

    // Carregar o autoloader do Composer
    require 'mailer/Exception.php';
    require 'mailer/PHPMailer.php';
    require 'mailer/SMTP.php';
    
    // Criar uma instância; passar `true` habilita exceções
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Habilitar saída de depuração detalhada
        $mail->isSMTP();                                            // Enviar usando SMTP
        $mail->Host       = 'smtp.hostinger.com.br';                // Definir o servidor SMTP para enviar
        $mail->SMTPAuth   = true;                                   // Habilitar autenticação SMTP
        $mail->Username   = 'Seu email de disparo';                 // Nome de usuário SMTP
        $mail->Password   = 'SENHA';                                // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar criptografia TLS
        $mail->Port       = 465;                                    // Porta TCP para conectar-se

        // Destinatários
        $mail->setFrom('Seu email de disparo', 'Assunto do email');
        $mail->addAddress('Email que vai receber');                 // Adicionar um destinatário

        // Conteúdo
        $mail->isHTML(true);                                        // Definir formato de e-mail para HTML
        $mail->Subject = 'Site Assunto';
        
        $mail->Body    = "
            <strong> Mensagem do site ... ... </strong>
            <br><br>
            <strong> Nome: </strong> $nome <br>
            <strong> Email: </strong> $email <br>
            <strong> Telefone: </strong> $fone <br>
            <strong> Mensagem: </strong> $mens
        ";
        
        $mail->AltBody = "
        <strong> Mensagem do site ... ... </strong>
            <br><br>
            <strong> Nome: </strong> $nome <br>
            <strong> Email: </strong> $email <br>
            <strong> Telefone: </strong> $fone <br>
            <strong> Mensagem: </strong> $mens    
        ";

        $mail->send();
        $ok = 1;
    } catch (Exception $e) {
        $ok = 2;
        echo "Erro do Mailer: {$mail->ErrorInfo}";
    }
}
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

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    <!--LOGO E BANNER DA EMPRESA-->
    <section class="wow banner animate__animated animate__fadeInUp">
        <div>
            <img src="img/fundo1.svg" alt="Banner TOPGLASS" class="bannerImage">
            <img src="img/logo.svg" alt="Logotipo" class="logoImage">
            <img src="img/texto.svg" alt="" class="texto">
        </div>
    </section>

    <main>
        <section class="contServicos">
            <div></div>
            <div></div>
        </section>

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