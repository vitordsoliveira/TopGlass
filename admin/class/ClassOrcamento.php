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

        if ($resultado) {
            $orcamento = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($orcamento) {
                $this->idOrcamento = $orcamento['idOrcamento'];
                $this->idServicos = $orcamento['idServicos'];
                $this->idCliente = $orcamento['idCliente'];
                $this->idServico = $orcamento['idServico'];
                $this->idItens = $orcamento['idItens'];
                $this->idFuncionario = $orcamento['idFuncionario'];
                $this->valorOrcamento = $orcamento['valorOrcamento'];
                $this->statusOrcamento = $orcamento['statusOrcamento'];
                $this->comentOrcamento = $orcamento['comentOrcamento'];
            } else {
                echo 'Erro: Orçamento não encontrado';
            }
        } else {
            echo 'Erro: Falha na consulta SQL';
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
    tbl_funcionario_exec.nomeFuncionario AS Executado
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
INNER JOIN 
    tbl_serv_exe ON tbl_orcamento.idOrcamento = tbl_serv_exe.idOrcamento
INNER JOIN 
    tbl_funcionario AS tbl_funcionario_exec ON tbl_serv_exe.idFuncionario = tbl_funcionario_exec.idFuncionario
WHERE 
    tbl_orcamento.idOrcamento
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
                                           idServicos = '" . $this->idServicos . "',
                                           idCliente = '" . $this->idCliente . "',
                                           idServico = '" . $this->idServico . "',
                                           idItens = '" . $this->idItens . "',
                                           idFuncionario = '" . $this->idFuncionario . "',
                                           valorOrcamento = '" . $this->valorOrcamento . "',
                                           comentOrcamento = '" . $this->comentOrcamento . "',
                                           Executado = '" . $this->Executado . "',
                                           statusOrcamento = '" . $this->statusOrcamento . "'
                    WHERE idOrcamento = $this->idOrcamento";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        // Recuperar informações do cliente
        $sqlCliente = "SELECT nomeCliente, cpfCliente, numeroCliente FROM tbl_cliente WHERE idCliente = :idCliente";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->bindParam(':idCliente', $this->idCliente);
        $stmtCliente->execute();
        $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            echo "Nome do Cliente: " . $cliente['nomeCliente'] . "<br>";
            echo "CPF do Cliente: " . $cliente['cpfCliente'] . "<br>";
            echo "Número do Cliente: " . $cliente['numeroCliente'] . "<br>";
        }

        //Nome do Funcionario
        $sqlFuncionario = "SELECT nomeFuncionario FROM tbl_funcionario WHERE idFuncionario = :idFuncionario";
        $stmtFuncionario = $conn->prepare($sqlFuncionario);
        $stmtFuncionario->bindParam(':idFuncionario', $this->idFuncionario);
        $stmtFuncionario->execute();
        $funcionario = $stmtFuncionario->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            echo "Nome do Funcionário: " . $funcionario['nomeFuncionario'] . "<br>";
        }
    }


    //DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_orcamento SET statusOrcamento = 'INATIVO' WHERE idOrcamento = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo "<script> document.location='index.php?p=orcamento' </script>";
    }
    
}