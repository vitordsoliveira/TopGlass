<h2>DESATIVAR</h2>

<?php

    require_once('class/ClassServico.php');
    $id = $_GET['id'];
    $Servico = new ClassServico();

    $Servico->Desativar($id);