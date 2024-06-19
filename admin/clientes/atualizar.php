<?php

require_once ('class/ClassCliente.php');
$id = $_GET['id'];
$cliente = new ClassCliente($id);

if (isset($_POST['nomeCliente'])) {
    
    $nomeCliente = $_POST['nomeCliente'];
    $enderecoCliente = $_POST['enderecoCliente'];
    $telefoneCliente = $_POST['telefoneCliente'];
    $emailCliente = $_POST['emailCliente'];
    $senhaCliente = $_POST['senhaCliente'];
    $statusCliente = $_POST['statusCliente'];

    $cliente->nomeCliente = $nomeCliente;
    $cliente->enderecoCliente = $enderecoCliente;
    $cliente->telefoneCliente = $telefoneCliente;
    $cliente->emailCliente = $emailCliente;
    $cliente->senhaCliente = $senhaCliente;
    $cliente->fotoCliente = $fotoCliente;
    $cliente->altCliente = $altCliente;
    $cliente->statusCliente = $statusCliente;

    $cliente->Atualizar();
}

?>

<div class="container mt-5">
    <h2>Atualizar Cliente</h2>

    <!-- --------------------------------------------------- IMPORTANTE ABAIXO -------------------------------------------------- -->
    <form action="index.php?p=cliente&c=atualizar&id=<?php echo $cliente->idCliente; ?>" method="POST"
        enctype="multipart/form-data">

        <div class="row">

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
