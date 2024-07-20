<?php
require_once('class/ClassBanner.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Banner = new ClassBanner($id);
    
    if ($Banner->Carregar()) { // Carregar os dados do banner existente
        if (isset($_POST['idBanner'])) {
            $nomeBanner = $_POST['nomeBanner'];
            $descricaoBanner = $_POST['descricaoBanner'];
            $statusBanner = $_POST['statusBanner'];
            $altBanner = $nomeBanner;

            // Verificar se a foto foi modificada
            if (!empty($_FILES['fotoBanner']['name'])) {
                // Tratar o campo FILES
                $arquivo = $_FILES['fotoBanner'];
                if ($arquivo['error']) {
                    throw new Exception('O erro foi: ' . $arquivo['error']);
                }

                // Obter a extensão do arquivo e gerar o novo nome
                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeBnFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeBanner)));
                $nomeBnFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeBnFoto);
                $novoNome = $id . '_' . $nomeBnFoto . '.' . $extensao;

                // Mover a imagem
                if (move_uploaded_file($arquivo['tmp_name'], 'banner/img/' . $novoNome)) {
                    $caminhoBanner = $novoNome;
                } else {
                    throw new Exception('Não foi possível subir a imagem.');
                }
            } else {
                $caminhoBanner = $Banner->caminhoBanner; // Manter a imagem existente
            }

            // Atualizar os dados do banner
            $Banner->nomeBanner = $nomeBanner;
            $Banner->caminhoBanner = $caminhoBanner;
            $Banner->altBanner = $altBanner;
            $Banner->statusBanner = $statusBanner;

            $Banner->Atualizar();
            echo "Banner atualizado com sucesso!";
        }
    } else {
        echo "Banner não encontrado!";
    }
} else {
    echo "ID do banner não fornecido!";
}
?>

<div class="container mt-5">
    <h2>Atualizar Banner</h2>
    <form action="index.php?p=banner&bn=atualizar&id=<?php echo($id); ?>" method="POST" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="descricaoBanner" name="descricaoBanner" value="<?php echo($Banner->altBanner); ?>" required>
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
