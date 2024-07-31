<?php
require_once('class/ClassBanner.php');

// Verifica se o ID do banner foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cria uma nova instância da classe Banner
    $Banner = new ClassBanner($id);

    // Tenta carregar os dados do banner do banco de dados
    if ($Banner->Carregar()) {

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idBanner'])) {

            // Recebe os dados enviados pelo formulário
            $nomeBanner = $_POST['nomeBanner'];
            $caminhoBanner = $_POST['caminhoBanner'];
            $statusBanner = $_POST['statusBanner'];
            $altBanner = $_POST['altBanner'];

            // Verifica se uma nova foto do banner foi enviada
            if (!empty($_FILES['fotoBanner']['name'])) {
                $arquivo = $_FILES['fotoBanner'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Erro no upload: ' . $arquivo['error']);
                }

                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeBnFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeBanner)));
                $nomeBnFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeBnFoto);
                $novoNome = $id . '_' . $nomeBnFoto . '.' . $extensao;

                if (move_uploaded_file($arquivo['tmp_name'], 'img/banners/' . $novoNome)) {
                    $caminhoBanner = $novoNome;
                } else {
                    throw new Exception('Não foi possível mover a imagem.');
                }
            } else {
                $caminhoBanner = $Banner->caminhoBanner;
            }

            $Banner->nomeBanner = $nomeBanner;
            $Banner->caminhoBanner = $caminhoBanner;
            $Banner->altBanner = $altBanner;
            $Banner->statusBanner = $statusBanner;

            if ($Banner->Atualizar()) {
                header("Location: index.php?bn=banner");
                exit();
            }
        }
    }
}
?>

<div class="container mt-5">
    <h2>Atualizar Banner</h2>
    <!-- Formulário para atualizar o banner -->
    <form action="index.php?p=banner&bn=atualizar&id=<?php echo($id); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idBanner" value="<?php echo($id); ?>">
        <div class="row">
            <div class="col-3">
                <img src="<?php echo($Banner->caminhoBanner); ?>" class="img-fluid" alt="banner" id="imgBanner">
                <input type="file" class="form-control" id="fotoBanner" name="fotoBanner" style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeBanner" class="form-label">Nome do Banner</label>
                            <input type="text" class="form-control" id="nomeBanner" name="nomeBanner" value="<?php echo($Banner->nomeBanner); ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="descricaoBanner" class="form-label">Descrição do Banner</label>
                            <input type="text" class="form-control" id="descricaoBanner" name="altBanner" value="<?php echo($Banner->altBanner); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="caminhoBanner" class="form-label">Caminho do Banner</label>
                            <input type="text" class="form-control" id="caminhoBanner" name="caminhoBanner" value="<?php echo($Banner->caminhoBanner); ?>" required readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusBanner" class="form-label">Status do Banner</label>
                            <input type="text" class="form-control" id="statusBanner" name="statusBanner" value="<?php echo($Banner->statusBanner); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script>
    document.getElementById('imgBanner').addEventListener('click', function () {
        document.getElementById('fotoBanner').click();
    });

    document.getElementById('fotoBanner').addEventListener('change', function (event) {
        let imgBanner = document.getElementById("imgBanner");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function(e) {
                imgBanner.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);
        }
    });
</script>
