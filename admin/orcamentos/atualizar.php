<?php
require_once ('class/ClassCliente.php');
require_once ('class/ClassOrcamento.php');
require_once ('class/Conexao.php');

$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Carregar cliente associado ao orçamento
$clienteId = $orcamento->idCliente;
$cliente = new ClassCliente($clienteId);

if (isset($_POST['valorOrcamento'])) {
    print_r('CHEGUEI AQUI'); {
        $idServicos = $_POST['idServicos'];
        $idCliente = $_POST['idCliente'];
        $idServico = $_POST['idServico'];
        $idFuncionario = $_POST['idFuncionario'];
        $valorOrcamento = $_POST['valorOrcamento'];
        $statusOrcamento = $_POST['statusOrcamento'];
        $comentOrcamento = $_POST['comentOrcamento'];

        $orcamento->idServicos = $idServicos;
        $orcamento->idCliente = $idCliente;
        $orcamento->idServico = $idServico;
        $orcamento->idFuncionario = $idFuncionario;
        $orcamento->valorOrcamento = $valorOrcamento;
        $orcamento->statusOrcamento = $statusOrcamento;
        $orcamento->comentOrcamento = $comentOrcamento;

        $orcamento->Atualizar();

        if (isset($_POST['cpfCliente'])) {

            $cpfCliente = $_POST['cpfCliente'];

            $cliente->cpfCliente = $cpfCliente;

            $cliente->Atualizar();

        }
    }
}

$conn = Conexao::LigarConexao();
$sql = "SELECT * FROM tbl_orcamento WHERE idOrcamento = :idOrcamento";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idOrcamento', $id, PDO::PARAM_INT);
$stmt->execute();
$orcamentoData = $stmt->fetch(PDO::FETCH_OBJ);

function obterServicos()
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

$servicosPorTipo = obterServicos();


$sql = "
SELECT
tbl_cliente.cpfCliente
FROM 
tbl_orcamento
INNER JOIN 
tbl_cliente ON tbl_orcamento.idCliente = tbl_cliente.idCliente
WHERE 
tbl_orcamento.idOrcamento = idOrcamento;";

?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=atualizar&id=<?php echo $id; ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <h3>EDITAR CLIENTE</h3>
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">CPF Cliente:</label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            placeholder="DIGITE O CPF" required value="<?php echo ($cliente->cpfCliente); ?>">
                    </div>
                </div>
            </div>
            <h3>REFAZER ORÇAMENTO</h3>
            <div class="row">
                <div class="options col-3">
                    <label for="servicosVidro" class="form-label">SERVIÇOS VIDRO</label>
                    <select name="idServicosVidro" id="servicosVidro" class="form-select" required>
                        <?php if (!empty($servicosPorTipo['VIDRO'])): ?>
                            <?php foreach ($servicosPorTipo['VIDRO'] as $servico): ?>
                                <option value="<?php echo $servico['idServico']; ?>"><?php echo ($servico['nomeServicos']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Nenhum serviço de vidro disponível</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="options col-3">
                    <label for="servicosEsquadria" class="form-label">SERVIÇOS ESQUADRIA</label>
                    <select name="idServicosEsquadria" id="servicosEsquadria" class="form-select" required>
                        <?php if (!empty($servicosPorTipo['ESQUADRIA'])): ?>
                            <?php foreach ($servicosPorTipo['ESQUADRIA'] as $servico): ?>
                                <option value="<?php echo $servico['idServico']; ?>"><?php echo ($servico['nomeServicos']); ?>
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
                            echo '<option value="' . $rowFuncionario['idFuncionario'] . '" ' . $selected . '>' . ($rowFuncionario['nomeFuncionario']) . '</option>';
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