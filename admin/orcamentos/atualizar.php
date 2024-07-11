<?php

require_once('class/ClassCliente.php');
require_once('class/ClassOrcamento.php');
require_once('class/Conexao.php');

$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Carregar cliente associado ao orçamento
$clienteId = $orcamento->idCliente;
$cliente = new ClassCliente($clienteId);
$cliente->Carregar(); // Carregar dados do cliente associado

if (isset($_POST['valorOrcamento'])) {
    $idCliente = $_POST['idCliente'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];

    // Atualizar dados do orçamento
    $orcamento->idCliente = $idCliente;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;

    $orcamento->Atualizar();
    $cliente->Carregar();

    // Redirecionar para evitar reenvio de formulário ao atualizar
    header("Location: index.php?p=orcamento&orc=atualizar&id={$id}");
    exit();
}

// Conectar ao banco de dados e obter dados do orçamento
$conn = Conexao::LigarConexao();
$sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = :idOrcamento";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idOrcamento', $id, PDO::PARAM_INT);
$stmt->execute();
$orcamentoData = $stmt->fetch(PDO::FETCH_OBJ);

// Definir valores padrão caso sejam nulos
$orcamentoData->idFuncionario = $orcamentoData->idFuncionario ?? '';
$orcamentoData->valorOrcamento = $orcamentoData->valorOrcamento ?? '';
$orcamentoData->statusOrcamento = $orcamentoData->statusOrcamento ?? '';
$orcamentoData->comentOrcamento = $orcamentoData->comentOrcamento ?? '';

function obterServicosPorTipo()
{
    $conn = Conexao::LigarConexao();

    $sql = "SELECT 
                s.idServico, 
                s.nomeServicos, 
                ts.tipoServico 
            FROM 
                tbl_servico s
            INNER JOIN 
                tbl_tipo_servico ts ON s.idTipoServico = ts.idTipoServico 
            WHERE 
                s.statusServicos = 'ATIVO' 
                AND ts.statusServico = 'ATIVO';";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $servicosPorTipo = [
        'VIDRO' => [],
        'ESQUADRIA' => [],
        'ESPELHO' => [],
    ];

    foreach ($servicos as $servico) {
        switch ($servico['tipoServico']) {
            case 'VIDRO':
                $servicosPorTipo['VIDRO'][] = [
                    'idServico' => $servico['idServico'],
                    'nomeServico' => $servico['nomeServicos']
                ];
                break;
            case 'ESQUADRIA':
                $servicosPorTipo['ESQUADRIA'][] = [
                    'idServico' => $servico['idServico'],
                    'nomeServico' => $servico['nomeServicos']
                ];
                break;
            case 'ESPELHO':
                $servicosPorTipo['ESPELHO'][] = [
                    'idServico' => $servico['idServico'],
                    'nomeServico' => $servico['nomeServicos']
                ];
                break;
            default:
                // Lidar com outros tipos se necessário
                break;
        }
    }

    return $servicosPorTipo;
}

