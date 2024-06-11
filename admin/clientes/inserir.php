<?php
if (isset($_POST['nomeCliente'])) {

    $nomeCliente = $_POST['nomeCliente'];
    $enderecoCliente = $_POST['enderecoCliente'];
    $telefoneCliente = $_POST['telefoneCliente'];
    $emailCliente = $_POST['emailCliente'];
    $senhaCliente = $_POST['senhaCliente'];

    $statusCliente = 'ATIVO';
    $altCliente = $nomeCliente;

    //TRATAR O CAMPO FILES(FOTO)
    require_once ('class/Conexao.php');
    $conexao = Conexao::LigarConexao();
    $sql = $conexao->query('SELECT idCliente FROM tbl_cliente ORDER BY idCliente DESC LIMIT 1;');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    if($resultado != false && isset($resultado['idCliente'])){
        $novoID = $resultado['idCliente'] + 1;

    }

   // echo "Nome do Cliente: " . $nomeCliente . "<br>";
   // echo "O novo ID do CLIENTE é: " . $novoID . "<br>";

    ///tratar o erro do files
    $arquivo = $_FILES['fotoCliente'];
    if($arquivo['error']){
        throw new Exception('O erro foi :' . $arquivo['error']);
    }

    // Obter a extensão do arquivo
    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

    $nomeClFoto = str_replace(' ','', $nomeCliente); //Remover espaços
    $nomeClFoto = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeClFoto); //Remover caracter especiais(diacrítcos)
    $nomeClFoto = strtolower($nomeClFoto);

    // O novo nome da imagem
    $novoNome = $novoID . '_' . $nomeClFoto . '.' . $extensao;

    //print_r($novoNome);

    // Mover a IMG para a pasta 
    if(move_uploaded_file($arquivo['tmp_name'],'img/cliente/' . $novoNome )){
        $fotoCliente = 'cliente/' . $novoNome;
    }else{
        throw new Exception('Não foi possivel realizar o upload da imagem!');
    }

    require_once('class/ClassCliente.php');

    $cliente = new ClassCliente();

    $cliente->nomeCliente = $nomeCliente;
    $cliente->enderecoCliente = $enderecoCliente;
    $cliente->telefoneCliente = $telefoneCliente;
    $cliente->emailCliente = $emailCliente;
    $cliente->senhaCliente = $senhaCliente;
    $cliente->fotoCliente = $fotoCliente;
    $cliente->statusCliente = $statusCliente;
    $cliente->Inserir();

}


?>

<div class="container mt-5">
    <h2>Cadastro de Cliente</h2>

    <form action="index.php?p=cliente&cl=inserir" method="POST" enctype="multipart/form-data">

        <div class="row">

            <div class="col-4">
                <img src="img/semfoto1.jpg" class="img-fluid" id="imgFoto" alt="...">
                <input type="file" class="form-control" id="fotoCliente" name="fotoCliente" required
                    style="display: none;" required>
            </div>

            <div class="col-8">

                <div class="mb-3">
                    <label for="nomeCliente" class="form-label">Nome Cliente:</label>
                    <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
                </div>

                <div class="row">

                    <div class="col-9">
                        <div class="mb-3">
                            <label for="enderecoCliente" class="form-label">Endereço Cliente:</label>
                            <input type="text" class="form-control" id="enderecoCliente" name="enderecoCliente"
                                required>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone Cliente:</label>
                            <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail Cliente:</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="senhaCliente" class="form-label">CPF Cliente:</label>
                            <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

        </div>
    </form>
</div>

<script>
    //Transformar img em um botão
    document.getElementById('imgFoto').addEventListener('click', function () {
        //verificar se está funcionando
        //alert ('CLICK NA IMAGEM!')
        document.getElementById('fotoCliente').click();
    })

    document.getElementById('fotoCliente').addEventListener('change', function (event) {
        let imgFoto = document.getElementById('imgFoto');
        let arquivo = event.target.files[0];

        if (arquivo) {
            let carregar = new FileReader();

            carregar.onload = function (event) {
                imgFoto.src = event.target.result;
            }
            carregar.readAsDataURL(arquivo);
        }
    })
</script>