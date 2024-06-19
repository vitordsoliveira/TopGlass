<?php
require_once ('class/ClassCliente.php');

$cliente = new ClassCliente();
$lista = $cliente->Listar();

?>

<h2 class="tituloDashboard">CLIENTES</h2>

<table class="table">

    <span class="btnDashboard">
        <a href="index.php?p=cliente&cl=inserir"> + Cadastrar Cliente</a>
    </span>

    <thead>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <p>Nome</p>
                    </th>
                    <th scope="col"><p>E-mail</p></th>
                    <th scope="col"><p>Telefone</p></th>
                    <th scope="col"><p>CPF</p></th>
                    <th scope="col"><p>Cadastro</p></th>
                    <th scope="col"><p>Status</p></th>
                    <th scope="col" class="ativar"><p>Atualizar</p></th>
                    <th scope="col" class="desativar"><p>Desativar</p></th>
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
                        <td><a href="index.php?p=cliente&cl=atualizar&id=<?php echo $linha['idCliente']; ?>">Atualizar</a>
                        </td>
                        <td><a href="index.php?p=cliente&cl=desativar&id=<?php echo $linha['idCliente']; ?>">Desativar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>