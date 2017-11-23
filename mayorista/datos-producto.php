<?php
        header("Content-Type: application/json; charset=UTF-8");
        $num_producto = $_GET["p"];

        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
             die("Conexion BD fallida: " . $conn->connect_error);
        }
        $sql = "SELECT codigo, precio_unit, min_unit, stock, descripcion FROM producto WHERE num=" . $num_producto;
        $result = $conn->query($sql);
        
        $respuesta = array();
        $respuesta = $result->fetch_all(MYSQLI_ASSOC);
        
        /*
        $myfile = fopen("TestFile.txt", "w");
        $txt = $respuesta[descripcion];
        fwrite($myfile, $txt);    
        fclose($myfile);
        */
        
        echo json_encode($respuesta);
?>