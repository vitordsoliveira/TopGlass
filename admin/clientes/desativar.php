<h2>DESATIVAR</h2>

<?php

    require_once('class/ClassCliente.php');
    $id = $_GET['id'];
    $cliente = new ClassCliente();

    $cliente->Desativar($id);