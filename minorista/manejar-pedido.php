<?php
    session_start();
    if ($_GET["make"] == '0') {
    if ($_SESSION["cant_p_p"] > 0) {
        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexion BD fallida: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `pedido` (`id_mayor`, `id_minor`, `cantidad`, `fecha`, `estado`) VALUES ('" . $_SESSION['mayo_CUIT'] . "', '" . $_COOKIE['user_CUIT'] . "', '" . $_SESSION['cant_p_p'] . "', CURRENT_TIMESTAMP, 'presentado')";
        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    }
?>