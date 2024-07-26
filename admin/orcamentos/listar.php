<?php
require_once('class/ClassOrcamento.php');

$orcamento = new ClassOrcamento();
$lista = $orcamento->Listar();
?>

<h2 class="tituloDashboard">ORÇAMENTOS</h2>

<span class="btnDashboard">
    <a href="index.php?p=orcamento&orc=inserir"> + Fazer Orçamento</a>
</span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">
                <p></p>
            </th>
            <th scope="col">
                <p>Cliente</p>
            </th>
            <th scope="col">
                <p>CPF cliente</p>
            </th>
            <th scope="col">
                <p>Serviço</p>
            </th>
            <th scope="col">
                <p>Produtos</p>
            </th>
            <th scope="col">
                <p>Funcionario</p>
            </th>
            <th scope="col">
                <p>Valor</p>
            </th>
            <th scope="col">
                <p>Data</p>
            </th>
            <th scope="col">
                <p>Comentario</p>
            </th>
            <th scope="col">
                <p>Situação</p>
            </th>
            <th scope="col">
                <p>Status</p>
            </th>
            <th scope="col" class="ativar">
                <p>Atualizar</p>
            </th>
            <th scope="col" class="desativar">
                <p>Desativar</p>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $linha): ?>
            <?php
            // Define a classe da bolinha com base na situação
            $bolinhaClasse = '';
            switch ($linha['situacaoOrcamento']) {
                case 'PENDENTE':
                    $bolinhaClasse = 'bolinha-amarela';
                    break;
                case 'FEITO':
                    $bolinhaClasse = 'bolinha-laranja';
                    break;
                case 'PAGO':
                    $bolinhaClasse = 'bolinha-verde';
                    break;
            }
            ?>
            <tr>
                <td>
                    <span class="bolinha <?php echo $bolinhaClasse; ?>"></span>
                </td>
                <td scope="col"><?php echo htmlspecialchars($linha['nomeCliente']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['cpfCliente']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['nomeServicos']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['nomeProduto']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['nomeFuncionario']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['valorOrcamento']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['dataOrcamento']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['comentOrcamento']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['situacaoOrcamento']); ?></td>
                <td scope="col"><?php echo htmlspecialchars($linha['statusOrcamento']); ?></td>
                <td><a href="index.php?p=orcamento&orc=atualizar&id=<?php echo $linha['idOrcamento']; ?>">Atualizar</a></td>
                <td><a href="index.php?p=orcamento&orc=desativar&id=<?php echo $linha['idOrcamento']; ?>">Desativar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
