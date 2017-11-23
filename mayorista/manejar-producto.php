<?php
    session_start();
    if ($_GET['make'] == '0') {
        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexion BD fallida: " . $conn->connect_error);
        }
        $sql = "DELETE FROM producto WHERE num=" . $_GET['num'];
        $myfile = fopen("TestFile.txt", "w");
        fwrite($myfile, $sql);
        fclose($myfile);
        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>