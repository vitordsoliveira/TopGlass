<?php
require_once ('class/ClassCliente.php');

$cliente = new classCliente();
$lista = $cliente->Listar();

?>

<h2 class="tituloCliente">CLIENTES</h2>

<table class="table">

    <thead>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><p>Nome</p></th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Cadastro</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $linha): ?>
                    <tr>
                        <td scope="col"><?php echo $linha['nomeCliente'] ?></td>
                        <td scope="col"><?php echo $linha['emailCliente'] ?></td>
                        <td scope="col"><?php echo $linha['numeroCliente'] ?></td>
                        <td scope="col"><?php echo $linha['cpfCliente'] ?></td>
                        <td scope="col"><?php echo $linha['dataCadCliente'] ?></td>
                        <td scope="col"><?php echo $linha['statusCliente'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <span class="btnCadCliente">
            <a href="index.php?p=cliente&cl=inserir"> + Cadastrar Cliente</a>
        </span>