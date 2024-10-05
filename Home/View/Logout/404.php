<?php
    require_once '../../../Config/Conexion.php';
    session_destroy();
    header("Location:".URL."/View/Logout/404.php");
    exit();
?>
<h1>404</h1>