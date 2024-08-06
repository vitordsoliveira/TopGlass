<?php

require_once ('Conexao.php');

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
            $this-> CarregarOrcamento();
        }
    }

    // CARREGAR
    public function CarregarOrcamento()
    {
        $sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = $this->idOrcamento;";
        
        $conn = Conexao::LigarConexao();                
        $resultado = $conn->query($sql);                
        $orcamento = $resultado->fetch();  

        $this->idOrcamento = $orcamento['idOrcamento'];
        $this->idCliente = $orcamento['idCliente'];
        $this->idServico = $orcamento['idServico'];
        $this->idFuncionario = $orcamento['idFuncionario'];
        $this->valorOrcamento = $orcamento['valorOrcamento'];
        $this->statusOrcamento = $orcamento['statusOrcamento'];
        $this->comentOrcamento = $orcamento['comentOrcamento'];
        $this->situacaoOrcamento = $orcamento['situacaoOrcamento'];
        $this->idProduto = $orcamento['idProduto'];

    }

    // LISTAR
    public function Listar($status = '', $situacao = '')
    {
        // Inicia a cláusula WHERE com os filtros padrão
        $where = "WHERE tbl_cliente.statusCliente = 'ATIVO'
                  AND tbl_funcionario.statusFuncionario = 'ATIVO'
                  AND tbl_servico.statusServicos = 'ATIVO'";
    
        // Adiciona o filtro para status do orçamento
        if ($status) {
            // Se status for "ATIVO" ou "INATIVO", busca ambos
            if ($status === 'ATIVO' || $status === 'INATIVO') {
                $where .= " AND tbl_orcamento.statusOrcamento = :status";
            }
        } else {
            // Por padrão, exibe apenas os orçamentos ativos
            $where .= " AND tbl_orcamento.statusOrcamento = 'ATIVO'";
        }
    
        // Adiciona o filtro para a situação do orçamento
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
    
        // Vincula o parâmetro do status se necessário
        if ($status && ($status === 'ATIVO' || $status === 'INATIVO')) {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }
        // Vincula o parâmetro da situação se necessário
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
                        :comentOrcamento,
                        :situacaoOrcamento,
                        :idProduto
                    )";
            $conn = Conexao::LigarConexao();
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);
            $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
            $stmt->bindParam(':valorOrcamento', $this->valorOrcamento, PDO::PARAM_STR);
            $stmt->bindParam(':statusOrcamento', $this->statusOrcamento, PDO::PARAM_STR);
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
        $sql = "UPDATE tbl_orcamento 
                    SET idCliente = :idCliente,
                        idServico = :idServico,
                        idFuncionario = :idFuncionario,
                        valorOrcamento = :valorOrcamento,
                        statusOrcamento = :statusOrcamento,
                        comentOrcamento = :comentOrcamento,
                        situacaoOrcamento = :situacaoOrcamento,
                        idProduto = :idProduto
                    WHERE idOrcamento = :idOrcamento";
    
        $conn = Conexao::LigarConexao();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
        $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);
        $stmt->bindParam(':idFuncionario', $this->idFuncionario, PDO::PARAM_INT);
        $stmt->bindParam(':valorOrcamento', $this->valorOrcamento, PDO::PARAM_STR);
        $stmt->bindParam(':statusOrcamento', $this->statusOrcamento, PDO::PARAM_STR);
        $stmt->bindParam(':comentOrcamento', $this->comentOrcamento, PDO::PARAM_STR);
        $stmt->bindParam(':situacaoOrcamento', $this->situacaoOrcamento, PDO::PARAM_STR);
        $stmt->bindParam(':idProduto', $this->idProduto, PDO::PARAM_INT);
        $stmt->bindParam(':idOrcamento', $this->idOrcamento, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            // Redirecionar com uma mensagem de sucesso
            echo "<script>window.location.href='index.php?p=orcamento&orc=atualizar&id={$this->idOrcamento}&msg=success';</script>";
        } else {
            // Redirecionar com uma mensagem de erro
            echo "<script>window.location.href='index.php?p=orcamento&orc=atualizar&id={$this->idOrcamento}&msg=error';</script>";
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