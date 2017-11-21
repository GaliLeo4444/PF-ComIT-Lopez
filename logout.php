<?php
    session_unset();
    session_destroy(); 
    setcookie("user_CUIT", "", time() - 86400, "/");
    //setcookie("user_name", "", time() - 3600);
    header('Location: http://127.0.0.1/Proyecto_ComIT/index.php');
?>