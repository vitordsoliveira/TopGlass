<?php

require_once ('class/ClassCliente.php');
$id = $_GET['id'];
$cliente = new ClassCliente($id);

if (isset($_POST['nomeCliente'])) {
    
    $nomeCliente = $_POST['nomeCliente'];
    $enderecoCliente = $_POST['enderecoCliente'];
    $numeroCliente = $_POST['numeroCliente'];
    $emailCliente = $_POST['emailCliente'];
    $cpfCliente = $_POST['cpfCliente'];

    $cliente->nomeCliente = $nomeCliente;
    $cliente->enderecoCliente = $enderecoCliente;
    $cliente->numeroCliente = $numeroCliente;
    $cliente->emailCliente = $emailCliente;
    $cliente->cpfCliente = $cpfCliente;

    $cliente->Atualizar();
}

?>

<div class="container mt-5">
    <h2>Atualizar Cliente</h2>

    <!-- --------------------------------------------------- IMPORTANTE ABAIXO -------------------------------------------------- -->
    <form action="index.php?p=cliente&cl=atualizar&id=<?php echo $cliente->idCliente; ?>" method="POST"
        enctype="multipart/form-data">

        <div class="row">

            <div class="col-8">

                <div class="mb-3">
                    <label for="nomeCliente" class="form-label">Nome Cliente:</label>
                    <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required value="<?php echo $cliente->nomeCliente; ?>">
                </div>

                <div class="row">

                    <div class="col-9">
                        <div class="mb-3">
                            <label for="enderecoCliente" class="form-label">Endereço Cliente:</label>
                            <input type="text" class="form-control" id="enderecoCliente" name="enderecoCliente"
                                required value="<?php echo $cliente->enderecoCliente; ?>">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="numeroCliente" class="form-label">Número Cliente:</label>
                            <input type="tel" class="form-control" id="numeroCliente" name="numeroCliente" required value="<?php echo $cliente->numeroCliente; ?>">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail Cliente:</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" required value="<?php echo $cliente->emailCliente; ?>">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="senhaCliente" class="form-label">CPF Cliente:</label>
                            <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" required value="<?php echo $cliente->cpfCliente; ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

        </div>
