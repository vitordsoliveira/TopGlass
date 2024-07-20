<h2>DESATIVAR</h2>

<?php

    require_once('class/ClassBanner.php');
    $id = $_GET['id'];
    $Banner = new ClassBanner();

    $Banner->Desativar($id);