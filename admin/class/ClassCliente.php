<?php

require_once ('Conexao.php');

class ClassCliente
{
    // ATRIBUTOS 
    public $idCliente;
    public $nomeCliente;
    public $emailCliente;
    public $senhaCliente;
    public $numeroCliente;
    public $enderecoCliente;
    public $dataCadCliente;
    public $cpfCliente;
    public $statusCliente;

    // CONSTRUTOR
    public function __construct($id = false)
    {
        if ($id) {
            $this->idCliente = $id;
            $this->Carregar();
        }
    }
   
    //VERIFICAR LOGIN
    public function VerificarLogin()
    {
        $sql = "SELECT * FROM tbl_cliente WHERE
            emailCliente = '" . $this->emailCliente . "'
            and senhaCliente = '" . $this->senhaCliente . "'
            and statusCliente = 'ATIVO'";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $Cliente = $resultado->fetch();

        if ($Cliente) {
            return $Cliente['idCliente'];
            // Adiciona um aviso ao log indicando que o código foi executado
        } else {
            return false;
        }
    }
    
    // LISTAR
    public function Listar()
    {
        $sql = "SELECT 
            idCliente,
            nomeCliente,
            emailCliente,
            enderecoCliente,
            numeroCliente,
            cpfCliente,
            DATE_FORMAT(dataCadCliente, '%d/%m/%Y') AS dataCadCliente,
            statusCliente,
            senhaCliente
        FROM 
            tbl_cliente
        WHERE
            statusCliente = 'ATIVO'
        ORDER BY 
            dataCadCliente DESC;";

        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $lista = $resultado->fetchAll();

        return $lista;
    }

    // CARREGAR
    public function Carregar()
    {
        $sql = "SELECT * FROM tbl_cliente WHERE idCliente = $this->idCliente";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        if ($resultado) {
            $cliente = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($cliente) {
                $this->idCliente = $cliente['idCliente'];
                $this->nomeCliente = $cliente['nomeCliente'];
                $this->enderecoCliente = $cliente['enderecoCliente'];
                $this->numeroCliente = $cliente['numeroCliente'];
                $this->emailCliente = $cliente['emailCliente'];
                $this->cpfCliente = $cliente['cpfCliente'];
                $this->statusCliente = $cliente['statusCliente'];
            } else {
                echo 'Erro: Cliente não encontrado';
            }
        } else {
            echo 'Erro: Falha na consulta SQL';
        }
    }

    // INSERIR
    public function Inserir()
    {
        $sql = "INSERT INTO tbl_cliente (   nomeCliente,
                                            emailCliente,
                                            enderecoCliente,
                                            numeroCliente,
                                            cpfCliente,
                                            statusCliente)
                            VALUES ('$this->nomeCliente',
                                    '$this->emailCliente',
                                    '$this->enderecoCliente',
                                    '$this->numeroCliente',
                                    '$this->cpfCliente',
                                    '$this->statusCliente')";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        echo "<script>document.location='index.php?p=cliente'</script>";

    }

    // ATUALIZAR
    public function Atualizar()
    {
        $sql = "UPDATE tbl_cliente SET nomeCliente      = '" . $this->nomeCliente . "',
                                       emailCliente = '" . $this->emailCliente . "',
                                       enderecoCliente = '" . $this->enderecoCliente . "',
                                       numeroCliente = '" . $this->numeroCliente . "',
                                       cpfCliente = '" . $this->cpfCliente . "'
                WHERE idCliente = $this->idCliente";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        echo "<script>document.location='index.php?p=cliente'</script>";
    }

    // DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_cliente SET statusCliente = 'INATIVO' WHERE idCliente = :idCliente";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idCliente', $id);

        $stmt->execute();

        echo "<script>document.location='index.php?p=cliente'</script>";
    }


}

if (isset($_POST['email'])) {
    $Cliente = new ClassCliente();
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $Cliente->emailCliente = $email;
    $Cliente->senhaCliente = $senha;

    if ($idCliente = $Cliente->VerificarLogin()) {

        session_start(); // Inicia uma sessão
        $_SESSION['idCliente'] = $idCliente; // Define a variável de sessão 'idCliente' com o valor de $idCliente

        //echo 'o ID Cliente foi acionado e adicionado a página';

        echo json_encode(['success' => true, 'message' => 'Login OK']);

    } else {
        echo json_encode(['success' => false, 'message' => 'Login Invalido']);
    }
}


