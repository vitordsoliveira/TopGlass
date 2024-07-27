<?php

// Importar classes do PHPMailer para o espaço de nomes global
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
            <strong> Comentário do Serviço: </strong> $coment <br>
        ";

        $mail->send();
        $ok = 1;
    } catch (Exception $e) {
        $ok = 2;
        // O erro será registrado, mas não exibido para o usuário
        // echo "Erro do Mailer: {$mail->ErrorInfo}";
    }
}

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
    <h1 class="h1h1">topglass,vidro,esquadria,serviço de vidro,serviço de aluminio,vidraçaria</h1>
    <header>
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
                            <a href="login.php"><span><img src="img/login.svg" alt="#"></span>
                                <h2><?php echo $nomeCliente ? $nomeCliente : 'LOGIN'; ?></h2>
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

    <article class="wow banner animate__animated animate__fadeInUp">
        <span class="bannerLogo">
            <?php foreach ($lista as $linha): ?>
                <img class="bannerImage" src="admin/<?php echo ($linha['caminhoGaleria']); ?>"
                    alt="admin/img/galeria/<?php echo ($linha['nomeGaleria']); ?>">
            <?php endforeach; ?>
        </span>
        <img src="img/logo.svg" alt="Logotipo" class="logoImage">
    </article>

    <main>
        <?php require_once ('conteudo/sobre.php'); ?>
        <?php require_once ('conteudo/titulo-vidro.php'); ?>
        <?php require_once ('conteudo/servico-vidro.php'); ?>
        <?php require_once ('conteudo/titulo-esqua.php'); ?>
        <?php require_once ('conteudo/servico-esqua.php'); ?>
        <?php require_once ('conteudo/banner-rotativo.php'); ?>
        <?php require_once ("conteudo/cont-map.php"); ?>
        <?php require_once ("conteudo/marcas.php"); ?>
        <?php require_once ('conteudo/cont-orcamento.php'); ?>
        <?php require_once ('conteudo/wpp.php'); ?>
    </main>

    <?php require_once ('conteudo/rodape.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="js/slick.min.js"></script>

    <script src="js/wow.min.js"></script>

    <script src="js/estilo.js"></script>

    <script src="js/login.js"></script>

    <!--js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>

</html>