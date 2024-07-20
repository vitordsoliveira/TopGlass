<?php

require_once('Conexao.php');

class ClassOrcamento
{
    public $idOrcamento;
    public $idCliente;
    public $idServicos;
    public $idServico;
    public $idItens;
    public $idFuncionario;
    public $valorOrcamento;
    public $statusOrcamento;
    public $comentOrcamento;
    public $valorItens;  // Adicionado

    public function __construct($id = false)
    {
        if ($id) {
            $this->idOrcamento = $id;
            $this->Carregar();
        }
    }

    // CARREGAR
    public function Carregar()
    {
        $sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = :idOrcamento";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idOrcamento', $this->idOrcamento, PDO::PARAM_INT);
        $stmt->execute();
        $orcamento = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($orcamento) {
            $this->idOrcamento = $orcamento['idOrcamento'];
            $this->idCliente = $orcamento['idCliente'];
            $this->idServico = $orcamento['idServico'];
            $this->idItens = $orcamento['idItens'];
            $this->idFuncionario = $orcamento['idFuncionario'];
            $this->valorOrcamento = $orcamento['valorOrcamento'];
            $this->statusOrcamento = $orcamento['statusOrcamento'];
            $this->comentOrcamento = $orcamento['comentOrcamento'];
            $this->valorItens = $orcamento['valorItens'] ?? 0; // Definido como 0 se não existir
        } else {
            echo 'Erro: Orçamento não encontrado';
        }
    }

    // LISTAR
    public function Listar()
    {
        $sql = "SELECT 
                    tbl_orcamento.idOrcamento,
                    tbl_cliente.nomeCliente,
                    tbl_cliente.cpfCliente,
                    tbl_cliente.numeroCliente,
                    tbl_servico.nomeServicos AS nomeServicos,
                    tbl_produto.nomeProduto,
                    DATE_FORMAT(tbl_orcamento.dataOrcamento, '%d/%m/%Y') AS dataOrcamento,
                    tbl_funcionario.nomeFuncionario,
                    tbl_orcamento.comentOrcamento,
                    tbl_orcamento.valorOrcamento,
                    tbl_orcamento.statusOrcamento,
                    tbl_itens.valorItens
                FROM 
                    tbl_orcamento
                INNER JOIN 
                    tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
                INNER JOIN 
                    tbl_funcionario ON tbl_orcamento.idFuncionario = tbl_funcionario.idFuncionario
                INNER JOIN 
                    tbl_servico ON tbl_orcamento.idServico = tbl_servico.idServico
                INNER JOIN 
                    tbl_itens ON tbl_orcamento.idItens = tbl_itens.idItens
                INNER JOIN 
                    tbl_produto ON tbl_itens.idProduto = tbl_produto.idProduto
                WHERE 
                    tbl_orcamento.statusOrcamento = 'ATIVO'
                    AND tbl_cliente.statusCliente = 'ATIVO'
                    AND tbl_funcionario.statusFuncionario = 'ATIVO'
                    AND tbl_servico.statusServicos = 'ATIVO'
                ORDER BY 
                    tbl_orcamento.dataOrcamento DESC";

        $conn = Conexao::LigarConexao();
        $stmt = $conn->query($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    // INSERIR
    public function Inserir()
    {
        $sql = "INSERT INTO tbl_orcamento 
                (
                    idCliente, 
                    idServico, 
                    idItens, 
                    idFuncionario, 
                    valorOrcamento, 
                    statusOrcamento,
                    comentOrcamento

                )
                VALUES (
                    :idCliente,
                    :idServico,
                    :idItens,
                    :idFuncionario,
                    :valorOrcamento,
                    :statusOrcamento,
                    :comentOrcamento,
                )";

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idServico', $this->idServico);
        $stmt->bindParam(':idItens', $this->idItens);
        $stmt->bindParam(':idFuncionario', $this->idFuncionario);
        $stmt->bindParam(':valorOrcamento', $this->valorOrcamento);
        $stmt->bindParam(':statusOrcamento', $this->statusOrcamento);
        $stmt->bindParam(':comentOrcamento', $this->comentOrcamento);
        $stmt->execute();
    }

    // ATUALIZAR
    public function Atualizar() {
        try {
            $sql = "UPDATE tbl_orcamento 
                    SET idCliente = :idCliente, 
                        idFuncionario = :idFuncionario, 
                        valorOrcamento = :valorOrcamento, 
                        statusOrcamento = :statusOrcamento, 
                        comentOrcamento = :comentOrcamento, 
                        idItens = :idItens 
                    WHERE idOrcamento = :idOrcamento";
            
            $stmt = Conexao::LigarConexao()->prepare($sql);
    
            $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->bindParam(':valorOrcamento', $this->valorOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':statusOrcamento', $this->statusOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':comentOrcamento', $this->comentOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':idItens', $this->idItens, PDO::PARAM_INT);
            $stmt->bindParam(':idOrcamento', $this->idOrcamento, PDO::PARAM_INT);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
    

    // DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_orcamento SET statusOrcamento = 'INATIVO' WHERE idOrcamento = :idOrcamento";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idOrcamento', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
