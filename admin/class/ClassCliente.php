<?php

require_once ('Conexao.php');

class ClassCliente
{
    // ATRIBUTOS 
    public $idCliente;
    public $nomeCliente;
    public $emailCliente;
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
        $sql = "INSERT INTO tbl_cliente (nomeCliente, emailCliente, enderecoCliente, numeroCliente, cpfCliente, dataCadCliente, statusCliente) 
                VALUES (:nomeCliente, :emailCliente, :enderecoCliente, :numeroCliente, :cpfCliente, :dataCadCliente, :statusCliente)";

        $connect = Conexao::LigarConexao();
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':nomeCliente', $this->nomeCliente);
        $stmt->bindParam(':emailCliente', $this->emailCliente);
        $stmt->bindParam(':enderecoCliente', $this->enderecoCliente);
        $stmt->bindParam(':numeroCliente', $this->numeroCliente);
        $stmt->bindParam(':cpfCliente', $this->cpfCliente);
        $stmt->bindParam(':dataCadCliente', $this->dataCadCliente);
        $stmt->bindParam(':statusCliente', $this->statusCliente);

        $stmt->execute();

        echo "<script>document.location='index.php?p=cliente'</script>";
    }

    // ATUALIZAR
    public function Atualizar()
    {
        $sql = "UPDATE tbl_cliente SET nomeCliente = :nomeCliente, enderecoCliente = :enderecoCliente, numeroCliente = :numeroCliente, 
                emailCliente = :emailCliente, cpfCliente = :cpfCliente, statusCliente = :statusCliente WHERE idCliente = :idCliente";

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nomeCliente', $this->nomeCliente);
        $stmt->bindParam(':enderecoCliente', $this->enderecoCliente);
        $stmt->bindParam(':numeroCliente', $this->numeroCliente);
        $stmt->bindParam(':emailCliente', $this->emailCliente);
        $stmt->bindParam(':cpfCliente', $this->cpfCliente);
        $stmt->bindParam(':statusCliente', $this->statusCliente);
        $stmt->bindParam(':idCliente', $this->idCliente);

        $stmt->execute();

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
