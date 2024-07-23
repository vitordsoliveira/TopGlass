<?php
require_once('class/ClassBanner.php');

// Verifica se o ID do banner foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID do Banner recebido: " . $id . "<br>";

    // Cria uma nova instância da classe Banner
    $Banner = new ClassBanner($id);

    // Tenta carregar os dados do banner do banco de dados
    if ($Banner->Carregar()) { // Carregar os dados do banner
        echo "Dados do Banner carregados com sucesso.<br>";

        // Verifica se o formulário foi enviado
        if (isset($_POST['idBanner'])) {
            echo "Formulário enviado com os seguintes dados:<br>";
            print_r($_POST);

            // Recebe os dados enviados pelo formulário
            $nomeBanner = $_POST['nomeBanner'];
            $caminhoBanner = $_POST['caminhoBanner'];
            $statusBanner = $_POST['statusBanner'];
            $altBanner = $_POST['altBanner'];

            // Verifica se uma nova foto do banner foi enviada
            if (!empty($_FILES['fotoBanner']['name'])) {
                echo "Nova foto do banner detectada.<br>";
                // Tratar o campo FILES
                $arquivo = $_FILES['fotoBanner'];
                print_r($arquivo);

                // Verifica se ocorreu algum erro no upload da imagem
                if ($arquivo['error']) {
                    throw new Exception('O erro foi: ' . $arquivo['error']);
                }

                // Obter a extensão do arquivo e gerar o novo nome da imagem
                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeBnFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeBanner)));
                $nomeBnFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeBnFoto);
                $novoNome = $id . '_' . $nomeBnFoto . '.' . $extensao;

                // Move o arquivo para o diretório de imagens
                if (move_uploaded_file($arquivo['tmp_name'], 'img/banners/' . $novoNome)) {
                    $caminhoBanner = $novoNome;
                    echo "Imagem do banner movida com sucesso: " . $novoNome . "<br>";
                } else {
                    throw new Exception('Não foi possível subir a imagem.');
                }
            } else {
                // Se nenhuma nova imagem foi enviada, mantém o caminho da imagem existente
                $caminhoBanner = $Banner->caminhoBanner;
                echo "Mantendo a imagem existente do banner.<br>";
            }

            // Atualiza os dados do banner com os novos valores
            $Banner->nomeBanner = $nomeBanner;
            $Banner->caminhoBanner = $caminhoBanner;
            $Banner->altBanner = $altBanner;
            $Banner->statusBanner = $statusBanner;

            // Tenta atualizar o banner no banco de dados
            if ($Banner->Atualizar()) {
                echo "Banner atualizado com sucesso!<br>";
            } else {
                echo "Erro ao atualizar o banner.<br>";
            }
        } else {
            echo "Formulário não enviado.<br>";
        }
    } else {
        echo "Erro ao carregar os dados do banner.<br>";
    }
} else {
    echo "ID do Banner não recebido.<br>";
}
?>

<div class="container mt-5">
    <h2>Atualizar Banner</h2>
    <!-- Formulário para atualizar o banner -->
    <form action="index.php?p=banner&bn=atualizar&id=<?php echo($id); ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3">
                <!-- Exibe a imagem atual do banner -->
                <img src="<?php echo($Banner->caminhoBanner); ?>" class="img-fluid" alt="banner" id="imgBanner">
                <!-- Input para upload de nova imagem, escondido -->
                <input type="file" class="form-control" id="fotoBanner" name="fotoBanner" style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <!-- Campo para editar o nome do banner -->
                        <div class="mb-3">
                            <label for="nomeBanner" class="form-label">Nome do Banner</label>
                            <input type="text" class="form-control" id="nomeBanner" name="nomeBanner" value="<?php echo($Banner->nomeBanner); ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- Campo para editar a descrição do banner -->
                        <div class="mb-3">
                            <label for="descricaoBanner" class="form-label">Descrição do Banner</label>
                            <input type="text" class="form-control" id="descricaoBanner" name="descricaoBanner" value="<?php echo($Banner->altBanner); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <!-- Campo para mostrar o caminho da imagem do banner, somente leitura -->
                        <div class="mb-3">
                            <label for="caminhoBanner" class="form-label">Caminho do Banner</label>
                            <input type="text" class="form-control" id="caminhoBanner" name="caminhoBanner" value="<?php echo($Banner->caminhoBanner); ?>" required readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <!-- Campo para editar o status do banner -->
                        <div class="mb-3">
                            <label for="statusBanner" class="form-label">Status do Banner</label>
                            <input type="text" class="form-control" id="statusBanner" name="statusBanner" value="<?php echo($Banner->statusBanner); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botão para enviar o formulário -->
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script>
    // Script para exibir a seleção de arquivo quando a imagem do banner é clicada
    document.getElementById('imgBanner').addEventListener('click', function () {
        document.getElementById('fotoBanner').click();
    });

    // Script para pré-visualizar a nova imagem do banner
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
