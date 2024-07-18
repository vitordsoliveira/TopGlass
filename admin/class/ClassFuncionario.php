<?php

require_once ('Conexao.php');

class classFuncionario
{
    public $idFuncionario;
    public $nomeFuncionario;
    public $emailFuncionario;
    public $enderecoFuncionario;
    public $numeroFuncionario;
    public $cpfFuncionario;
    public $dataFuncionario;
    public $statusFuncionario;
    public $senhaFuncionario;
    public $altFotoFuncionario;
    public $fotoFuncionario;


    public function VerificarLogin()
    {

        $sql = "SELECT * FROM tbl_funcionario WHERE
            emailFuncionario = '" . $this->emailFuncionario . "'
            and senhaFuncionario = '" . $this->senhaFuncionario . "'
            and statusFuncionario = 'ATIVO'";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $funcionario = $resultado->fetch();

        echo 'Método VerificarLogin foi executado';

        if ($funcionario) {
            return $funcionario['idFuncionario'];
            // Adiciona um aviso ao log indicando que o código foi executado
        } else {
            return false;
        }
    }
}
// Verifica se o formulário foi enviado verificando se a chave 'email' está presente no array $_POST

if (isset($_POST['email'])) {
    $funcionario = new classFuncionario();
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $funcionario->emailFuncionario = $email;
    $funcionario->senhaFuncionario = $senha;

    if ($idFuncionario = $funcionario->VerificarLogin()) {

        session_start(); // Inicia uma sessão
        $_SESSION['idFuncionario'] = $idFuncionario; // Define a variável de sessão 'idFuncionario' com o valor de $idFuncionario

        //echo 'o ID FUNCIONARIO foi acionado e adicionado a página';

        echo json_encode(['success' => true, 'message' => 'Login OK']);

    } else {
        echo json_encode(['success' => false, 'message' => 'Login Invalido']);
    }
}