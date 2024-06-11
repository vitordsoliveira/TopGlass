<?php
require_once ('class/ClassOrcamento.php');

$orcamento = new ClassOrcamento();
$lista = $orcamento->Listar();

?>

<h2 class="tituloOrcamento">ORÇAMENTOS</h2>

<table class="table">

    <thead>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><p>Cliente</p></th>
                    <th scope="col"><p>Serviço</p></th>
                    <th scope="col"><p>Produtos</p></th>
                    <th scope="col"><p>Funcionario</p></th>
                    <th scope="col"><p>Valor</p></th>
                    <th scope="col"><p>Data</p></th>
                    <th scope="col"><p>Comentario</p></th>
                    <th scope="col"><p>Status</p></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $linha): ?>
                    <tr>
                        <td scope="col"><?php echo $linha['nomeCliente'] ?></td>
                        <td scope="col"><?php echo $linha['nomeServicos'] ?></td>
                        <td scope="col"><?php echo $linha['idProduto'] ?></td>
                        <td scope="col"><?php echo $linha['nomeFuncionario'] ?></td>
                        <td scope="col"><?php echo $linha['valorOrcamento'] ?></td>
                        <td scope="col"><?php echo $linha['dataOrcamento'] ?></td>
                        <td scope="col"><?php echo $linha['comentOrcamento'] ?></td>
                        <td scope="col"><?php echo $linha['statusOrcamento'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <span class="btnCadOrcamento">
            <a href="index.php?p=orcamento&orc=inserir"> + Fazer Orçamento</a>
        </span>