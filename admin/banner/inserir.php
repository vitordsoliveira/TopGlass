<?php
if (isset($_POST['nomeBanner'])) {
    $nomeBanner = $_POST['nomeBanner'];
    $caminhoBanner = $_POST['caminhoBanner'];
    $altBanner = $_POST['altBanner'];
    $statusBanner = 'ATIVO';

    // Recuperar o id
    require_once ('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idBanner FROM tbl_banner ORDER BY idBanner DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    $novoId = $resultado ? $resultado['idBanner'] + 1 : 1;

    // Tratar o campo FILES
    $arquivo = $_FILES['fotoBanner'];
    if ($arquivo['error']) {
        throw new Exception('O erro foi: ' . $arquivo['error']);
    }

    // Obter a extensão do arquivo e gerar o novo nome
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nomeBnFoto = str_replace(' ', '', $nomeBanner);
    $nomeBnFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeBanner)));
    $nomeBnFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeBnFoto);
    $novoNome = $novoId . '_' . $nomeBnFoto . '.' . $extensao;

    // Mover a imagem
    if (move_uploaded_file($arquivo['tmp_name'], 'banner/img/' . $novoNome)) {
        $fotoBanner = 'banner/img/' . $novoNome; // Ajuste para armazenar o caminho correto
    } else {
        throw new Exception('Nao deu pra subir essa imagem não.');
    }

    require_once ('class/ClassBanner.php');
    $Banner = new ClassBanner();
    $Banner->nomeBanner = $nomeBanner;
    $Banner->caminhoBanner = $fotoBanner;
    $Banner->altBanner = $altBanner;
    $Banner->statusBanner = $statusBanner;
    $Banner->altBanner = $nomeBanner;
    $Banner->Inserir();
}
?>

<div class="container mt-5">
    <h2>Novo Banner</h2>
    <form action="index.php?p=banner&bn=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <img src="img/semfoto1.jpg" class="img-fluid" alt="novo banner" id="imgBanner">
                <input type="file" class="form-control" id="fotoBanner" name="fotoBanner" required style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeBanner" class="form-label">Nome do Banner</label>
                            <input type="text" class="form-control" id="nomeBanner" name="nomeBanner" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="altBanner" class="form-label">Descrição do Banner</label>
                            <input type="text" class="form-control" id="altBanner" name="altBanner" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="caminhoBanner" class="form-label">Caminho do Banner</label>
                            <input type="text" class="form-control" id="caminhoBanner" name="caminhoBanner" required readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusBanner" class="form-label">Status do Banner</label>
                            <input type="text" class="form-control" id="statusBanner" name="statusBanner" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script>
    document.getElementById('imgBanner').addEventListener('click', function () {
        document.getElementById('fotoBanner').click();
    });

    document.getElementById('fotoBanner').addEventListener('change', function (event) {
        let imgBanner= document.getElementById("imgBanner");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function(e) {
                imgBanner.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);

            // Definir automaticamente o caminho do banner no campo de entrada
            let caminhoBanner = 'banner/img/' + arquivo.name;
            document.getElementById('caminhoBanner').value = caminhoBanner;
        }
    });
</script>
