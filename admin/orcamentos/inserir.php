<?php
// Inclui as classes necessárias para Cliente, Orçamento e Conexão com o banco de dados
require_once 'class/ClassCliente.php';
require_once 'class/ClassOrcamento.php';
require_once 'class/Conexao.php';

// FUNÇÃO CLIENTES
// Função para obter clientes ativos do banco de dados
function obterClientesAtivos()
{
    $conn = Conexao::LigarConexao(); // Conecta ao banco de dados
    $sql = "SELECT idCliente, nomeCliente FROM tbl_cliente WHERE statusCliente = 'ATIVO'"; // SQL para selecionar clientes ativos
    $stmt = $conn->prepare($sql); // Prepara a consulta
    $stmt->execute(); // Executa a consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array associativo
}

// FUNÇÃO SERVIÇOS
// Função para obter serviços ativos por tipo de serviço
function obterServicosPorTipo()
{
    $conn = Conexao::LigarConexao(); // Conecta ao banco de dados
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
                AND tbl_tipo_servico.statusServico = 'ATIVO';"; // SQL para selecionar serviços ativos e tipos de serviços
    $stmt = $conn->prepare($sql); // Prepara a consulta
    $stmt->execute(); // Executa a consulta
    $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array associativo

    // Inicializa um array para categorizar serviços por tipo
    $servicosPorTipo = [
        'VIDRO' => [],
        'ESQUADRIA' => [],
        'ESPELHO' => [],
    ];

    // Organiza os serviços pelo tipo
    foreach ($servicos as $servico) {
        $servicosPorTipo[$servico['tipoServico']][] = [
            'idServico' => $servico['idServico'],
            'nomeServico' => $servico['nomeServicos']
        ];
    }

    return $servicosPorTipo; // Retorna o array de serviços organizados por tipo
}

// FUNÇÃO ITENS
// Função para obter itens ativos do banco de dados
function obterItens()
{
    $conn = Conexao::LigarConexao(); // Conecta ao banco de dados
    $sql = "SELECT 
                tbl_produto.idProduto, 
                tbl_produto.nomeProduto,
                tbl_produto.valorProduto
            FROM 
                tbl_itens 
            INNER JOIN 
                tbl_produto ON tbl_itens.idProduto = tbl_produto.idProduto
            WHERE
                tbl_produto.statusProduto = 'ATIVO';"; // SQL para selecionar produtos ativos

    $stmt = $conn->prepare($sql); // Prepara a consulta
    $stmt->execute(); // Executa a consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados como um array associativo
}

// INICIAR OS MÉTODOS TRANSFORMADOS EM VARIÁVEIS
$idCliente = $idFuncionario = $valorOrcamento = $statusOrcamento = $comentOrcamento = ''; // Inicializa as variáveis do formulário
$servicosPorTipo = obterServicosPorTipo(); // Obtém os serviços por tipo
$clientes = obterClientesAtivos(); // Obtém os clientes ativos

// Processar formulário se enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_POST['idCliente'];
    $idServico = $_POST['idServico'];
    $idItens = $_POST['idItens'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];
    // Valida os dados (adicionar validações específicas conforme necessário)

    // Inserir novo orçamento no banco de dados
    $orcamento = new ClassOrcamento(); // Cria uma nova instância de ClassOrcamento
    $orcamento->idCliente = $idCliente;
    $orcamento->idServico = $idServico;
    $orcamento->idItens = $idItens;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;

    // Inserir o orçamento
    $orcamento->Inserir();

    // Redirecionar após a inserção
    header("Location: index.php?p=orcamento&orc=inserir");
    exit(); // Certifique-se de parar a execução do script após o redirecionamento
}
?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <h3>CRIAR NOVO ORÇAMENTO</h3>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idCliente" class="form-label">Cliente:</label>
                        <select class="form-select" id="idCliente" name="idCliente" required>
                            <option value="">Selecione o Cliente</option>
                            <?php foreach ($clientes as $cli): ?>
                                <option value="<?php echo $cli['idCliente']; ?>"><?php echo $cli['nomeCliente']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                            echo "<option value='" . $row['idFuncionario'] . "'>" . $row['nomeFuncionario'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="statusOrcamento" class="form-label">Status:</label>
                        <select class="form-select" id="statusOrcamento" name="statusOrcamento" required>
                            <option value="ATIVO">ATIVO</option>
                            <option value="DESATIVO">DESATIVO</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($servicosPorTipo as $tipo => $servicos): ?>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="idServico<?php echo $tipo; ?>" class="form-label">Serviços <?php echo $tipo; ?>:</label>
                        <select class="form-select servico-select" id="idServico<?php echo $tipo; ?>" name="idServico"
                            required <?php echo ($tipo !== 'VIDRO') ? 'disabled' : ''; ?>>
                            <option value="">Selecione o Serviço</option>
                            <?php foreach ($servicos as $servico): ?>
                                <option value="<?php echo $servico['idServico']; ?>"><?php echo $servico['nomeServico']; ?>
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
                        <option value="">Selecione o Produto</option>
                        <?php
                        $itens = obterItens(); // Obtém os itens ativos
                        foreach ($itens as $item) {
                            echo '<option value="' . $item['idProduto'] . '" data-valor="' . $item['valorProduto'] . '">' . $item['nomeProduto'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="valorItens" class="form-label">Valor do Item:</label>
                    <input type="text" class="form-control" id="valorItens" name="valorItens" readonly>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="mb-3">
                <label for="valorOrcamento" class="form-label">Valor:</label>
                <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento" required>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="comentOrcamento" class="form-label">Comentário:</label>
                    <textarea class="form-control" id="comentOrcamento" name="comentOrcamento" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Criar Orçamento</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var servicoSelects = document.querySelectorAll('.servico-select');

        // Adiciona evento de mudança aos selects de serviços para habilitar/desabilitar conforme seleção
        servicoSelects.forEach(function (select) {
            select.addEventListener('change', function () {
                var selectedValue = this.value;
                servicoSelects.forEach(function (otherSelect) {
                    if (otherSelect !== select) {
                        otherSelect.disabled = (selectedValue !== '');
                        otherSelect.required = false; // Remove obrigatoriedade se desabilitado
                    }
                });
            });
        });

        // Adiciona evento para atualizar o valor do item selecionado
        var itensSelect = document.getElementById('idItens');
        var valorItensInput = document.getElementById('valorItens');

        itensSelect.addEventListener('change', function () {
            var selectedOption = itensSelect.options[itensSelect.selectedIndex];
            var valorItens = selectedOption.getAttribute('data-valor');
            valorItensInput.value = valorItens;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectItens = document.getElementById('idItens');
        var valorItensInput = document.getElementById('valorItens');

        // Atualiza o valor do item selecionado no input readonly
        selectItens.addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var valor = selectedOption.getAttribute('data-valor');
            valorItensInput.value = valor ? valor : '';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var servicoSelects = document.querySelectorAll('.servico-select');

        // Reaplica evento de mudança aos selects de serviços
        servicoSelects.forEach(function (select) {
            select.addEventListener('change', function () {
                var selectedValue = this.value;
                servicoSelects.forEach(function (otherSelect) {
                    if (otherSelect !== select) {
                        otherSelect.disabled = (selectedValue !== '');
                        otherSelect.required = false; // Remove obrigatoriedade se desabilitado
                    }
                });
            });
        });
    });
</script>
