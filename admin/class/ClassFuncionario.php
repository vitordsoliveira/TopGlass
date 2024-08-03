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
            // Adiciona um aviso ao log indicando que o código foi executado
        } else {
            return false;
        }
    }

    public function __construct($idFuncionario = null) {
        if ($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
            $this->Carregar();
        }
    }

    public function Carregar() {
        $sql = "SELECT 
            idFuncionario, 
            nomeFuncionario, 
            fotoFuncionario, 
            altFotoFuncionario 
        FROM tbl_funcionario 
        WHERE idFuncionario = :idFuncionario";

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
        $stmt->execute();
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            $this->nomeFuncionario = $funcionario['nomeFuncionario'];
            $this->fotoFuncionario = $funcionario['fotoFuncionario'];
            $this->altFotoFuncionario = $funcionario['altFotoFuncionario'];
        }
    }

    public function CarregarPerfil() {
        try {
            $sql = "SELECT 
                idFuncionario, 
                nomeFuncionario,
                senhaFuncionario, 
                emailFuncionario,
                fotoFuncionario, 
                altFotoFuncionario 
            FROM tbl_funcionario 
            WHERE idFuncionario = :idFuncionario";
    
            $conn = Conexao::LigarConexao();
            if (!$conn) {
                throw new Exception('Erro ao conectar ao banco de dados.');
            }
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->execute();
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($funcionario) {
                $this->nomeFuncionario = $funcionario['nomeFuncionario'];
                $this->emailFuncionario = $funcionario['emailFuncionario'];
                $this->senhaFuncionario = $funcionario['senhaFuncionario'];
                $this->fotoFuncionario = $funcionario['fotoFuncionario'];
                $this->altFotoFuncionario = $funcionario['altFotoFuncionario'];
                return true;
            } else {
                echo 'Funcionário não encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro ao carregar o perfil: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
    
    public function AtualizarPerfil() {
        try {
            $sql = "UPDATE tbl_funcionario 
                    SET 
                        nomeFuncionario = :nomeFuncionario,
                        senhaFuncionario = :senhaFuncionario, 
                        emailFuncionario = :emailFuncionario,
                        fotoFuncionario = :fotoFuncionario, 
                        altFotoFuncionario = :altFotoFuncionario 
                    WHERE 
                        idFuncionario = :idFuncionario";
    
            $conn = Conexao::LigarConexao();
            if (!$conn) {
                throw new Exception('Erro ao conectar ao banco de dados.');
            }
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->bindParam(':nomeFuncionario', $this->nomeFuncionario, PDO::PARAM_STR);
            $stmt->bindParam(':senhaFuncionario', $this->senhaFuncionario, PDO::PARAM_STR);
            $stmt->bindParam(':emailFuncionario', $this->emailFuncionario, PDO::PARAM_STR);
            $stmt->bindParam(':fotoFuncionario', $this->fotoFuncionario, PDO::PARAM_STR);
            $stmt->bindParam(':altFotoFuncionario', $this->altFotoFuncionario, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception('Erro ao atualizar o perfil.');
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar o perfil: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
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
// Verifica se o formulário foi enviado verificando se a chave 'email' está presente no array $_POST









