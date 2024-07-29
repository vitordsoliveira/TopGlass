<?php
ob_start();
require_once('admin/class/ClassOrcSite.php');
require_once('admin/class/Conexao.php');

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$orcamento = new ClassOrcSite();

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
        $servicosPorTipo[$servico['tipoServico']][] = [
            'idServico' => $servico['idServico'],
            'nomeServico' => $servico['nomeServicos']
        ];
    }

    return $servicosPorTipo;
}

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idServico = $_POST['idServico'];
    $nomeCliente = $_POST['nomeCliente'];
    $emailCliente = $_POST['emailCliente'];
    $numeroCliente = $_POST['numeroCliente'];
    $enderecoCliente = $_POST['enderecoCliente'];
    $comentOrcamento = $_POST['comentOrcamento'];
    $larguraOrcamento = $_POST['larguraOrcamento'];
    $alturaOrcamento = $_POST['alturaOrcamento'];

    $orcamento = new ClassOrcSite();
    $orcamento->idServico = $idServico;
    $orcamento->nomeCliente = $nomeCliente;
    $orcamento->emailCliente = $emailCliente;
    $orcamento->numeroCliente = $numeroCliente;
    $orcamento->enderecoCliente = $enderecoCliente;
    $orcamento->comentOrcamento = $comentOrcamento;
    $orcamento->larguraOrcamento = $larguraOrcamento;
    $orcamento->alturaOrcamento = $alturaOrcamento;

    if ($orcamento->Inserir()) {
        $successMessage = "Orçamento enviado com sucesso!";
    } else {
        $errorMessage = "Não foi possível enviar o orçamento!";
    }

    ob_end_flush();
}

$servicosPorTipo = obterServicosPorTipo();
?>

<section class="wow orcamento animate__animated animate__fadeInUp">
    <div class="site">
        <h2>FAÇA UM ORÇAMENTO SEM COMPROMISSO!</h2>
        <div id="messageOverlay" class="overlay">
            <div class="overlay-content">
                <img id="messageImage" src="" alt="Message">
            </div>
        </div>

        <form id="orcamentoForm" action="#" method="POST">
            <div>
                <div>
                    <label for="nomeCliente" class="form-label">
                        <p>Digite seu nome:</p>
                    </label>
                    <input type="text" id="nomeCliente" name="nomeCliente" placeholder="Digite aqui seu nome" required>
                </div>

                <div>
                    <label for="emailCliente" class="form-label">
                        <p>Digite seu email:</p>
                    </label>
                    <input type="email" id="emailCliente" name="emailCliente"
                        placeholder="Digite aqui seu email: exemplo@email.com" required>
                </div>

                <div>
                    <label for="numeroCliente" class="form-label">
                        <p>Digite seu número:</p>
                    </label>
                    <input type="text" id="numeroCliente" name="numeroCliente" placeholder="(DDD) 0 0000-0000" required>
                </div>

                <div>
                    <label for="enderecoCliente" class="form-label">
                        <p>Digite seu endereço:</p>
                    </label>
                    <input type="text" id="enderecoCliente" name="enderecoCliente"
                        placeholder="Digite aqui sua rua numero e bairro" required>
                </div>
            </div>

            <div>
                <?php foreach ($servicosPorTipo as $tipo => $servicos): ?>
                    <div>
                        <div>
                            <label for="idServico<?php echo $tipo; ?>" class="form-label">Serviços
                                <?php echo $tipo; ?>:</label>
                            <select class="form-select servico-select" id="idServico<?php echo $tipo; ?>" name="idServico" required>
                                <option value="">Selecione o Serviço</option>
                                <?php foreach ($servicos as $servico): ?>
                                    <option value="<?php echo $servico['idServico']; ?>">
                                        <?php echo ($servico['nomeServico']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div>
                    <label for="alturaOrcamento" class="form-label">
                        <p>Altura:</p>
                    </label>
                    <input type="text" id="alturaOrcamento" name="alturaOrcamento"
                        placeholder="Digite aqui a altura em metros" required>
                </div>

                <div>
                    <label for="larguraOrcamento" class="form-label">
                        <p>Largura:</p>
                    </label>
                    <input type="text" id="larguraOrcamento" name="larguraOrcamento"
                        placeholder="Digite aqui a largura em metros" required>
                </div>

                <div>
                    <label for="comentOrcamento">
                        <p>Comentário sobre o Serviço:</p>
                    </label>
                    <textarea name="comentOrcamento" id="comentOrcamento" cols="65" rows="10"
                        placeholder="Escrever informações básicas do serviço como cor e tipo de vidro e fazer perguntas ou apontamentos sobre o serviço."
                        required></textarea>
                </div>
                <a href="servicos.php">Mais de um serviço</a>
                <div class="envio">
                    <input type="submit" value="ENVIAR ORÇAMENTO">
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var servicoSelects = document.querySelectorAll('.servico-select');
        var messageOverlay = document.getElementById('messageOverlay');
        var messageImage = document.getElementById('messageImage');
        var orcamentoForm = document.getElementById('orcamentoForm');

        servicoSelects.forEach(function(select) {
            select.addEventListener('change', function() {
                var selectedValue = this.value;
                servicoSelects.forEach(function(otherSelect) {
                    if (otherSelect !== select) {
                        otherSelect.disabled = (selectedValue !== '');
                        otherSelect.required = !otherSelect.disabled;
                    } else {
                        otherSelect.required = true; // Ensure the selected one is always required
                    }
                });
            });
        });

        if ("<?php echo $successMessage; ?>") {
            messageImage.src = 'path/to/success.png'; // Update with the correct path
            messageOverlay.style.display = 'flex';
            setTimeout(function() {
                messageOverlay.style.display = 'none';
                orcamentoForm.reset();
                window.location.href = window.location.href; // Force page refresh to clear cache
            }, 3000);
        }

        if ("<?php echo $errorMessage; ?>") {
            messageImage.src = 'path/to/error.png'; // Update with the correct path
            messageOverlay.style.display = 'flex';
            setTimeout(function() {
                messageOverlay.style.display = 'none';
                window.location.href = window.location.href; // Force page refresh to clear cache
            }, 3000);
        }
    });
</script>
