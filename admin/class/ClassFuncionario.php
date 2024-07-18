<?php

require_once ('Conexao.php');

class classFuncionario
{
    public $idFuncnario;
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

        $sql = "SELECT * from tbl_funcionario where 
            emailFuncionario = '" . $this->emailFuncionario . "'
            and senhaFuncionario = '" . $this->senhaFuncionario . "'
            and statusFuncionario = 'ATIVO'";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $funcionario = $resultado->fetch();

        if ($funcionario) {
            return $funcionario['idFuncionario'];
        } else {
            return false;
        }
    }
}
// Verifica se o formulário foi enviado verificando se a chave 'email' está presente no array $_POST

if (isset($_POST['emailFuncionario'])) {
    $funcionario = new classFuncionario();
    $email = $_POST['emailFuncionario'];
    $senha = $_POST['senhaFuncionario'];

    $funcionario->emailFuncionario = $email;
    $funcionario->senhaFuncionario = $senha;

    if ($idFuncionario = $funcionario->VerificarLogin()) {

        session_start(); // Inicia uma sessão
        $_SESSION['idFuncionario'] = $idFuncionario; // Define a variável de sessão 'idFuncionario' com o valor de $idFuncionario


        echo json_encode(['success' => true, 'message' => 'Login OK']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Login Invalido']);
    }
}