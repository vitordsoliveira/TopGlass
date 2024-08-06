<?php
require_once('class/ClassCliente.php');
require_once('class/ClassOrcamento.php');

// Obter o ID do orçamento a partir da URL
$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Verificar se o formulário foi enviado
if (isset($_POST['valorOrcamento'])) {
    // Recuperar os dados enviados pelo formulário
    $idCliente = $_POST['idCliente'];
    $idServico = $_POST['idServico'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];
    $situacaoOrcamento = $_POST['situacaoOrcamento'];
    $idProduto = $_POST['idProduto'];

    // Atualizar as propriedades do objeto orçamento
    $orcamento->idCliente = $idCliente;
    $orcamento->idServico = $idServico;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;
    $orcamento->situacaoOrcamento = $situacaoOrcamento;
    $orcamento->idProduto = $idProduto;

    // Chamar o método de atualização do orçamento
    $orcamento->Atualizar();
    print_r('ATUALIZEI');

    // Redirecionar para a página de orçamentos
    header("Location: index.php?p=orcamento");
    exit();
}

// Função para obter clientes ativos (apenas para preenchimento do formulário)
function obterClientesAtivos() {
    $conn = Conexao::LigarConexao();
    $sql = "SELECT idCliente, nomeCliente, cpfCliente, numeroCliente FROM tbl_cliente WHERE statusCliente = 'ATIVO'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$clientes = obterClientesAtivos();

// Função para obter serviços por tipo (apenas para preenchimento do formulário)
function obterServicosPorTipo() {
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
        $servicosPorTipo[$servico['tipoServico']][] = [
            'idServico' => $servico['idServico'],
            'nomeServico' => $servico['nomeServicos']
        ];
    }

    return $servicosPorTipo;
}
$servicosPorTipo = obterServicosPorTipo();

