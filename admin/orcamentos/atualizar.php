<?php

require_once ('class/ClassCliente.php');
require_once ('class/ClassOrcamento.php');
$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

// Carregar cliente associado ao orçamento
$clienteId = $orcamento->idCliente;
$cliente = new ClassCliente($clienteId);

if (isset($_POST['idOrcamento'])) {

    $idOrcamento = $_POST['idOrcamento'];
    $idServicos = $_POST['idServicos'];
    $idCliente = $_POST['idCliente'];
    $idServico = $_POST['idServico'];
    $idItens = $_POST['idItens'];
    $idFuncionario = $_POST['idFuncionario'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $statusOrcamento = $_POST['statusOrcamento'];
    $comentOrcamento = $_POST['comentOrcamento'];

    $orcamento->idOrcamento = $idOrcamento;
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
                            placeholder="DIGITE O CPF " required value="<?php echo ($orcamentoData->cpfCliente); ?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <p>Nome Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required
                            value="<?php echo ($orcamentoData->nomeCliente); ?>">
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">
                            <p>Telefone Cliente:</p>
                        </label>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required
                            value="<?php echo ($orcamentoData->numeroCliente); ?>">
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
                            $selected = ($row['idFuncionario'] == $orcamento->idFuncionario) ? 'selected' : '';
                            echo '<option value="' . $row['idFuncionario'] . '" ' . $selected . '>' . $row['nomeFuncionario'] . '</option>';
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
                            value="<?php echo ($orcamentoData->valorOrcamento); ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="comentOrcamento" class="form-label">
                    <p>Comentário</p>
                </label>
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

<?php

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se todas as chaves esperadas estão definidas em $_POST para evitar erros de índice indefinido
    $idOrcamento = isset($_POST['idOrcamento']) ? $_POST['idOrcamento'] : null;
    $idServicos = isset($_POST['idServicos']) ? $_POST['idServicos'] : null;
    $idCliente = isset($_POST['idCliente']) ? $_POST['idCliente'] : null;
    $idServico = isset($_POST['idServico']) ? $_POST['idServico'] : null;
    $idItens = isset($_POST['idItens']) ? $_POST['idItens'] : null;
    $idFuncionario = isset($_POST['idFuncionario']) ? $_POST['idFuncionario'] : null;
    $valorOrcamento = isset($_POST['valorOrcamento']) ? $_POST['valorOrcamento'] : null;
    $statusOrcamento = isset($_POST['statusOrcamento']) ? $_POST['statusOrcamento'] : null;
    $comentOrcamento = isset($_POST['comentOrcamento']) ? $_POST['comentOrcamento'] : null;
    $nomeCliente = isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : null;
    $numeroCliente = isset($_POST['numeroCliente']) ? $_POST['numeroCliente'] : null;
    $cpfCliente = isset($_POST['cpfCliente']) ? $_POST['cpfCliente'] : null;

    // Verifica se idOrcamento está definido e não é vazio
    if ($idOrcamento !== null && !empty($idOrcamento)) {

        try {
            // Inicia a conexão com o banco de dados
            $conn = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Atualiza os dados do orçamento
            $sqlOrcamento = "UPDATE tbl_orcamento SET 
                idServicos = :idServicos,
                idCliente = :idCliente,
                idServico = :idServico,
                idItens = :idItens,
                idFuncionario = :idFuncionario,
                valorOrcamento = :valorOrcamento,
                comentOrcamento = :comentOrcamento,
                statusOrcamento = :statusOrcamento
                WHERE idOrcamento = :idOrcamento";

            $stmtOrcamento = $conn->prepare($sqlOrcamento);
            $stmtOrcamento->bindParam(':idServicos', $idServicos);
            $stmtOrcamento->bindParam(':idCliente', $idCliente);
            $stmtOrcamento->bindParam(':idServico', $idServico);
            $stmtOrcamento->bindParam(':idItens', $idItens);
            $stmtOrcamento->bindParam(':idFuncionario', $idFuncionario);
            $stmtOrcamento->bindParam(':valorOrcamento', $valorOrcamento);
            $stmtOrcamento->bindParam(':comentOrcamento', $comentOrcamento);
            $stmtOrcamento->bindParam(':statusOrcamento', $statusOrcamento);
            $stmtOrcamento->bindParam(':idOrcamento', $idOrcamento);
            $stmtOrcamento->execute();

            // Atualiza os dados do cliente, se necessário
            if ($nomeCliente !== null && !empty($nomeCliente)) {
                $sqlCliente = "UPDATE tbl_cliente SET 
                    nomeCliente = :nomeCliente,
                    cpfCliente = :cpfCliente,
                    numeroCliente = :numeroCliente
                    WHERE idCliente = :idCliente";

                $stmtCliente = $conn->prepare($sqlCliente);
                $stmtCliente->bindParam(':nomeCliente', $nomeCliente);
                $stmtCliente->bindParam(':cpfCliente', $cpfCliente);
                $stmtCliente->bindParam(':numeroCliente', $numeroCliente);
                $stmtCliente->bindParam(':idCliente', $idCliente);
                $stmtCliente->execute();
            }

            // Feedback ao usuário
            echo '<div class="alert alert-success" role="alert">Orçamento e cliente atualizados com sucesso!</div>';

        } catch (PDOException $e) {
            // Caso ocorra um erro
            echo '<div class="alert alert-danger" role="alert">Erro ao atualizar: ' . $e->getMessage() . '</div>';
        }

    } else {
        // Caso idOrcamento não esteja definido ou vazio
        echo '<div class="alert alert-danger" role="alert">ID do orçamento inválido ou não fornecido.</div>';
    }
}

?>
