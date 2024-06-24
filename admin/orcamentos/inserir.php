<?php

if(isset($_POST['idOrcamento'])){
    $idOrcamento = $_POST['idOrcamento'];
    $enderecoOrcamento = $_POST['enderecoOrcamento'];
    $telefoneOrcamento = $_POST['telefoneOrcamento'];
    $emailOrcamento = $_POST['emailOrcamento'];
    $senhaOrcamento = $_POST['senhaOrcamento'];
    //$fotoOrcamento = $_POST['fotoOrcamento'];             <---- a foto é diferente

    $statusOrcamento = 'ATIVO';
    //Recuperar o id
    require_once('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idOrcamento FROM tbl_orcamento ORDER BY idOrcamento DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch em vez de fetchAll

    if($resultado !== false && isset($resultado['idOrcamento'])){
        $novoId = $resultado['idOrcamento'] + 1;
    }

    require_once ('class/ClassOrcamento.php');
    $orcamento = new ClassOrcamento();
    $orcamento->idOrcamento = $idOrcamento;
    $orcamento->idServicos = $idServicos;
    $orcamento->idCliente = $idCliente;
    $orcamento->idServico = $idServico;
    $orcamento->idItens = $idItens;
    $orcamento->idFuncionario = $idFuncionario;
    $orcamento->valorOrcamento = $valorOrcamento;
    $orcamento->statusOrcamento = $statusOrcamento;
    $orcamento->comentOrcamento = $comentOrcamento;

    $orcamento->Inserir();
}

?>

<div class="container mt-5">
    <form action="index.php?p=orcamento&orc=atualizar&id=<?php echo $id; ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <h3>QUAL CLIENTE</h3>
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">
                            <p>CPF Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            placeholder="DIGITE O CPF " required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <p>Nome Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">
                            <p>Telefone Cliente:</p>
                        </label>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required>
                    </div>
                </div>
            </div>
            <div class="col-6">
                    <div class="mb-3">
                        <label for="endereçoliente" class="form-label">
                            <p>Endereço Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="endereçoCliente" name="endereçoCliente" required>
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
                    <div class="mb-3">
                        <label for="idFuncionario" class="form-label">
                            <p>FUNCIONÁRIO RESPONSÁVEL</p>
                        </label>
                        <select name="idFuncionario" id="idFuncionario" class="form-select" required>
                            <option value="">Selecione o Funcionário</option>
                            <?php
                            // Configurações de conexão com o banco de dados
                            $servername = "topglass.smpsistema.com.br";
                            $username = "u283879542_topglass";
                            $password = "Senac@topglass01";
                            $dbname = "u283879542_topglass";

                            // Cria conexão
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verifica conexão
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Consulta SQL para buscar funcionários
                            $sql = "SELECT idFuncionario, nomeFuncionario FROM tbl_funcionario";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Loop para exibir os funcionários como opções do select
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['idFuncionario'] . '">' . $row['nomeFuncionario'] . '</option>';
                                }
                            } else {
                                echo '<option value="">Nenhum funcionário encontrado</option>';
                            }

                            // Fecha a conexão com o banco de dados
                            $conn->close();
                            ?>
                        </select>
                    </div>
                </div>


                <div class="col-3">
                    <div class="mb-3">
                        <label for="valorOrcamento" class="form-label">
                            <p>VALOR</p>
                        </label>
                        <input type="text" class="form-control" id="valorOrcamento" name="valorOrcamento">
                    </div>
                </div>
            </div>

        </div>


        <div class="mb-3">
            <label for="comentOrcamento" class="form-label">
                <p>Comentário</p>
            </label>
            <textarea name="comentOrcamento" id="comentOrcamento" class="form-control" cols="65" rows="10"
                placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
                required></textarea>
        </div>

        <div class="btnEnviar col-2">
            <button type="submit" class="btn btn-primary">Editar Orçamento</button>
        </div>

</div>
</form>
</div>
