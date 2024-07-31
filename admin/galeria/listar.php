<?php
require_once('class/ClassGaleria.php');

$Galeria = new ClassGaleria();
$lista = $Galeria->ListarDash();
?>

<h2 class="tituloDashboard">GALERIA</h2>

<table class="table">
    <span class="btnDashboard">
        <a href="index.php?p=galeria&gl=inserir"> + Cadastrar Galeria</a>
    </span>

    <thead>
        <tr>
            <th scope="col">
                <p>Imagem</p>
            </th>
            <th scope="col">
                <p>Nome</p>
            </th>
            <th scope="col">
                <p>Caminho</p>
            </th>
            <th scope="col">
                <p>Descrição</p>
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
            <tr>
                <!-- Exibindo a imagem -->
                <td scope="col">
                    <img src="<?php echo ($linha['caminhoGaleria']); ?>"
                        alt="<?php echo ($linha['nomeGaleria']); ?>"
                        style="width: 150px; height: auto;">
                </td>
                <!-- Exibindo o nome do Galeria -->
                <td scope="col"><?php echo ($linha['nomeGaleria']); ?></td>
                <!-- Exibindo o caminho do Galeria -->
                <td scope="col"><?php echo ($linha['caminhoGaleria']); ?></td>
                <!-- Exibindo a descrição do Galeria -->
                <td scope="col"><?php echo ($linha['altGaleria']); ?></td>
                <!-- Exibindo o status do Galeria -->
                <td scope="col"><?php echo ($linha['statusGaleria']); ?></td>
                <!-- Links para atualizar e desativar -->
                <td>
                    <a href="index.php?p=galeria&gl=atualizar&id=<?php echo ($linha['idGaleria']); ?>">Atualizar</a>
                </td>
                <td>
                    <a href="index.php?p=galeria&gl=desativar&id=<?php echo ($linha['idGaleria']); ?>">Desativar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
