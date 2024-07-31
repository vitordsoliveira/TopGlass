<?php
require_once('class/ClassBanner.php');

$banner = new ClassBanner();
$lista = $banner->ListarDash();
?>

<h2 class="tituloDashboard">BANNERS</h2>

<table class="table">
    <span class="btnDashboard">
        <a href="index.php?p=banner&bn=inserir"> + Cadastrar Banner</a>
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
    
                <td scope="col">
                    <img src="<?php echo ($linha['caminhoBanner']); ?>"
                        alt="<?php echo ($linha['nomeBanner']); ?>"
                        style="width: 150px; height: auto;">
                </td>

                <td scope="col"><?php echo ($linha['nomeBanner']); ?></td>
         
                <td scope="col"><?php echo ($linha['caminhoBanner']); ?></td>
    
                <td scope="col"><?php echo ($linha['altBanner']); ?></td>

                <td scope="col"><?php echo ($linha['statusBanner']); ?></td>
     
                <td>
                    <a href="index.php?p=banner&bn=atualizar&id=<?php echo ($linha['idBanner']); ?>">Atualizar</a>
                </td>
                <td>
                    <a href="index.php?p=banner&bn=desativar&id=<?php echo ($linha['idBanner']); ?>">Desativar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
