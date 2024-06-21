<?php

require_once ('class/ClassOrcamento.php');
$id = $_GET['id'];
$orcamento = new ClassOrcamento($id);

if (isset($_POST['idServicos'])) {

    $idServicos = $_POST['idServicos'];
    $idCliente = $_POST['idCliente'];
    $idServico = $_POST['idServico'];
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
}

?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=inserir" method="POST" enctype="multipart/form-data">

        <div class="row">

            <h3>EDITAR ORÇAMENTO</h3>

            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">
                            <p>CPF Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            placeholder="DIGITE O CPF " required value="<?php echo $cliente->cpfCliente; ?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <p>Nome Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required
                            value="<?php echo $cliente->nomeCliente; ?>">
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">
                            <p>Telefone Cliente:</p>
                        </label>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required
                            value="<?php echo $cliente->numeroCliente; ?>">
                    </div>
                </div>
            </div>

            <!-- FORM ORC -->
            <h3>FAZER ORÇAMENTO</h3>

            <div class="row">

                <div class="options col-3">
                    <select name="servicosVidro" id="servicosVidro" required
                       >
                        <option value="servicoVidro" selected>
                            <p>SERVIÇOS VIDRO</p>
                        </option>
                        <option value="Box de Vidro">
                            <p>Box de Vidro</p>
                        </option>
                        <option value="Jalena de Vidro">
                            <p>Janela de Vidro</p>
                        </option>
                        <option value="Pia de Vidro">
                            <p>Pia de Vidro</p>
                        </option>
                        <option value="Teto de Vidro">
                            <p>Teto de Vidro</p>
                        </option>
                        <option value="Porta de Vidro">
                            <p>Porta de Vidro</p>
                        </option>
                        <option value="Corrimão de Vidro">
                            <p>Corrimão de Vidro</p>
                        </option>
                    </select>
                </div>

                <div class="options col-3">
                    <select name="servicosEsquadria" id="servicosEsquadria" required
                        >
                        <option value="servicoEsquadria" selected>
                            <p>SERVIÇOS ESQUADRIA</p>
                        </option>
                        <option value="Porta de alumínio">
                            <p>Porta de alumínio</p>
                        </option>
                        <option value="Janela de alumínio">
                            <p>Janela de alumínio</p>
                        </option>
                        <option value="Corrimão de alumínio">
                            <p>Corrimão de alumínio</p>
                        </option>
                    </select>
                </div>

            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="nomeFuncionario" class="form-label">
                        <p>FUNCIONÁRIO RESPONSÁVEL</p>
                    </label>
                    <input type="text" class="form-control" id="idFuncionario" name="idFuncionario" required
                        value="<?php echo $orcamento->idFuncionario; ?>">
                </div>
            </div>


    </form>

    <div>
        <textarea name="comentOrcamento" id="comentOrcamento" cols="65" rows="10"
            placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
            required value="<?php echo $orcamento->comentOrcamento; ?>"></textarea>
    </div>
    <div class=" btnEnviar col-2">
        <button type="submit" class="btn btn-primary">Enviar Orçamento</button>
    </div>
    </div>
</div>
</div>