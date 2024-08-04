<?php
require_once('class/ClassOrcamento.php');

// Captura os filtros da URL
$statusFiltro = isset($_GET['status']) ? $_GET['status'] : '';
$situacaoFiltro = isset($_GET['situacao']) ? $_GET['situacao'] : '';

// Cria uma instância da classe ClassOrcamento
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
                <option value="ATIVO" <?php echo $statusFiltro === 'ATIVO' ? 'selected' : ''; ?>>ATIVO</option>
                <option value="INATIVO" <?php echo $statusFiltro === 'INATIVO' ? 'selected' : ''; ?>>INATIVO</option>
            </select>

            <!-- Filtro de Situação -->
            <select class="selectSituacao" name="situacao">
                <option value="">SITUAÇÃO (Todos)</option>
                <option value="PENDENTE" <?php echo $situacaoFiltro === 'PENDENTE' ? 'selected' : ''; ?>>PENDENTE</option>
                <option value="FEITO" <?php echo $situacaoFiltro === 'FEITO' ? 'selected' : ''; ?>>FEITO</option>
                <option value="PAGO" <?php echo $situacaoFiltro === 'PAGO' ? 'selected' : ''; ?>>PAGO</option>
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
            // Define a classe da bolinha e a classe da situação com base na situação
            $bolinhaClasse = '';
            $situacaoClasse = '';
            switch ($linha['situacaoOrcamento']) {
                case 'PENDENTE':
                    $bolinhaClasse = 'bolinha-amarela';
                    $situacaoClasse = 'situacao-pendente';
                    break;
                case 'FEITO':
                    $bolinhaClasse = 'bolinha-laranja';
                    $situacaoClasse = 'situacao-feito';
                    break;
                case 'PAGO':
                    $bolinhaClasse = 'bolinha-verde';
                    $situacaoClasse = 'situacao-pago';
                    break;
            }
            ?>
            <tr>
                <td>
                    <span class="bolinha <?php echo $bolinhaClasse; ?>"></span>
                </td>
                <td><?php echo ($linha['nomeCliente']); ?></td>
                <td><?php echo ($linha['cpfCliente']); ?></td>
                <td><?php echo ($linha['nomeServicos']); ?></td>
                <td><?php echo ($linha['nomeProduto']); ?></td>
                <td><?php echo ($linha['nomeFuncionario']); ?></td>
                <td><?php echo ($linha['valorOrcamento']); ?></td>
                <td><?php echo ($linha['dataOrcamento']); ?></td>
                <td><?php echo ($linha['comentOrcamento']); ?></td>
                <td class="<?php echo $situacaoClasse; ?>"><?php echo ($linha['situacaoOrcamento']); ?></td>
                <td><?php echo ($linha['statusOrcamento']); ?></td>
                <td><a href="index.php?p=orcamento&orc=atualizar&id=<?php echo $linha['idOrcamento']; ?>">Atualizar</a></td>
                <td><a href="index.php?p=orcamento&orc=desativar&id=<?php echo $linha['idOrcamento']; ?>">Desativar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
