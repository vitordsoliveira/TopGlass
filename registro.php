<?php
$message = ''; // Inicializar a variável $message para evitar problemas caso não haja mensagem

if (isset($_POST['nomeCliente'])) {
    // Recuperando dados do formulário
    $nomeCliente = ($_POST['nomeCliente']);
    $enderecoCliente = ($_POST['enderecoCliente']);
    $numeroCliente = ($_POST['numeroCliente']);
    $emailCliente = filter_var($_POST['emailCliente'], FILTER_SANITIZE_EMAIL);
    $senhaCliente = password_hash($_POST['senhaCliente'], PASSWORD_DEFAULT);
    $cpfCliente = ($_POST['cpfCliente']);
    $statusCliente = 'ATIVO';

    try {
        // Recuperar o id
        require_once('class/Conexao.php');
        $conexao = Conexao::LigarConexao();
        
        $sql = $conexao->query('SELECT idCliente FROM tbl_cliente ORDER BY idCliente DESC LIMIT 1');
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        if ($resultado !== false && isset($resultado['idCliente'])) {
            $novoId = $resultado['idCliente'] + 1;
        } else {
            $novoId = 1; // Caso seja o primeiro registro
        }

        // Inserir dados no banco de dados
        require_once('class/ClassCliente.php');
        $cliente = new ClassCliente();

        $cliente->idCliente = $novoId;
        $cliente->nomeCliente = $nomeCliente;
        $cliente->enderecoCliente = $enderecoCliente;
        $cliente->numeroCliente = $numeroCliente;
        $cliente->emailCliente = $emailCliente;
        $cliente->senhaCliente = $senhaCliente;
        $cliente->cpfCliente = $cpfCliente;
        $cliente->statusCliente = $statusCliente;

        if ($cliente->Registrar()) {
            $message = 'Cadastro realizado com sucesso!';
        } else {
            $message = 'Erro ao cadastrar o cliente.';
        }
    } catch (Exception $e) {
        $message = 'Erro: ' . $e->getMessage();
    }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/responsivo.css">
</head>

<body>
    <header>
        <?php require_once('conteudo/faixa-topo.php'); ?>
    </header>

    <main class="wow registro animate__animated animate__fadeInUp">
        <div class="site">
            <div class="registroTop">
                <h2>REGISTRO</h2>
            </div>
            <?php if ($message): ?>
                <div class="message">
                    <?php echo ($message); ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="nomeGrupo">
                    <div>
                        <label for="nome">DIGITE SEU NOME:</label>
                        <input type="text" name="nomeCliente" placeholder="Digite aqui seu nome completo" required>
                    </div>
                    <div>
                        <label for="cpfCliente">DIGITE AQUI O SEU CPF:</label>
                        <input type="text" name="cpfCliente" id="cpfCliente" placeholder="000.000.000-00" maxlength="14" required>
                    </div>
                </div>

                <div class="enderecoGrupo">
                    <div>
                        <label for="end">DIGITE SEU ENDEREÇO:</label>
                        <input type="text" name="enderecoCliente" placeholder="Digite aqui sua rua, número e bairro" required>
                    </div>
                    <div>
                        <label for="num">DIGITE SEU NÚMERO:</label>
                        <input type="text" name="numeroCliente" id="numeroCliente" placeholder="(DDD) 0 0000-0000" oninput="formatPhoneNumber(this)" maxlength="15" required>
                    </div>
                </div>

                <div class="loginGrupo">
                    <div>
                        <label for="email">DIGITE SEU E-MAIL:</label>
                        <input type="email" name="emailCliente" placeholder="Digite aqui seu email completo" required>
                    </div>
                    <div>
                        <label for="senha">DIGITE SUA SENHA:</label>
                        <input type="password" id="senhaCliente" name="senhaCliente" placeholder="Digite aqui sua senha" required>
                        <ul>
                            <li>mínimo de 8 caracteres</li>
                            <li>pelo menos 1 número</li>
                        </ul>
                    </div>
                    <div>
                        <label for="senhaNoMe">DIGITE A SENHA NOVAMENTE:</label>
                        <input type="password" id="senhaNoMe" name="senhaNoMe" placeholder="Digite aqui sua senha novamente" required onkeyup="validarSenhas()">
                    </div>
                    <div id="mensagemSenha"></div>

                    <div class="registrar">
                        <input type="submit" value="REGISTRAR-SE">
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php require_once('conteudo/rodape.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/estilo.js"></script>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        function validarSenhas() {
            const senha = document.getElementById('senhaCliente').value;
            const senhaNoMe = document.getElementById('senhaNoMe').value;
            const mensagem = document.getElementById('mensagemSenha');

            if (senha === senhaNoMe) {
                mensagem.style.color = 'green';
                mensagem.textContent = 'As senhas coincidem.';
            } else {
                mensagem.style.color = 'red';
                mensagem.textContent = 'As senhas não coincidem.';
            }
        }

        document.getElementById('cpfCliente').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });

        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos

            if (value.length > 0) {
                value = '(' + value;
            }
            if (value.length > 2) {
                value = value.slice(0, 3) + ') ' + value.slice(3);
            }
            if (value.length > 9) {
                value = value.slice(0, 9) + '-' + value.slice(9);
            }

            input.value = value;
        }
    </script>
</body>

</html>