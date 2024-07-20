<?php
session_start();

session_unset();

session_destroy();

header('location:http://localhost/topglass/admin/login.php');

exit();