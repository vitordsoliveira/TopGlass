<h2>DESATIVADO</h2>

<?php

    require_once('class/ClassOrcamento.php');
    $id = $_GET['id'];
    $orcamento = new ClassOrcamento();

    $orcamento->Desativar($id);
?>

