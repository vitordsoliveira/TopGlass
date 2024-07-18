<?php
require_once('./admin/class/Conexao.php');
require_once('./admin/class/ClassBanner.php');

$lista = []; // Inicializa a variável

try {
    $Banner = new ClassBanner();
    $lista = $Banner->Listar();
} catch (Exception $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
?>

<!-- HTML Structure -->
<article class="wow bannerRotativo animate__animated animate__fadeInUp">
    <div class="bannerR">
        <div class="site">
            <?php if (!empty($lista)): ?>
                <?php foreach ($lista as $linha): ?>
                    <div class="banners" title="banners">
                        <img src="img/<?php echo $linha['imgBanner']; ?>" alt="<?php echo $linha['nomeBanner']; ?>">
                    </div>
                <?php endforeach; ?>
                <div class="pagamento">
                    <h2>PAGAMENTO APÓS O SERVIÇO</h2>
                </div>
            <?php else: ?>
                <p>Nenhum banner encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</article>
