<?php
// Incluir o arquivo que contém a função Listar
require_once ('admin/class/ClassBanner.php');
$Banner = new ClassBanner();
$lista = $Banner->Listar();

?>

<article class="wow bannerRotativo animate__animated animate__fadeInUp">
    <div class="site">
        <div class="banners">
            <?php foreach ($lista as $linha): ?>
                <img src="admin/<?php echo ($linha['caminhoBanner']); ?>"
                 alt="admin/img/banners/<?php echo ($linha['nomeBanner']); ?>">
            <?php endforeach; ?>
          </div>
        <div class="pagamento">
            <h2>PAGAMENTO APÓS O SERVIÇO</h2>
        </div>
    </div>
</article>