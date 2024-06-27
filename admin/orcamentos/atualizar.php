<?php
require_once ('class/ClassCliente.php');
require_once ('class/ClassOrcamento.php');
require_once ('class/Conexao.php');

$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Carregar cliente associado ao orçamento
$clienteId = $orcamento->idCliente;
$cliente = new ClassCliente($clienteId);
$cliente->Carregar(); // Carregar dados do cliente associado

if (isset($_POST['valorOrcamento'])) {
    $idCliente = $_POST['idCliente'];
    $idServicoVidro = $_POST['idServicosVidro'];
    $idServicoEsquadria = $_POST['idServicosEsquadria'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];

    // Atualizar dados do orçamento
    $orcamento->idCliente = $idCliente;
    $orcamento->idServicoVidro = $idServicoVidro;
    $orcamento->idServicoEsquadria = $idServicoEsquadria;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;

    $orcamento->Atualizar();

    // Carregar dados atualizados do cliente associado
    $cliente->Carregar();
}

$conn = Conexao::LigarConexao();
$sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = :idOrcamento";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idOrcamento', $id, PDO::PARAM_INT);
$stmt->execute();
$orcamentoData = $stmt->fetch(PDO::FETCH_OBJ);

function obterServicosPorTipo()
{
    $conn = Conexao::LigarConexao();

    $sql = "SELECT 
                tbl_servico.idServico, 
                tbl_servico.nomeServicos, 
                tbl_tipo_servico.tipoServico 
            FROM 
                tbl_servico
            INNER JOIN 
                tbl_tipo_servico ON tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico 
            WHERE 
                tbl_servico.statusServicos = 'ATIVO' 
                AND tbl_tipo_servico.statusServico = 'ATIVO';";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $servicosPorTipo = [
        'VIDRO' => [],
        'ESQUADRIA' => [],
        'ESPELHO' => [],
    ];

    foreach ($servicos as $servico) {
        if ($servico['tipoServico'] == 'VIDRO') {
            $servicosPorTipo['VIDRO'][] = $servico;
        } else if ($servico['tipoServico'] == 'ESQUADRIA') {
            $servicosPorTipo['ESQUADRIA'][] = $servico;
        } else if ($servico['tipoServico'] == 'ESPELHO') {
            $servicosPorTipo['ESPELHO'][] = $servico;
        }
    }

    return $servicosPorTipo;
}

$servicosPorTipo = obterServicosPorTipo();

function obterClientesAtivos()
{
    $conn = Conexao::LigarConexao();

    $sql = "SELECT idCliente, nomeCliente FROM tbl_cliente WHERE statusCliente = 'ATIVO'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $clientes;
}

$clientes = obterClientesAtivos();
?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=atualizar&id=<?php echo $id; ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <h3>EDITAR ORÇAMENTO</h3>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idCliente" class="form-label">Cliente:</label>
                        <select class="form-select" id="idCliente" name="idCliente" required>
                            <option value="">Selecione o Cliente</option>
                            <?php foreach ($clientes as $cli): ?>
                                <option value="<?php echo $cli['idCliente']; ?>" <?php echo ($cli['idCliente'] == $orcamentoData->idCliente) ? 'selected' : ''; ?>>
                                    <?php echo $cli['nomeCliente']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" readonly
                            value="<?php echo $cliente->cpfCliente; ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="numeroCliente" class="form-label">Número:</label>
                        <input type="text" class="form-control" id="numeroCliente" name="numeroCliente" readonly
                            value="<?php echo $cliente->numeroCliente; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="options col-3">
                <label for="idServicosVidro" class="form-label">Serviços Vidro</label>
                <select name="idServicosVidro" id="idServicosVidro" class="form-select" required>
                    <?php if (!empty($servicosPorTipo['VIDRO'])): ?>
                        <?php foreach ($servicosPorTipo['VIDRO'] as $servico): ?>
                            <option value="<?php echo $servico['idServico']; ?>" <?php echo ($servico['idServico'] == $orcamentoData->idServicoVidro) ? 'selected' : ''; ?>>
                                <?php echo $servico['nomeServicos']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Nenhum serviço de vidro disponível</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="options col-3">
                <label for="idServicosEsquadria" class="form-label">Serviços Esquadria</label>
                <select name="idServicosEsquadria" id="idServicosEsquadria" class="form-select" required>
                    <?php if (!empty($servicosPorTipo['ESQUADRIA'])): ?>
                        <?php foreach ($servicosPorTipo['ESQUADRIA'] as $servico): ?>
                            <option value="<?php echo $servico['idServico']; ?>" <?php echo ($servico['idServico'] == $orcamentoData->idServicoEsquadria) ? 'selected' : ''; ?>>
                                <?php echo $servico['nomeServicos']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Nenhum serviço de esquadria disponível</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="idFuncionario" class="form-label">Funcionário Responsável</label>
                <select name="idFuncionario" id="idFuncionario" class="form-select" required>
                    <option value="">Selecione o Funcionário</option>
                    <?php
                    $queryFuncionarios = "SELECT idFuncionario, nomeFuncionario FROM tbl_funcionario";
                    $stmtFuncionarios = $conn->prepare($queryFuncionarios);
                    $stmtFuncionarios->execute();
                    while ($rowFuncionario = $stmtFuncionarios->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($rowFuncionario['idFuncionario'] == $orcamentoData->idFuncionario) ? 'selected' : '';
                        echo '<option value="' . $rowFuncionario['idFuncionario'] . '" ' . $selected . '>' . $rowFuncionario['nomeFuncionario'] . '</option>';
                    }
                    ?>


                </select>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="valorOrcamento" class="form-label">VALOR</label>
                    <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento" required
                        value="<?php echo ($orcamentoData->valorOrcamento); ?>">
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="statusOrcamento" class="form-label">STATUS</label>
                    <select class="form-select" id="statusOrcamento" name="statusOrcamento" required>
                        <option value="ATIVO" <?php echo ($orcamentoData->statusOrcamento == 'ATIVO') ? 'selected' : ''; ?>>ATIVO</option>
                        <option value="DESATIVO" <?php echo ($orcamentoData->statusOrcamento == 'DESATIVO') ? 'selected' : ''; ?>>DESATIVO</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="comentOrcamento" class="form-label">Comentário</label>
            <textarea name="comentOrcamento" id="comentOrcamento" class="form-control" cols="65" rows="10"
                placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
                required><?php echo ($orcamentoData->comentOrcamento); ?></textarea>
        </div>
        <div class="btnEnviar col-2">
            <button type="submit" class="btn btn-primary">Editar Orçamento</button>
        </div>
</div>
</form>
</div>