<?php
    setcookie("user_CUIT", "", time() - 3600);
    setcookie("user_name", "", time() - 3600);
    echo "<script language='javascript'>window.location='http://127.0.0.1/Proyecto_ComIT/index.php'</script>";
?>