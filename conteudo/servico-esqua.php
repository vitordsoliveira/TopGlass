<?php
require_once ('admin/class/ClassServico.php');
$Servico = new ClassServico();
$lista = $Servico->ListarAluminio();
?>

<article class="wow servico animate__animated animate__fadeInUp">
    <div class="site">
        <div class="setaE">
            <a>
                <img src="img/setae.png" alt="">
            </a>
        </div>
        <div class="servicoDegradeA">
            <?php foreach ($lista as $linha): ?>
                <div>
                    <a href="#">
                        <img src="admin/<?php echo $linha['fotoServicos']; ?>" alt="<?php echo $linha['altServicos']; ?>">
                        <h2 class="h2servico"><?php echo $linha['nomeServicos']; ?></h2>
                        <div class="pservicoV">
                            <p><?php echo $linha['descServico']; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="setaD">
        <a>
            <img src="img/setad.png" alt="">
        </a>
    </div>
</article>