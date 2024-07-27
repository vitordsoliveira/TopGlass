<?php
require_once('class/ClassOrcamento.php');

$statusFiltro = isset($_GET['status']) ? $_GET['status'] : '';
$situacaoFiltro = isset($_GET['situacao']) ? $_GET['situacao'] : '';

$orcamento = new ClassOrcamento();
$lista = $orcamento->Listar($statusFiltro, $situacaoFiltro);
?>

<h2 class="tituloDashboard">ORÇAMENTOS</h2>

<div class="dashboard-header">
    <span class="btnDashboardOrc">
        <a href="index.php?p=orcamento&orc=inserir"> + Fazer Orçamento</a>
    </span>

    <div class="filtros">
        <form method="get" action="">
            <input type="hidden" name="p" value="orcamento">
            
            <!-- Filtro de Status -->
            <select class="selectStatus" name="status">
                <option value="">STATUS (Todos)</option>
                <option value="ATIVO" <?php echo isset($_GET['status']) && $_GET['status'] === 'ATIVO' ? 'selected' : ''; ?>>ATIVO</option>
                <option value="INATIVO" <?php echo isset($_GET['status']) && $_GET['status'] === 'INATIVO' ? 'selected' : ''; ?>>INATIVO</option>
            </select>

            <!-- Filtro de Situação -->
            <select class="selectSituacao" name="situacao">
                <option value="">SITUAÇÃO (Todos)</option>
                <option value="PENDENTE" <?php echo isset($_GET['situacao']) && $_GET['situacao'] === 'PENDENTE' ? 'selected' : ''; ?>>PENDENTE</option>
                <option value="FEITO" <?php echo isset($_GET['situacao']) && $_GET['situacao'] === 'FEITO' ? 'selected' : ''; ?>>FEITO</option>
                <option value="PAGO" <?php echo isset($_GET['situacao']) && $_GET['situacao'] === 'PAGO' ? 'selected' : ''; ?>>PAGO</option>
            </select>

            <button class="btnFiltro" type="submit">Filtrar</button>
        </form>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col"><p></p></th>
            <th scope="col"><p>Cliente</p></th>
            <th scope="col"><p>CPF cliente</p></th>
            <th scope="col"><p>Serviço</p></th>
            <th scope="col"><p>Produtos</p></th>
            <th scope="col"><p>Funcionario</p></th>
            <th scope="col"><p>Valor</p></th>
            <th scope="col"><p>Data</p></th>
            <th scope="col"><p>Comentario</p></th>
            <th scope="col"><p>Situação</p></th>
            <th scope="col"><p>Status</p></th>
            <th scope="col" class="ativar"><p>Atualizar</p></th>
            <th scope="col" class="desativar"><p>Desativar</p></th>
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
                <td scope="col"><?php echo($linha['nomeCliente']); ?></td>
                <td scope="col"><?php echo($linha['cpfCliente']); ?></td>
                <td scope="col"><?php echo($linha['nomeServicos']); ?></td>
                <td scope="col"><?php echo($linha['nomeProduto']); ?></td>
                <td scope="col"><?php echo($linha['nomeFuncionario']); ?></td>
                <td scope="col"><?php echo($linha['valorOrcamento']); ?></td>
                <td scope="col"><?php echo($linha['dataOrcamento']); ?></td>
                <td scope="col"><?php echo($linha['comentOrcamento']); ?></td>
                <td scope="col"><?php echo($linha['situacaoOrcamento']); ?></td>
                <td scope="col"><?php echo($linha['statusOrcamento']); ?></td>
                <td><a href="index.php?p=orcamento&orc=atualizar&id=<?php echo $linha['idOrcamento']; ?>">Atualizar</a></td>
                <td><a href="index.php?p=orcamento&orc=desativar&id=<?php echo $linha['idOrcamento']; ?>">Desativar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
