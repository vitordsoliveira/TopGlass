<?php
require_once('class/ClassServico.php');

$statusFiltro = isset($_GET['status']) ? $_GET['status'] : '';
$tipoFiltro = isset($_GET['tipo']) ? $_GET['tipo'] : '';

$servico = new ClassServico();
$lista = $servico->Listar($statusFiltro, $tipoFiltro);
?>

<h2 class="tituloDashboard">SERVIÇOS</h2>

<div class="dashboard-header">
    <span class="btnDashboardOrc">
        <a href="index.php?p=servico&sr=inserir"> + Cadastrar Serviço</a>
    </span>

    <div class="filtros">
        <form method="get" action="">
            <input type="hidden" name="p" value="servico">
            
            <!-- Filtro de Status -->
            <select class="selectStatus" name="status">
                <option value="">STATUS (Todos)</option>
                <option value="ATIVO" <?php echo isset($_GET['status']) && $_GET['status'] === 'ATIVO' ? 'selected' : ''; ?>>ATIVO</option>
                <option value="INATIVO" <?php echo isset($_GET['status']) && $_GET['status'] === 'INATIVO' ? 'selected' : ''; ?>>INATIVO</option>
            </select>

            <!-- Filtro de Tipo de Serviço -->
            <select class="selectTipo" name="tipo">
                <option value="">TIPO (Todos)</option>
                <option value="VIDRO" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'VIDRO' ? 'selected' : ''; ?>>VIDRO</option>
                <option value="ALUMINIO" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'ALUMINIO' ? 'selected' : ''; ?>>ALUMINIO</option>
                <option value="ESPELHO" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'ESPELHO' ? 'selected' : ''; ?>>ESPELHO</option>
            </select>

            <button class="btnFiltro" type="submit">Filtrar</button>
        </form>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col"><p>Imagem</p></th>
            <th scope="col"><p>Nome</p></th>
            <th scope="col"><p>Tipo de Serviço</p></th>
            <th scope="col"><p>Descrição</p></th>
            <th scope="col"><p>Caminho</p></th>
            <th scope="col"><p>Status</p></th>
            <th scope="col" class="ativar"><p>Atualizar</p></th>
            <th scope="col" class="desativar"><p>Desativar</p></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $linha): ?>
            <tr>
                <td scope="col">
                    <img src="<?php echo ($linha['fotoServicos']); ?>" alt="<?php echo ($linha['nomeServicos']); ?>"
                        style="width: 80px; height: auto;">
                </td>
                <td scope="col"><?php echo ($linha['nomeServicos']); ?></td>
                <td scope="col"><?php echo ($linha['idTipoServico']); ?></td>
                <td scope="col" style="width: 25%; height: auto; vertical-align: top;">
                    <?php echo ($linha['descServico']); ?></td>
                <td scope="col"><?php echo ($linha['fotoServicos']); ?></td>
                <td scope="col"><?php echo ($linha['statusServicos']); ?></td>
                <td><a href="index.php?p=servico&sr=atualizar&id=<?php echo ($linha['idServico']); ?>">Atualizar</a></td>
                <td><a href="index.php?p=servico&sr=desativar&id=<?php echo ($linha['idServico']); ?>">Desativar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
