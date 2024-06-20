<?php

if (isset($_POST['nomeBanner'])) {
    $nomeBanner = $_POST['nomeBanner'];
    $enderecoBanner = $_POST['caminhoBanner'];
    $telefoneBanner = $_POST['altBanner'];
    $emailBanner = $_POST['statusBanner'];
    //$fotoBanner = $_POST['fotoBanner'];             <---- a foto é diferente

    $statusBanner = 'ATIVO';
    $altBanner = 'banner' . $nomeBanner;

    //Recuperar o id
    require_once ('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idBanner FROM tbl_Banner ORDER BY idBanner DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch em vez de fetchAll

    if ($resultado !== false && isset($resultado['idBanner'])) {
        $novoId = $resultado['idBanner'] + 1;
    }

    //Tratar o campo FILES
    $arquivo = $_FILES['fotoBanner'];
    if ($arquivo['error']) {
        throw new Exception('O erro foi: ' . $arquivo['error']);
    }

    //Obter a extensão do arquivo
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nomeBnFoto = str_replace(' ', '', $nomeBanner); //substitui um 'espaço' para 'sem espaço'
    $nomeBnFoto = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeBnFoto); //remover sinais diacriticos (remove os caracteres especiais)
    $nomeBnFoto = strtolower($nomeBnFoto);

    //novo nome da imagem
    $novoNome = $novoId . '_' . $nomeBnFoto . '.' . $extensao;

    //print_r($novoNome);

    //Mover a imagem
    if (move_uploaded_file($arquivo['tmp_name'], 'img/Banner/' . $novoNome)) {
        $fotoBanner = 'Banner/' . $novoNome;
    } else {
        throw new Exception('NÃO FOI POSSIVEL REALIZAR O UPLOAD DO BANNER');
    }

    require_once ('class/ClassBanner.php');

    $Banner = new ClassBanner();
    $Banner->nomeBanner = $nomeBanner;
    $Banner->caminhoBanner = $caminhoBanner;
    $Banner->altBanner = $altBanner;
    $Banner->statusBanner = $statusBanner;

    $Banner->Inserir();
}
?>


<div class="container mt-5">
    <h2>Novo Banner</h2>
    <form action="index.php?p=banner&bn=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <img src="img/semfoto1.jpg" class="img-fluid" alt="novo banner" id="fotoBanner">
                <input type="file" class="form-control" id="imgBanner" name="imgBanner" required style="display: none;">
                <div class="mb-3">
                </div>
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
                            <input type="text" class="form-control" id="caminhoBanner" name="caminhoBanner" required>
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
  // Transformar 
  document.getElementById('fotoBanner').addEventListener('click', function() {
    //alert('Click na IMG');
    document.getElementById('imgBanner').click();
  })
  document.getElementById('imgBanner').addEventListener('change', function(event) {
    let imgBanner = document.getElementById('fotoBanner');
    let arquivo = event.target.files[0];
    if (arquivo) {
      let carregar = new FileReader();
      carregar.onload = function(e) {
        imgBanner.src = e.target.result;
      }
      carregar.readAsDataURL(arquivo);
    }
  })
</script>