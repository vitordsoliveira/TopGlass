<?php

require_once ('Conexao.php');

class ClassOrcamento
{
    public $idServicos;
    public $idCliente;
    public $idServico;
    public $idItens;
    public $idFuncionario;
    public $valorOrcamento;
    public $statusOrcamento;
    public $comentOrcamento;

        // LISTAR
        public function Listar(){
            $sql = "SELECT 
            tbl_cliente.nomeCliente,
            tbl_servico.nomeServicos AS nomeServicos,
            tbl_itens.idProduto,
            tbl_orcamento.dataOrcamento,
            tbl_funcionario.nomeFuncionario,
            tbl_orcamento.comentOrcamento,
            tbl_orcamento.valorOrcamento,
            tbl_orcamento.statusOrcamento
        FROM 
            tbl_orcamento
        INNER JOIN 
            tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
        INNER JOIN 
            tbl_servico ON tbl_orcamento.idServico = tbl_servico.idServico
        INNER JOIN 
            tbl_itens ON tbl_orcamento.idItens = tbl_itens.idItens
        INNER JOIN 
            tbl_funcionario ON tbl_orcamento.idFuncionario = tbl_funcionario.idFuncionario
            ORDER BY tbl_orcamento.dataOrcamento DESC;";
    
            $conn = Conexao::LigarConexao();
    
            $resultado = $conn->query($sql);
    
            $lista = $resultado->fetchAll();
    
            return $lista;
    
        }

     //INSERIR

    public function Inserir()
    {
        $sql = "INSERT INT tbl_orcamento 
        (idServicos, 
        idCliente, 
        idServico, 
        idItens, 
        idFuncionario, 
        valorOrcamento, 
        statusOrcamento, 
        comentOrcamento)

        VALUES ('$this->idServicos',
                '$this->idCliente',
                '$this->idServico',
                '$this->idItens',
                '$this->idFuncionario',
                '$this->valorOrcamento'
                '$this->statusOrcamento'
                '$this->comentOrcamento')";

        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=orcamento'</script>";

    }



}