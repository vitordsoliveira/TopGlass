<?php
require_once('class/ClassFuncionario.php');

// Verifica se o ID do Funcionario foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Funcionario = new ClassFuncionario($id);
    if ($Funcionario->CarregarPerfil()) {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idFuncionario'])) {
            // Recebe os dados enviados pelo formulário
            $nomeFuncionario = $_POST['nomeFuncionario'];
            $emailFuncionario = $_POST['emailFuncionario'];
            $senhaFuncionario = $_POST['senhaFuncionario'];
            $altFotoFuncionario = $_POST['altFotoFuncionario'];

            // Verifica se uma nova foto do Funcionario foi enviada
            if (!empty($_FILES['fotoFuncionario']['name'])) {
                $arquivo = $_FILES['fotoFuncionario'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Erro no upload: ' . $arquivo['error']);
                }

                $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $nomeSrFoto = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', str_replace(' ', '', $nomeFuncionario)));
                $nomeSrFoto = preg_replace('/[^a-zA-Z0-9]/', '', $nomeSrFoto);
                $novoNome = $id . '_' . $nomeSrFoto . '.' . $extensao;

                if (move_uploaded_file($arquivo['tmp_name'], 'img/funcionarios/' . $novoNome)) {
                    $fotoFuncionario = 'img/funcionarios/' . $novoNome; // Adiciona o caminho aqui
                } else {
                    throw new Exception('Não foi possível mover a imagem.');
                }
            } else {
                $fotoFuncionario = $Funcionario->fotoFuncionario;
            }

            $Funcionario->nomeFuncionario = $nomeFuncionario;
            $Funcionario->emailFuncionario = $emailFuncionario;
            $Funcionario->senhaFuncionario = $senhaFuncionario;
            $Funcionario->fotoFuncionario = $fotoFuncionario;
            $Funcionario->altFotoFuncionario = $altFotoFuncionario;

            if ($Funcionario->AtualizarPerfil()) {
                echo "Funcionário atualizado com sucesso.<br>";
                header("Location: index.php?sr=funcionario");
                exit();
            } else {
                echo "Falha ao atualizar o funcionário.<br>";
            }
        }
    } else {
        echo "Funcionário não encontrado.<br>";
    }
}
?>

<div class="container mt-5">
    <h2>Editar Perfil do Funcionário</h2>
    <form action="index.php?p=perfilFuncionario&sr=atualizar&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idFuncionario" value="<?php echo $id; ?>">
        <div class="row">
            <div class="col-3">
                <img src="<?php echo $fotoFuncionario; ?>" class="img-fluid" alt="Foto do Funcionário" id="imgFuncionario">
                <input type="file" class="form-control" id="fotoFuncionario" name="fotoFuncionario" style="display: none;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
                            <input value="<?php echo $nomeFuncionario; ?>" type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="emailFuncionario" class="form-label">Email do Funcionário</label>
                            <input value="<?php echo $emailFuncionario; ?>" type="email" class="form-control" id="emailFuncionario" name="emailFuncionario" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="senhaFuncionario" class="form-label">Senha do Funcionário</label>
                            <input type="password" class="form-control" id="senhaFuncionario" name="senhaFuncionario" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="altFotoFuncionario" class="form-label">Descrição da Foto do Funcionário</label>
                            <input value="<?php echo $altFotoFuncionario; ?>" type="text" class="form-control" id="altFotoFuncionario" name="altFotoFuncionario" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>


<script>
    document.getElementById('imgFuncionario').addEventListener('click', function () {
        document.getElementById('fotoFuncionario').click();
    });

    document.getElementById('fotoFuncionario').addEventListener('change', function (event) {
        let imgFuncionario = document.getElementById("imgFuncionario");
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function (e) {
                imgFuncionario.src = e.target.result;
            }
            carregar.readAsDataURL(arquivo);
        }
    });
</script>
