<?php

require_once('Conexao.php');

class ClassOrcamento
{
    public $idOrcamento;
    public $idCliente;
    public $idServico;
    public $idFuncionario;
    public $valorOrcamento;
    public $statusOrcamento;
    public $dataOrcamento;
    public $comentOrcamento;
    public $situacaoOrcamento;
    public $idProduto;

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
            $this->idFuncionario = $orcamento['idFuncionario'];
            $this->valorOrcamento = $orcamento['valorOrcamento'];
            $this->statusOrcamento = $orcamento['statusOrcamento'];
            $this->dataOrcamento = $orcamento['dataOrcamento'];
            $this->comentOrcamento = $orcamento['comentOrcamento'];
            $this->situacaoOrcamento = $orcamento['situacaoOrcamento'];
            $this->idProduto = $orcamento['idProduto'];
        } else {
            echo 'Erro: Orçamento não encontrado';
        }
    }

    // LISTAR
    public function Listar($status = '', $situacao = '')
    {
        // Monta a cláusula WHERE com base nos filtros
        $where = "WHERE tbl_orcamento.statusOrcamento = 'ATIVO'
                  AND tbl_cliente.statusCliente = 'ATIVO'
                  AND tbl_funcionario.statusFuncionario = 'ATIVO'
                  AND tbl_servico.statusServicos = 'ATIVO'";
    
        if ($status) {
            $where .= " AND tbl_orcamento.statusOrcamento = :status";
        }
    
        if ($situacao) {
            $where .= " AND tbl_orcamento.situacaoOrcamento = :situacao";
        }
    
        $sql = "SELECT 
                    tbl_orcamento.idOrcamento,
                    tbl_cliente.nomeCliente,
                    tbl_cliente.cpfCliente,
                    tbl_servico.nomeServicos AS nomeServicos,
                    tbl_produto.nomeProduto,
                    DATE_FORMAT(tbl_orcamento.dataOrcamento, '%d/%m/%Y') AS dataOrcamento,
                    tbl_funcionario.nomeFuncionario,
                    tbl_orcamento.comentOrcamento,
                    tbl_orcamento.valorOrcamento,
                    tbl_orcamento.statusOrcamento,
                    tbl_orcamento.situacaoOrcamento,
                    tbl_orcamento.idProduto
                FROM 
                    tbl_orcamento
                INNER JOIN 
                    tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
                INNER JOIN 
                    tbl_funcionario ON tbl_orcamento.idFuncionario = tbl_funcionario.idFuncionario
                INNER JOIN 
                    tbl_servico ON tbl_orcamento.idServico = tbl_servico.idServico
                LEFT JOIN 
                    tbl_produto ON tbl_orcamento.idProduto = tbl_produto.idProduto
                    $where
                ORDER BY 
                    tbl_orcamento.dataOrcamento DESC;";
    
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
    
        // Bind dos parâmetros de filtro, se existirem
        if ($status) {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        if ($situacao) {
            $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    
    // INSERIR
    public function Inserir()
    {
        try {
            $sql = "INSERT INTO tbl_orcamento 
                    (
                        idCliente, 
                        idServico, 
                        idFuncionario, 
                        valorOrcamento, 
                        statusOrcamento,
                        dataOrcamento,
                        comentOrcamento,
                        situacaoOrcamento,
                        idProduto
                    )
                    VALUES (
                        :idCliente,
                        :idServico,
                        :idFuncionario,
                        :valorOrcamento,
                        :statusOrcamento,
                        :dataOrcamento,
                        :comentOrcamento,
                        :situacaoOrcamento,
                        :idProduto
                    )";
            $conn = Conexao::LigarConexao();
            $stmt = $conn->prepare($sql);
            
            // Bind dos parâmetros
            $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->bindParam(':valorOrcamento', $this->valorOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':statusOrcamento', $this->statusOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':dataOrcamento', $this->dataOrcamento);
            $stmt->bindParam(':comentOrcamento', $this->comentOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':situacaoOrcamento', $this->situacaoOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':idProduto', $this->idProduto, PDO::PARAM_INT);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro: ' . htmlspecialchars($e->getMessage());
        }
    }

    // ATUALIZAR
    public function Atualizar()
    {
        try {
            $sql = "UPDATE tbl_orcamento 
                    SET idCliente = :idCliente,
                        idServico = :idServico,
                        idFuncionario = :idFuncionario,
                        valorOrcamento = :valorOrcamento,
                        statusOrcamento = :statusOrcamento,
                        dataOrcamento = :dataOrcamento,
                        comentOrcamento = :comentOrcamento,
                        situacaoOrcamento = :situacaoOrcamento,
                        idProduto = :idProduto
                    WHERE idOrcamento = :idOrcamento";
    
            $conn = Conexao::LigarConexao();
            $stmt = $conn->prepare($sql);
    
            // Bind all parameters
            $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->bindParam(':valorOrcamento', $this->valorOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':statusOrcamento', $this->statusOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':dataOrcamento', $this->dataOrcamento);
            $stmt->bindParam(':comentOrcamento', $this->comentOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':situacaoOrcamento', $this->situacaoOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':idProduto', $this->idProduto, PDO::PARAM_INT);
            $stmt->bindParam(':idOrcamento', $this->idOrcamento, PDO::PARAM_INT);
    
            // Execute the query
            $stmt->execute();
    
            // Redirect after successful update
            echo "<script>document.location='index.php?p=orcamento&orc=atualizar&id={$this->idOrcamento}&msg=success'</script>";
        } catch (PDOException $e) {
            echo 'Erro: ' . htmlspecialchars($e->getMessage());
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
