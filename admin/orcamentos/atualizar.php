<?php

require_once ('class/ClassCliente.php');
require_once ('class/ClassOrcamento.php');
$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Carregar cliente associado ao orçamento
$clienteId = $orcamento->idCliente;
$cliente = new ClassCliente($clienteId);

if (isset($_POST['idServicos'])) {

    $idServicos = $_POST['idServicos'];
    $idCliente = $_POST['idCliente'];
    $idServico = $_POST['idServico'];
    $idItens = $_POST['idItens'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];

    $orcamento->idServicos = $idServicos;
    $orcamento->idCliente = $idCliente;
    $orcamento->idServico = $idServico;
    $orcamento->idItens = $idItens;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;

    $orcamento->Atualizar();

    if (isset($_POST['nomeCliente'])) {

        $nomeCliente = $_POST['nomeCliente'];
        $numeroCliente = $_POST['numeroCliente'];
        $cpfCliente = $_POST['cpfCliente'];

        $cliente->nomeCliente = $nomeCliente;
        $cliente->numeroCliente = $numeroCliente;
        $cliente->cpfCliente = $cpfCliente;

        $cliente->Atualizar();
    }
}

$sql = "
    SELECT 
        tbl_orcamento.idOrcamento,
        tbl_orcamento.idServicos,
        tbl_orcamento.idCliente,
        tbl_orcamento.idServico,
        tbl_orcamento.idItens,
        tbl_orcamento.idFuncionario,
        tbl_orcamento.valorOrcamento,
        tbl_orcamento.statusOrcamento,
        tbl_orcamento.comentOrcamento,
        tbl_cliente.nomeCliente, 
        tbl_cliente.cpfCliente, 
        tbl_cliente.numeroCliente, 
        tbl_funcionario.nomeFuncionario 
    FROM 
        tbl_orcamento
    INNER JOIN 
        tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
    INNER JOIN 
        tbl_funcionario ON tbl_orcamento.idFuncionario = tbl_funcionario.idFuncionario
    WHERE 
        tbl_orcamento.idOrcamento = :idOrcamento
";

$conn = Conexao::LigarConexao();
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idOrcamento', $id, PDO::PARAM_INT);
$stmt->execute();
$orcamentoData = $stmt->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=atualizar&id=<?php echo $id; ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <h3>EDITAR CLIENTE</h3>
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">
                            <p>CPF Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            placeholder="DIGITE O CPF " required
                            value="<?php echo htmlspecialchars($orcamentoData->cpfCliente); ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <p>Nome Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required
                            value="<?php echo htmlspecialchars($orcamentoData->nomeCliente); ?>">
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">
                            <p>Telefone Cliente:</p>
                        </label>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required
                            value="<?php echo htmlspecialchars($orcamentoData->numeroCliente); ?>">
                    </div>
                </div>
            </div>
            <!-- FORM ORC -->
            <h3>REFAZER ORÇAMENTO</h3>
            <div class="row">
                <div class="options col-3">
                    <select name="servicosVidro" id="servicosVidro" class="form-select" required>
                        <option value="servicoVidro" selected>SERVIÇOS VIDRO</option>
                        <option value="Box de Vidro">Box de Vidro</option>
                        <option value="Janela de Vidro">Janela de Vidro</option>
                        <option value="Pia de Vidro">Pia de Vidro</option>
                        <option value="Teto de Vidro">Teto de Vidro</option>
                        <option value="Porta de Vidro">Porta de Vidro</option>
                        <option value="Corrimão de Vidro">Corrimão de Vidro</option>
                    </select>
                </div>
                <div class="options col-3">
                    <select name="servicosEsquadria" id="servicosEsquadria" class="form-select" required>
                        <option value="servicoEsquadria" selected>SERVIÇOS ESQUADRIA</option>
                        <option value="Porta de alumínio">Porta de alumínio</option>
                        <option value="Janela de alumínio">Janela de alumínio</option>
                        <option value="Corrimão de alumínio">Corrimão de alumínio</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="idFuncionario" class="form-label">Funcionário Responsável</label>
                    <select name="idFuncionario" id="idFuncionario" class="form-select" required>
                        <option value="">Selecione o Funcionário</option>
                        <?php
                        // Conexão com o banco e execução da consulta
                        $conn = Conexao::LigarConexao();
                        $query = "SELECT idFuncionario, nomeFuncionario FROM tbl_funcionario";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        // Loop para exibir as opções
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['idFuncionario'] == $orcamentoData->idFuncionario) ? 'selected' : '';
                            echo '<option value="' . $row['idFuncionario'] . '" ' . $selected . '>' . htmlspecialchars($row['nomeFuncionario']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="valorOrcamento" class="form-label">
                            <p>VALOR</p>
                        </label>
                        <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento" required
                            value="<?php echo htmlspecialchars($orcamentoData->valorOrcamento); ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="statusOrcamento" class="form-label">
                            <p>STATUS</p>
                        </label>
                        <select class="form-select" id="statusOrcamento" name="statusOrcamento" required>
                            <option value="statusOrcamento">ATIVO</option>
                            <option value="statusOrcamento">DESATIVO</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="comentOrcamento" class="form-label">
                    <p>Comentário</p>
                </label>
                <textarea name="comentOrcamento" id="comentOrcamento" class="form-control" cols="65" rows="10"
                    placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
                    required><?php echo htmlspecialchars($orcamentoData->comentOrcamento); ?></textarea>
            </div>
            <div class="btnEnviar col-2">
                <button type="submit" class="btn btn-primary">Editar Orçamento</button>
            </div>
        </div>
    </form>
</div>