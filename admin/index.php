<?php
require_once ('class/ClassFuncionario.php');
session_start(); // Inicia uma sessão
$tipo = ''; // Inicializa a variável $tipo como uma string vazia

// Verifica se a variável de sessão 'idFuncionario' está definida
if (isset($_SESSION['idFuncionario'])) {
    // Define a variável $tipo como 'funcionario'
    $tipo = 'funcionario';

    // Criar uma instância do ClassFuncionario e obter o nome
    $funcionario = new ClassFuncionario($_SESSION['idFuncionario']);
    $nomeFuncionario = $funcionario->nomeFuncionario;
    $fotoFuncionario = $funcionario->fotoFuncionario;
    $altFotoFuncionario = $funcionario->altFotoFuncionario;
} else {
    // Se 'idFuncionario' não estiver definida, redireciona o usuário para a página de login
    header('location:http://localhost/topglass/admin/login.php');

    // Interrompe a execução do script para garantir que o redirecionamento aconteça imediatamente
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sedan:ital@0;1&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/InserirListar.css">

</head>

<body>

    <header>

        <div class="barraTopo">
            <div class="logo">
                <ul>
                    <li class="logo-container">
                        <img src="img/circle.png" alt="" class="circle">
                        <img src="img/logo.png" alt="" class="logoImg">
                    </li>
                </ul>
            </div>
            <div class="tituloDashboard">
                <h1>TOP GLASS</h1>
            </div>
            <div class="login">
                <ul>
                    <li>
                        <p><?php echo $nomeFuncionario; ?></p>
                    </li>
                    <li>
                        <img src="<?php echo $fotoFuncionario; ?>" alt="<?php echo $altFotoFuncionario; ?>"
                            class="perfilImg">
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <main>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="index.php?p=dashboard">HOME</a></li>
                    <li><a href="index.php?p=orcamento">ORÇAMENTOS</a></li>
                    <li><a href="index.php?p=servico">SERVIÇOS</a></li>
                    <li><a href="index.php?p=cliente">CLIENTES</a></li>
                    <li><a href="index.php?p=galeria">GALERIA</a></li>
                    <li><a href="index.php?p=banner">BANNERS</a></li>
                    <li><a href="sair.php">SAIR</a></li>
                </ul>
            </nav>
        </div>

        <div class="box">
            <?php
            $pagina = @$_GET['p'];

            switch ($pagina) {
                case 'banner':
                    $titulo = "banner";
                    require_once ('banner/banner.php');
                    break;
                case 'galeria':
                    $titulo = "galeria";
                    require_once ('galeria/galeria.php');
                    break;
                case 'cliente':
                    $titulo = "cliente";
                    require_once ('clientes/clientes.php');
                    break;
                case 'orcamento':
                    $titulo = "orcamento";
                    require_once ('orcamentos/orcamentos.php');
                case 'servico':
                    $titulo = "servico";
                    require_once ('servico/servico.php');
                    break;
                # code...   
            }
            ?>
        </div>

    </main>

    <footer class="rodape">
        <ul>
            <li>
                <h2>
                    DASHBOARD TOP GLASS
                </h2>
            </li>
            <li>
                <h3>
                    DIREITOS DA EMPRESA
                </h3>
            </li>
        </ul>
    </footer>

    <!--js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>