// Chamar a função para obter os serviços por tipo
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
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            value="<?php echo htmlspecialchars($cliente->cpfCliente); ?>" readonly>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="numeroCliente" class="form-label">Número:</label>
                        <input type="text" class="form-control" id="numeroCliente" name="numeroCliente"
                            value="<?php echo htmlspecialchars($cliente->numeroCliente); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($servicosPorTipo as $tipo => $servicos): ?>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idServico<?php echo $tipo; ?>" class="form-label">Serviços <?php echo $tipo; ?></label>
                        <select name="idServico<?php echo $tipo; ?>" id="idServico<?php echo $tipo; ?>" class="form-select"
                            required <?php echo ($tipo !== 'VIDRO' && $tipo !== 'ESQUADRIA' && $tipo !== 'ESPELHO') ? 'disabled' : ''; ?>>
                            <option value="">Selecione o Serviço</option>
                            <?php foreach ($servicos as $servico): ?>
                                <option value="<?php echo $servico['idServico']; ?>"
                                    <?php echo (isset($orcamentoData->{'idServico'.$tipo}) && $servico['idServico'] == $orcamentoData->{'idServico'.$tipo}) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($servico['nomeServico']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="idFuncionario" class="form-label">Funcionário Responsável</label>
                <select name="idFuncionario" id="idFuncionario" class="form-select" required>
                    <option value="">Selecione o Funcionário</option>
                    <?php
                    $queryFuncionarios = "SELECT idFuncionario, nomeFuncionario FROM tbl_funcionario WHERE statusFuncionario = 'ATIVO'";
                    $stmtFuncionarios = $conn->prepare($queryFuncionarios);
                    $stmtFuncionarios->execute();
                    while ($rowFuncionario = $stmtFuncionarios->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($rowFuncionario['idFuncionario'] == $orcamentoData->idFuncionario) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($rowFuncionario['idFuncionario']) . '" ' . $selected . '>' . htmlspecialchars($rowFuncionario['nomeFuncionario']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="valorOrcamento" class="form-label">VALOR</label>
                    <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento"
                        value="<?php echo htmlspecialchars($orcamentoData->valorOrcamento); ?>">
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="statusOrcamento" class="form-label">STATUS</label>
                    <select class="form-select" id="statusOrcamento" name="statusOrcamento" required>
                        <option value="ATIVO" <?php echo ($orcamentoData->statusOrcamento == 'ATIVO') ? 'selected' : ''; ?>>
                            ATIVO
                        </option>
                        <option value="DESATIVO"
                            <?php echo ($orcamentoData->statusOrcamento == 'DESATIVO') ? 'selected' : ''; ?>>INATIVO
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="comentOrcamento" class="form-label">Comentário</label>
            <textarea name="comentOrcamento" id="comentOrcamento" class="form-control" cols="65" rows="10"
                placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
                required><?php echo htmlspecialchars($orcamentoData->comentOrcamento); ?></textarea>
        </div>
        <div class="btnEnviar col-2">
            <button type="submit" class="btn btn-primary">Editar Orçamento</button>
        </div>
    </form>
</div>

<!-- JavaScript para lidar com a desativação de outras seleções -->
<script>
    function disableAndClearOther(selectedElement, otherElementId) {
        var otherSelect = document.querySelector(otherElementId);
        otherSelect.disabled = true;
        otherSelect.value = '';
    }

    // Desativar e limpar outras opções de seleção ao selecionar um tipo de serviço
    document.addEventListener('DOMContentLoaded', function () {
        var vidroSelect = document.getElementById('idServicoVIDRO');
        var esquadriaSelect = document.getElementById('idServicoESQUADRIA');
        var espelhoSelect = document.getElementById('idServicoESPELHO');

        // Verificar qual serviço está selecionado e desativar os outros
        vidroSelect.addEventListener('change', function () {
            disableAndClearOther(vidroSelect, '#idServicoESQUADRIA');
            disableAndClearOther(vidroSelect, '#idServicoESPELHO');
        });

        esquadriaSelect.addEventListener('change', function () {
            disableAndClearOther(esquadriaSelect, '#idServicoVIDRO');
            disableAndClearOther(esquadriaSelect, '#idServicoESPELHO');
        });

        espelhoSelect.addEventListener('change', function () {
            disableAndClearOther(espelhoSelect, '#idServicoVIDRO');
            disableAndClearOther(espelhoSelect, '#idServicoESQUADRIA');
        });

        // Executar a desativação inicial com base na seleção atual
        if (vidroSelect.value !== '') {
            disableAndClearOther(vidroSelect, '#idServicoESQUADRIA');
            disableAndClearOther(vidroSelect, '#idServicoESPELHO');
        } else if (esquadriaSelect.value !== '') {
            disableAndClearOther(esquadriaSelect, '#idServicoVIDRO');
            disableAndClearOther(esquadriaSelect, '#idServicoESPELHO');
        } else if (espelhoSelect.value !== '') {
            disableAndClearOther(espelhoSelect, '#idServicoVIDRO');
            disableAndClearOther(espelhoSelect, '#idServicoESQUADRIA');
        }
    });
</script>
