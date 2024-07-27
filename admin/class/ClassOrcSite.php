<?php

require_once ('Conexao.php');

class ClassOrcSite
{
    public $idOrcamentoSite;
    public $idServico;
    public $nomeCliente;
    public $emailCliente;
    public $numeroCliente;
    public $enderecoCliente;
    public $comentOrcamento;
    public $alturaOrcamento;
    public $larguraOrcamento;


    public function __construct($id = false)
    {
        if ($id) {
            $this->idOrcamentoSite = $id;
            $this->Carregar();
        }
    }

    // CARREGAR
    public function Carregar()
    {
        $sql = "SELECT * FROM tbl_orcamento_site WHERE idOrcamentoSite = :idOrcamentoSite";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idOrcamentoSite', $this->idOrcamentoSite, PDO::PARAM_INT);
        $stmt->execute();
        $orcamento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($orcamento) {
            $this->idOrcamentoSite = $orcamento['idOrcamentoSite'];
            $this->idServico = $orcamento['idServico'];
            $this->nomeCliente = $orcamento['nomeCliente'];
            $this->emailCliente = $orcamento['emailCliente'];
            $this->numeroCliente = $orcamento['numeroCliente'];
            $this->enderecoCliente = $orcamento['enderecoCliente'];
            $this->comentOrcamento = $orcamento['comentOrcamento'];
            $this->alturaOrcamento = $orcamento['alturaOrcamento'];
            $this->larguraOrcamento = $orcamento['larguraOrcamento'];
            $this->dataCadOrcamento = $orcamento['dataCadOrcamento'];

        } else {
            echo 'Erro: Orçamento não encontrado';
        }
    }

    // LISTAR
    public function Listar()
    {

        $sql = "SELECT idServico,
                        DATE_FORMAT(dataCadOrcamento, '%d/%m/%Y %H:%i:%s')
                        AS dataCadOrcamentoBR,
                        nomeCliente,
                        emailCliente, 
                        numeroCliente, 
                        enderecoCliente, 
                        comentOrcamento, 
                        alturaOrcamento, 
                        larguraOrcamento
                FROM 
                        tbl_orcamento_site;";

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }


    // INSERIR
    public function Inserir()
    {
        $sql = "INSERT INTO tbl_orcamento_site 
            (idServico,
            nomeCliente,
            emailCliente,
            numeroCliente,
            enderecoCliente,
            comentOrcamento,
            alturaOrcamento,
            larguraOrcamento)
            VALUES (:idServico,
            :nomeCliente,
            :emailCliente,
            :numeroCliente,
            :enderecoCliente,
            :comentOrcamento,
            :alturaOrcamento,
            :larguraOrcamento)";
            
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idServico', $this->idServico);
        $stmt->bindParam(':nomeCliente', $this->nomeCliente);
        $stmt->bindParam(':emailCliente', $this->emailCliente);
        $stmt->bindParam(':numeroCliente', $this->numeroCliente);
        $stmt->bindParam(':enderecoCliente', $this->enderecoCliente);
        $stmt->bindParam(':comentOrcamento', $this->comentOrcamento);
        $stmt->bindParam(':alturaOrcamento', $this->alturaOrcamento);
        $stmt->bindParam(':larguraOrcamento', $this->larguraOrcamento);

        return $stmt->execute();
    }

}
