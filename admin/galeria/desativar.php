<h2>DESATIVAR</h2>

<?php

    require_once('class/ClassGaleria.php');
    $id = $_GET['id'];
    $Galeria = new ClassGaleria();

    $Galeria->Desativar($id);