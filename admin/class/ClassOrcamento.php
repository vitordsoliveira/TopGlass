<?php

require_once ('Conexao.php');

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
    public $Executado;

    public function __construct($id = false)
    {
        if ($id) {

            $this->idOrcamento = $id;
            $this->Carregar();

        }

    }
    //CARREGAR
    public function Carregar()
    {

        $sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = $this->idOrcamento";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $Orcamento = $resultado->fetch();

        $this->idOrcamento = $Orcamento['idOrcamento'];
        $this->idServicos = $Orcamento['idServicos'];
        $this->idCiente = $Orcamento['idCiente'];
        $this->idServico = $Orcamento['idServico'];
        $this->idItens = $Orcamento['idItens'];
        $this->valorOrcamento = $Orcamento['valorOrcamento'];
        $this->dataOrcamento = $Orcamento['dataOrcamento'];
        $this->comentOrcamento = $Orcamento['comentOrcamento'];
        $this->statusOrcamento = $Orcamento['statusOrcamento'];
    }

    // LISTAR
    public function Listar()
    {
        $sql = "SELECT 
        tbl_cliente.nomeCliente,
        tbl_servico.nomeServicos AS nomeServicos,
        tbl_produto.nomeProduto,
        DATE_FORMAT(tbl_orcamento.dataOrcamento, '%d/%m/%Y') AS dataOrcamento,
        tbl_funcionario.nomeFuncionario,
        tbl_orcamento.comentOrcamento,
        tbl_orcamento.valorOrcamento,
        tbl_orcamento.statusOrcamento,
        tbl_funcionario_exec.nomeFuncionario AS Executado
    FROM 
        tbl_orcamento
    INNER JOIN 
        tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
    INNER JOIN 
        tbl_servico ON tbl_orcamento.idServico = tbl_servico.idServico
    INNER JOIN 
        tbl_itens ON tbl_orcamento.idItens = tbl_itens.idItens
    INNER JOIN 
        tbl_produto ON tbl_itens.idProduto = tbl_produto.idProduto
    INNER JOIN 
        tbl_funcionario ON tbl_orcamento.idFuncionario = tbl_funcionario.idFuncionario
    INNER JOIN 
        tbl_serv_exe ON tbl_orcamento.idOrcamento = tbl_serv_exe.idOrcamento
    INNER JOIN 
        tbl_funcionario AS tbl_funcionario_exec ON tbl_serv_exe.idFuncionario = tbl_funcionario_exec.idFuncionario
    ORDER BY 
        tbl_orcamento.dataOrcamento DESC;";

        $conn = Conexao::LigarConexao();

        $resultado = $conn->query($sql);

        $lista = $resultado->fetchAll();

        return $lista;

    }

    //INSERIR
    public function Inserir()
    {
        $sql = "INSERT INTO tbl_orcamento 
        (idServicos, 
        idCliente, 
        idServico, 
        idItens, 
        idFuncionario, 
        valorOrcamento, 
        statusOrcamento,
        Executado, 
        comentOrcamento)

        VALUES ('$this->idServicos',
                '$this->idCliente',
                '$this->idServico',
                '$this->idItens',
                '$this->idFuncionario',
                '$this->valorOrcamento',
                '$this->statusOrcamento',
                '$this->Executado',
                '$this->comentOrcamento')";

        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=orcamento'</script>";

    }

    //ATUALIZAR
    public function Atualizar()
    {

        $sql = "UPDATE tbl_orcamento SET 
                                           idServicos     = '" . $this->idServicos . "',
                                           idCliente = '" . $this->idCliente . "',
                                           idServico = '" . $this->idServico . "',
                                           idItens = '" . $this->idItens . "',
                                           idFuncionario = '" . $this->idFuncionario . "',
                                           valorOrcamento = '" . $this->valorOrcamento . "',
                                           comentOrcamento = '" . $this->comentOrcamento . "',
                                           statusOrcamento = '" . $this->statusOrcamento . "'
                    WHERE idOrcamento = $this->idOrcamento";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        echo "<script>document.location='index.php?p=orcamento'</script>";

    }

}