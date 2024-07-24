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

    header("Location: index.php?p=orcamento&orc=atualizar&id={$id}&msg=success");
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

// Obter dados de todos os clientes ativos
$clientesAtivos = obterClientesAtivos();

// Função para obter os dados dos clientes ativos
function obterClientesAtivos()
{
    $conn = Conexao::LigarConexao();
    $sql = "SELECT idCliente, nomeCliente, cpfCliente, numeroCliente FROM tbl_cliente WHERE statusCliente = 'ATIVO'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$clientes = obterClientesAtivos();

// Função para obter os serviços por tipo
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
        'ALUMINIO' => [],
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
            case 'ALUMINIO':
                $servicosPorTipo['ALUMINIO'][] = [
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

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

if ($msg === 'success') {
    echo '<h2 class="text-success">Orçamento atualizado com sucesso!</h2>';

}

function obterItens()
{
    $conn = Conexao::LigarConexao();
    $sql = "SELECT 
                tbl_itens.idItens,
                tbl_produto.nomeProduto,
                tbl_produto.valorProduto
            FROM 
                tbl_itens 
            INNER JOIN 
                tbl_produto ON tbl_itens.idProduto = tbl_produto.idProduto
            WHERE
                tbl_produto.statusProduto = 'ATIVO';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obter dados dos itens
$itens = obterItens();
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
                                value="<?php echo ($cliente->cpfCliente); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="numeroCliente" class="form-label">Número:</label>
                            <input type="text" class="form-control" id="numeroCliente" name="numeroCliente"
                                value="<?php echo ($cliente->numeroCliente); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($servicosPorTipo as $tipo => $servicos): ?>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="idServico<?php echo $tipo; ?>" class="form-label">Serviços <?php echo $tipo; ?></label>
                            <select name="idServico<?php echo $tipo; ?>" id="idServico<?php echo $tipo; ?>" class="form-select">
                                <option value="">Selecione o Serviço</option>
                                <?php foreach ($servicos as $servico): ?>
                                    <option value="<?php echo $servico['idServico']; ?>"
                                            <?php echo (isset($orcamentoData->{'idServico' . $tipo}) && $servico['idServico'] == $orcamentoData->{'idServico' . $tipo}) ? 'selected' : ''; ?>>
                                        <?php echo ($servico['nomeServico']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="idItens" class="form-label">Itens:</label>
                    <select class="form-select" id="idItens" name="idItens" required>
                        <option value="">Selecione o Item</option>
                        <?php foreach ($itens as $item): ?>
                            <option value="<?php echo $item['idItens']; ?>" data-valor="<?php echo $item['valorProduto']; ?>"
                                <?php echo ($item['idItens'] == $orcamentoData->idItens) ? 'selected' : ''; ?>>
                                <?php echo $item['nomeProduto']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="valorItens" class="form-label">Valor do Item:</label>
                    <input type="text" class="form-control" id="valorItens" name="valorItens" readonly
                        value="<?php echo isset($orcamentoData->valorItens) ? $orcamentoData->valorItens : ''; ?>">
                </div>
            </div>
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
                            echo '<option value="' . ($rowFuncionario['idFuncionario']) . '" ' . $selected . '>' . ($rowFuncionario['nomeFuncionario']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="valorOrcamento" class="form-label">VALOR</label>
                        <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento"
                            value="<?php echo ($orcamentoData->valorOrcamento); ?>">
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
                                <?php echo ($orcamentoData->statusOrcamento == 'DESATIVO') ? 'selected' : ''; ?>>DESATIVO
                            </option>
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
        </form>
    </div>

<!-- JavaScript para lidar com a desativação de outras seleções -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var clientes = <?php echo json_encode($clientes); ?>;
    var clienteSelect = document.getElementById('idCliente');

    // Função para desativar e limpar outras seleções
    function disableAndClearOther(selectedElement, otherElementId) {
        var otherSelect = document.querySelector(otherElementId);
        otherSelect.disabled = true;
        otherSelect.value = '';
    }

    // Função para habilitar todas as seleções
    function enableAllServices() {
        var selects = document.querySelectorAll('#idServicoVIDRO, #idServicoESQUADRIA, #idServicoESPELHO');
        selects.forEach(select => {
            select.disabled = false;
        });
    }

    // Função para verificar e desativar outras seleções
    function handleServiceSelection() {
        var vidroSelect = document.getElementById('idServicoVIDRO');
        var esquadriaSelect = document.getElementById('idServicoESQUADRIA');
        var espelhoSelect = document.getElementById('idServicoESPELHO');

        // Se a opção padrão estiver selecionada, habilitar todos os serviços
        if (vidroSelect.value === '' && esquadriaSelect.value === '' && espelhoSelect.value === '') {
            enableAllServices();
        } else {
            // Desativar seletores de serviço quando um serviço é selecionado
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
        }
    }

    // Verificar seleção inicial
    handleServiceSelection();

    // Adicionar eventos de mudança para cada tipo de serviço
    var vidroSelect = document.getElementById('idServicoVIDRO');
    var esquadriaSelect = document.getElementById('idServicoESQUADRIA');
    var espelhoSelect = document.getElementById('idServicoESPELHO');

    vidroSelect.addEventListener('change', handleServiceSelection);
    esquadriaSelect.addEventListener('change', handleServiceSelection);
    espelhoSelect.addEventListener('change', handleServiceSelection);

    // Evento para carregar dados do cliente ao selecionar um cliente
    clienteSelect.addEventListener('change', function () {
        var idCliente = this.value;
        var cpfClienteField = document.getElementById('cpfCliente');
        var numeroClienteField = document.getElementById('numeroCliente');

        if (idCliente) {
            var cliente = clientes.find(cli => cli.idCliente == idCliente);
            cpfClienteField.value = cliente ? cliente.cpfCliente : '';
            numeroClienteField.value = cliente ? cliente.numeroCliente : '';
        } else {
            cpfClienteField.value = '';
            numeroClienteField.value = '';
        }
    });

    // Atualizar o valor do item selecionado
    var itensSelect = document.getElementById('idItens');
    var valorItensInput = document.getElementById('valorItens');

    itensSelect.addEventListener('change', function () {
        var selectedItem = itensSelect.options[itensSelect.selectedIndex];
        var valor = selectedItem.getAttribute('data-valor');
        valorItensInput.value = valor;
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var clientes = <?php echo json_encode($clientes); ?>;
    var clienteSelect = document.getElementById('idCliente');

    clienteSelect.addEventListener('change', function() {
        var idCliente = this.value;
        var cpfClienteField = document.getElementById('cpfCliente');
        var numeroClienteField = document.getElementById('numeroCliente');

        if (idCliente) {
            var cliente = clientes.find(cli => cli.idCliente == idCliente);
            cpfClienteField.value = cliente ? cliente.cpfCliente : '';
            numeroClienteField.value = cliente ? cliente.numeroCliente : '';
        } else {
            cpfClienteField.value = '';
            numeroClienteField.value = '';
        }
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var itensSelect = document.getElementById('idItens');
        var valorItensInput = document.getElementById('valorItens');

        itensSelect.addEventListener('change', function () {
            var selectedItem = itensSelect.options[itensSelect.selectedIndex];
            var valor = selectedItem.getAttribute('data-valor');
            valorItensInput.value = valor;
        });
    });
</script>



