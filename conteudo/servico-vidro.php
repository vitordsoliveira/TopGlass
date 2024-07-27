<?php
require_once('admin/class/ClassServico.php');
$Servico = new ClassServico();
$lista = $Servico->ListarVidro();
?>

<article class="wow servico animate__animated animate__fadeInUp">
    <div class="site">
        <div class="setaE">
            <img src="img/setae.png" alt="">
        </div>
        <div class="servicoDegradeV">
            <?php foreach ($lista as $linha): ?>
            <div>
                <a href="">
                    <img src="admin/<?php echo $linha['fotoServicos']; ?>" alt="<?php echo $linha['altServicos']; ?>">
                    <h2 class="h2servico"><?php echo $linha['nomeServicos']; ?></h2>
                    <div class="pservicoV">
                        <p><?php echo $linha['descServico']; ?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="setaD">
            <img src="img/setad.png" alt="">
        </div>
    </div>
</article>
