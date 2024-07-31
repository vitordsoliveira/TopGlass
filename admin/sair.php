<?php
session_start();

session_unset();

session_destroy();

header('location:http://localhost/topglass/');
//header('location:https://topglass.smpsistema.com.br/index.php');

exit();