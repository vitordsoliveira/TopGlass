<?php
// Incluir o arquivo que contém a função Listar
require_once('./admin/class/ClassBanner.php');
$Banner = new ClassBanner();
$lista = $Banner->Listar();
?>

<article class="wow bannerRotativo animate__animated animate__fadeInUp">
    <div class="bannerR">
        <div class="site">
            <?php foreach ($lista as $linha): ?>
                <div class="banners" title="banners">
                    <img src="<?php echo htmlspecialchars($linha['caminhoBanner']); ?>" alt="<?php echo htmlspecialchars($linha['altBanner']); ?>">
                </div>
            <?php endforeach; ?>
            <div class="pagamento">
                <h2>PAGAMENTO APÓS O SERVIÇO</h2>
            </div>
        </div>
    </div>
</article>
