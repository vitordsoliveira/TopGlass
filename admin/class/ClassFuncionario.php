<?php

require_once ('Conexao.php');

class ClassFuncionario
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

        if ($funcionario) {
            return $funcionario['idFuncionario'];
        } else {
            return false;
        }
    }

    public function __construct($idFuncionario = null)
    {
        if ($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
            $this->Carregar();
        }
    }

    public function Carregar()
    {
            $sql = "SELECT 
            nomeFuncionario, 
            fotoFuncionario, 
            altFotoFuncionario 
        FROM tbl_funcionario 
        WHERE idFuncionario = $this->idFuncionario";
            $conn = Conexao::LigarConexao();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nomeFuncionario = $funcionario['nomeFuncionario'];
            $this->fotoFuncionario = $funcionario['fotoFuncionario'];
            $this->altFotoFuncionario = $funcionario['altFotoFuncionario'];
        }
    }

        if (isset($_POST['email'])) {
            $funcionario = new ClassFuncionario();
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









