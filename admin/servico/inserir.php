<?php
if (isset($_POST['nomeServicos'])) {
    $nomeServicos = $_POST['nomeServicos'];
    $statusServicos = 'ATIVO';
    $idTipoServico = $_POST['idTipoServico'];
    $descServico = $_POST['descServico'];
    $fotoServicos = $_POST['fotoServicos'];
    $altServicos = $_POST['altServicos'];

    // Recuperar o id
    require_once ('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idServico FROM tbl_servico ORDER BY idServico DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    $novoId = $resultado ? $resultado['idServico'] + 1 : 1;

    // Tratar o campo FILES
    $arquivo = $_FILES['fotoServico'];
    if ($arquivo['error']) {
        throw new Exception('O erro foi: ' . $arquivo['error']);
    }

    // Obter a extensão do arquivo e gerar o novo nome
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nomeSrFoto = str_replace(' ', '', $nomeServicos);
    $nomeSrFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeServicos)));
    $nomeSrFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeSrFoto);
    $novoNome = $novoId . '_' . $nomeSrFoto . '.' . $extensao;

    // Mover a imagem
    if (move_uploaded_file($arquivo['tmp_name'], 'img/servicos/' . $novoNome)) {
        $fotoServico = 'img/servicos/' . $novoNome; // Ajuste para armazenar o caminho correto
    } else {
        throw new Exception('Nao deu pra subir essa imagem não.');
    }

    require_once ('class/ClassServico.php');
    $Servicos = new ClassServico();
    $Servicos->nomeServicos = $nomeServicos;
    $Servicos->fotoServicos = $fotoServicos;
    $Servicos->altServicos = $altServicos;
    $Servicos->statusServicos = $statusServicos;
    $Servicos->idTipoServico = $idTipoServico;
    $Servicos->descServico = $descServico;
    $Servicos->Inserir();
}

function buscarServicos()
{
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query("SELECT idTipoServico, tipoServico FROM tbl_tipo_servico WHERE statusServico = 'ATIVO'; ");
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

$tiposServicos = buscarServicos();
?>

<div class="container mt-5">
    <h2>Novo Serviço</h2>
    <form action="index.php?p=servico&sr=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <img src="img/semfoto1.jpg" class="img-fluid" alt="novo servico" id="imgServico">
                <input type="file" class="form-control" id="fotoServico" name="fotoServico" required
                    style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeServicos" class="form-label">Nome do Serviço</label>
                            <input type="text" class="form-control" id="nomeServicos" name="nomeServicos" required
                                style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="descServico" class="form-label">Descrição do Serviço</label>
                            <input type="text" class="form-control" id="descServico" name="descServico" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="fotoServicos" class="form-label">Caminho da Foto do Serviço</label>
                            <input type="text" class="form-control" id="fotoServicos" name="fotoServicos" required
                                readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="idTipoServico" class="form-label">Tipo do Serviço</label>
                            <select class="form-select" id="idTipoServico" name="idTipoServico" required>
                                <option value="">Selecione o Tipo</option>
                                <?php foreach ($tiposServicos as $serv): ?>
                                    <option value="<?php echo $serv['idTipoServico']; ?>">
                                        <?php echo $serv['tipoServico']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="altServicos" class="form-label">Descrição da Foto do Serviço</label>
                            <input type="text" class="form-control" id="altServicos" name="altServicos" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusServicos" class="form-label">Status Serviço</label>
                            <input type="text" class="form-control" id="statusServicos" name="statusServicos"
                                value="ATIVO" style="text-transform: uppercase;" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script>
    document.getElementById('imgServico').addEventListener('click', function () {
        document.getElementById('fotoServico').click();
    });

    document.getElementById('fotoServico').addEventListener('change', function (event) {
        let imgServico = document.getElementById("imgServico");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function (e) {
                imgServico.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);

            // Definir automaticamente o caminho do Servico no campo de entrada
            let caminhoServico = 'img/servicos/' + arquivo.name;
            document.getElementById('fotoServicos').value = caminhoServico;
        }
    });
</script>