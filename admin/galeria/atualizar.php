<?php
require_once('class/ClassGaleria.php');

// Verifica se o ID do Galeria foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cria uma nova instância da classe Galeria
    $galeria = new ClassGaleria($id);

    // Tenta carregar os dados do Galeria do banco de dados
    if ($galeria->Carregar()) {

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idGaleria'])) {

            // Recebe os dados enviados pelo formulário
            $nomeGaleria = $_POST['nomeGaleria'];
            $caminhoGaleria = $_POST['caminhoGaleria'];
            $statusGaleria = $_POST['statusGaleria'];
            $altGaleria = $_POST['altGaleria'];

            // Verifica se uma nova foto do Galeria foi enviada
            if (!empty($_FILES['fotoGaleria']['name'])) {
                $arquivo = $_FILES['fotoGaleria'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Erro no upload: ' . $arquivo['error']);
                }

                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeGlFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeGaleria)));
                $nomeGlFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeGlFoto);
                $novoNome = $id . '_' . $nomeGlFoto . '.' . $extensao;

                if (move_uploaded_file($arquivo['tmp_name'], 'img/galeria/' . $novoNome)) {
                    $caminhoGaleria = $novoNome;
                } else {
                    throw new Exception('Não foi possível mover a imagem.');
                }
            } else {
                $caminhoGaleria = $galeria->caminhoGaleria;
            }

            $galeria->nomeGaleria = $nomeGaleria;
            $galeria->caminhoGaleria = $caminhoGaleria;
            $galeria->altGaleria = $altGaleria;
            $galeria->statusGaleria = $statusGaleria;

            if ($galeria->Atualizar()) {
                header("Location: index.php?bn=Galeria");
                exit();
            }
        }
    }
}
?>

<div class="container mt-5">
    <h2>Atualizar Galeria</h2>
    <!-- Formulário para atualizar o Galeria -->
    <form action="index.php?p=galeria&gl=atualizar&id=<?php echo($id); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idGaleria" value="<?php echo($id); ?>">
        <div class="row">
            <div class="col-3">
                <img src="<?php echo($galeria->caminhoGaleria); ?>" class="img-fluid" alt="Galeria" id="imgGaleria">
                <input type="file" class="form-control" id="fotoGaleria" name="fotoGaleria" style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeGaleria" class="form-label">Nome do Galeria</label>
                            <input type="text" class="form-control" id="nomeGaleria" name="nomeGaleria" value="<?php echo($galeria->nomeGaleria); ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="descricaoGaleria" class="form-label">Descrição do Galeria</label>
                            <input type="text" class="form-control" id="descricaoGaleria" name="altGaleria" value="<?php echo($galeria->altGaleria); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="caminhoGaleria" class="form-label">Caminho do Galeria</label>
                            <input type="text" class="form-control" id="caminhoGaleria" name="caminhoGaleria" value="<?php echo($galeria->caminhoGaleria); ?>" required readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusGaleria" class="form-label">Status do Galeria</label>
                            <input type="text" class="form-control" id="statusGaleria" name="statusGaleria" value="<?php echo($galeria->statusGaleria); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script>
    document.getElementById('imgGaleria').addEventListener('click', function () {
        document.getElementById('fotoGaleria').click();
    });

    document.getElementById('fotoGaleria').addEventListener('change', function (event) {
        let imgGaleria = document.getElementById("imgGaleria");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function(e) {
                imgGaleria.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);
        }
    });
</script>