// Função para obter itens (apenas para preenchimento do formulário)
function obterItens() {
    $conn = Conexao::LigarConexao();
    $sql = "SELECT 
                idProduto, 
                nomeProduto,
                valorProduto
            FROM 
                tbl_produto
            WHERE
                statusProduto = 'ATIVO';";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$itens = obterItens();
?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=atualizar&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idOrcamento" value="<?php echo $orcamento->idOrcamento; ?>">

        <div class="row">
            <h3>ATUALIZAR ORÇAMENTO</h3>
            <div class="row">
                <!-- Cliente, CPF e Número -->
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idCliente" class="form-label">Cliente:</label>
                        <select class="form-select" id="idCliente" name="idCliente" required>
                            <option value="">Selecione o Cliente</option>
                            <?php foreach ($clientes as $cli): ?>
                                <option value="<?php echo $cli['idCliente']; ?>"
                                    data-cpf="<?php echo $cli['cpfCliente']; ?>"
                                    data-numero="<?php echo $cli['numeroCliente']; ?>"
                                    <?php echo $orcamento->idCliente == $cli['idCliente'] ? 'selected' : ''; ?>>
                                    <?php echo $cli['nomeCliente']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" readonly>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-3">
                        <label for="numeroCliente" class="form-label">Número:</label>
                        <input type="text" class="form-control" id="numeroCliente" name="numeroCliente" readonly>
                    </div>
                </div>

                <div class="col-3">
                    <label for="idFuncionario" class="form-label">Funcionário Orçamento:</label>
                    <select class="form-select" id="idFuncionario" name="idFuncionario" required>
                        <option value="">Selecione o Funcionário</option>
                        <?php
                        $conn = Conexao::LigarConexao();
                        $stmt = $conn->prepare("SELECT idFuncionario, nomeFuncionario FROM tbl_funcionario WHERE statusFuncionario = 'ATIVO'");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['idFuncionario'] . "' " . ($orcamento->idFuncionario == $row['idFuncionario'] ? 'selected' : '') . ">" . $row['nomeFuncionario'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-3">
                    <div class="mb-3">
                        <label for="statusOrcamento" class="form-label">Status:</label>
                        <select class="form-select" id="statusOrcamento" name="statusOrcamento" required>
                            <option value="ATIVO" <?php echo $orcamento->statusOrcamento == 'ATIVO' ? 'selected' : ''; ?>>ATIVO</option>
                            <option value="DESATIVO" <?php echo $orcamento->statusOrcamento == 'DESATIVO' ? 'selected' : ''; ?>>DESATIVO</option>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-3">
                        <label for="situacaoOrcamento" class="form-label">SITUAÇÃO</label>
                        <select class="form-select" id="situacaoOrcamento" name="situacaoOrcamento" required>
                            <option value="PENDENTE" <?php echo $orcamento->situacaoOrcamento == 'PENDENTE' ? 'selected' : ''; ?>>PENDENTE</option>
                            <option value="FEITO" <?php echo $orcamento->situacaoOrcamento == 'FEITO' ? 'selected' : ''; ?>>FEITO</option>
                            <option value="PAGO" <?php echo $orcamento->situacaoOrcamento == 'PAGO' ? 'selected' : ''; ?>>PAGO</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Serviços por Tipo -->
            <?php foreach ($servicosPorTipo as $tipo => $servicos): ?>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idServico<?php echo $tipo; ?>" class="form-label">Serviços <?php echo $tipo; ?>:</label>
                        <select class="form-select servico-select" id="idServico<?php echo $tipo; ?>" name="idServico">
                            <option value="">Selecione o Serviço</option>
                            <?php foreach ($servicos as $servico): ?>
                                <option value="<?php echo $servico['idServico']; ?>"
                                    <?php echo $orcamento->idServico == $servico['idServico'] ? 'selected' : ''; ?>>
                                    <?php echo $servico['nomeServico']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <!-- Produtos -->
            <div class="col-4">
                <div class="mb-3">
                    <label for="idProduto" class="form-label">Itens:</label>
                    <select class="form-select" id="idProduto" name="idProduto" required>
                        <option value="">Selecione o Item</option>
                        <?php foreach ($itens as $item): ?>
                            <option value="<?php echo $item['idProduto']; ?>"
                                <?php echo $orcamento->idProduto == $item['idProduto'] ? 'selected' : ''; ?>
                                data-valor="<?php echo $item['valorProduto']; ?>">
                                <?php echo $item['nomeProduto']; ?> - R$ <?php echo number_format($item['valorProduto'], 2, ',', '.'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="valorOrcamento" class="form-label">Valor Orçamento:</label>
                    <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento" value="<?php echo number_format($orcamento->valorOrcamento, 2, ',', '.'); ?>" required>
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="comentOrcamento" class="form-label">Comentário:</label>
                    <textarea class="form-control" id="comentOrcamento" name="comentOrcamento" rows="3"><?php echo $orcamento->comentOrcamento; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Atualizar Orçamento</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('idCliente').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('cpfCliente').value = selectedOption.getAttribute('data-cpf');
        document.getElementById('numeroCliente').value = selectedOption.getAttribute('data-numero');
    });

    window.addEventListener('load', function () {
        var idCliente = document.getElementById('idCliente');
        if (idCliente.value) {
            var selectedOption = idCliente.options[idCliente.selectedIndex];
            document.getElementById('cpfCliente').value = selectedOption.getAttribute('data-cpf');
            document.getElementById('numeroCliente').value = selectedOption.getAttribute('data-numero');
        }
    });

    document.getElementById('idProduto').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('valorProduto').value = selectedOption.getAttribute('data-valor');
    });

    window.addEventListener('load', function () {
        var idProduto = document.getElementById('idProduto');
        if (idProduto.value) {
            var selectedOption = idProduto.options[idProduto.selectedIndex];
            document.getElementById('valorProduto').value = selectedOption.getAttribute('data-valor');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
    const servicoSelects = document.querySelectorAll('.servico-select');

    function updateSelects() {
        const selectedValue = Array.from(servicoSelects).find(select => select.value);

        if (selectedValue) {
            servicoSelects.forEach(select => {
                if (select !== selectedValue) {
                    select.disabled = true;
                    select.removeAttribute('required');
                }
            });
        } else {
            servicoSelects.forEach(select => {
                select.disabled = false;
                select.setAttribute('required', true);
            });
        }
    }

    servicoSelects.forEach(select => {
        select.addEventListener('change', function () {
            updateSelects();
        });
    });

    // Initialize state based on the current selection
    updateSelects();
});
</script>
