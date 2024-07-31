<?php
require_once ('class/ClassServico.php');

// Verifica se o ID do Servico foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Servico = new ClassServico($id);
    if ($Servico->Carregar()) {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idServico'])) {
            // Recebe os dados enviados pelo formulário
            $nomeServicos = $_POST['nomeServicos'];
            $statusServicos = $_POST['statusServicos'];
            $idTipoServico = $_POST['idTipoServico'];
            $descServico = $_POST['descServico'];
            $fotoServicos = $_POST['fotoServicos'];
            $altServicos = $_POST['altServicos'];
            // Verifica se uma nova foto do Servico foi enviada
            if (!empty($_FILES['fotoServicos']['name'])) {
                $arquivo = $_FILES['fotoServicos'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Erro no upload: ' . $arquivo['error']);
                }

                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeSrFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeServicos)));
                $nomeSrFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeSrFoto);
                $novoNome = $id . '_' . $nomeSrFoto . '.' . $extensao;

                if (move_uploaded_file($arquivo['tmp_name'], 'img/servicos/' . $novoNome)) {
                    $fotoServicos = $novoNome;
                    
                } else {
                    throw new Exception('Não foi possível mover a imagem.');
                }
            } else {
                $fotoServicos = $Servico->fotoServicos;
              
            }

            $Servico->nomeServicos = $nomeServicos;
            $Servico->fotoServicos = $fotoServicos;
            $Servico->altServicos = $altServicos;
            $Servico->statusServicos = $statusServicos;
            $Servico->idTipoServico = $idTipoServico;
            $Servico->descServico = $descServico;

            if ($Servico->Atualizar()) {
                echo "Serviço atualizado com sucesso.<br>";
                header("Location: index.php?sr=servico");
                exit();
            } else {
                echo "Falha ao atualizar o serviço.<br>";
            }
        }
    }
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
    <h2>Editar Serviço</h2>
    <form action="index.php?p=servico&sr=atualizar&id=<?php echo ($id) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idServico" value="<?php echo $id; ?>">
        <div class="row">
            <div class="col-3">
                <img src="<?php echo ($Servico->fotoServicos); ?>" class="img-fluid" alt="novo servico" id="imgServico">
                <input type="file" class="form-control" id="fotoServicos" name="fotoServicos" style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeServicos" class="form-label">Nome do Serviço</label>
                            <input value="<?php echo ($Servico->nomeServicos); ?>" type="text" class="form-control"
                                id="nomeServicos" name="nomeServicos" required style="text-transform: uppercase;"
                                oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="descServico" class="form-label">Descrição do Serviço</label>
                            <input value="<?php echo ($Servico->descServico); ?>" type="text" class="form-control"
                                id="descServico" name="descServico" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="fotoServicos" class="form-label">Caminho da Foto do Serviço</label>
                            <input value="<?php echo ($Servico->fotoServicos); ?>" type="text" class="form-control"
                                id="fotoServicos" name="fotoServicos" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="idTipoServico" class="form-label">Tipo do Serviço</label>
                            <select class="form-select" id="idTipoServico" name="idTipoServico" required>
                                <option value="">Selecione o Tipo</option>
                                <?php foreach ($tiposServicos as $serv): ?>
                                    <option value="<?php echo $serv['idTipoServico']; ?>" <?php echo ($serv['idTipoServico'] == $Servico->idTipoServico) ? 'selected' : ''; ?>>
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
                            <input value="<?php echo ($Servico->altServicos); ?>" type="text" class="form-control"
                                id="altServicos" name="altServicos" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusServicos" class="form-label">Status Serviço</label>
                            <input value="<?php echo ($Servico->statusServicos); ?>" type="text" class="form-control"
                                id="statusServicos" name="statusServicos" style="text-transform: uppercase;" readonly>
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
        document.getElementById('fotoServicos').click();
    });

    document.getElementById('fotoServicos').addEventListener('change', function (event) {
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