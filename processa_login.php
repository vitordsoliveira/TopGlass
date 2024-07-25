<?php
// Inclua a classe de conexão com o banco de dados
require_once('admin/class/ClassCliente.php');
require_once('admin/class/Conexao.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Crie uma instância da classe de cliente (ou a classe apropriada para autenticação)
    $cliente = new ClassCliente();

    // Verifique as credenciais
    if ($cliente->login($email, $senha)) {
        // Se o login for bem-sucedido, defina a sessão e redirecione
        $_SESSION['idCliente'] = $cliente->getIdClienteByEmail($email);
        header('Location: index.php');
        exit();
    } else {
        // Se o login falhar, redirecione de volta para a página de login com uma mensagem de erro
        header('Location: login.php?erro=1');
        exit();
    }
}
?>
