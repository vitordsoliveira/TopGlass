<?php
if (isset($_POST['nomeGaleria'])) {
    $nomeGaleria = $_POST['nomeGaleria'];
    $caminhoGaleria = $_POST['caminhoGaleria'];
    $altGaleria = $_POST['altGaleria'];
    $statusGaleria = 'ATIVO';

    // Recuperar o id
    require_once ('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idGaleria FROM tbl_galeria ORDER BY idGaleria DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    $novoId = $resultado ? $resultado['idGaleria'] + 1 : 1;

    // Tratar o campo FILES
    $arquivo = $_FILES['fotoGaleria'];
    if ($arquivo['error']) {
        throw new Exception('O erro foi: ' . $arquivo['error']);
    }

    // Obter a extensão do arquivo e gerar o novo nome
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nomeGlFoto = str_replace(' ', '', $nomeGaleria);
    $nomeGlFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeGaleria)));
    $nomeGlFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeGlFoto);
    $novoNome = $novoId . '_' . $nomeGlFoto . '.' . $extensao;

    // Mover a imagem
    if (move_uploaded_file($arquivo['tmp_name'], 'img/galeria/' . $novoNome)) {
        $fotoGaleria = 'img/galeria/' . $novoNome; // Ajuste para armazenar o caminho correto
    } else {
        throw new Exception('Nao deu pra subir essa imagem não.');
    }

    require_once ('class/ClassGaleria.php');
    $Galeria = new ClassGaleria();
    $Galeria->nomeGaleria = $nomeGaleria;
    $Galeria->caminhoGaleria = $fotoGaleria;
    $Galeria->altGaleria = $altGaleria;
    $Galeria->statusGaleria = $statusGaleria;
    $Galeria->altGaleria = $nomeGaleria;
    $Galeria->Inserir();
}
?>

<div class="container mt-5">
    <h2>Novo Galeria</h2>
    <form action="index.php?p=galeria&gl=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <img src="img/semfoto1.jpg" class="img-fluid" alt="novo Galeria" id="imgGaleria">
                <input type="file" class="form-control" id="fotoGaleria" name="fotoGaleria" required style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nomeGaleria" class="form-label">Nome do Galeria</label>
                            <input type="text" class="form-control" id="nomeGaleria" name="nomeGaleria" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="altGaleria" class="form-label">Descrição do Galeria</label>
                            <input type="text" class="form-control" id="altGaleria" name="altGaleria" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="caminhoGaleria" class="form-label">Caminho do Galeria</label>
                            <input type="text" class="form-control" id="caminhoGaleria" name="caminhoGaleria" required readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusGaleria" class="form-label">Status do Galeria</label>
                            <input type="text" class="form-control" id="statusGaleria" name="statusGaleria" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script>
    document.getElementById('imgGaleria').addEventListener('click', function () {
        document.getElementById('fotoGaleria').click();
    });

    document.getElementById('fotoGaleria').addEventListener('change', function (event) {
        let imgGaleria= document.getElementById("imgGaleria");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function(e) {
                imgGaleria.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);

            // Definir automaticamente o caminho do Galeria no campo de entrada
            let caminhoGaleria = 'img/galeria/' + arquivo.name;
            document.getElementById('caminhoGaleria').value = caminhoGaleria;
        }
    });
</script>
