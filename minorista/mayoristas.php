<?php
    if(!isset($_COOKIE["user_CUIT"])) {
       header('Location: http://127.0.0.1/Proyecto_ComIT/index.php');
    }
    $servername = "localhost";
    $username = "root";
    $password = "G@liLe04";
    $dbname = "preventa";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexion BD fallida: " . $conn->connect_error);
    }
    $sql = "SELECT nombre, direccion, descripcion FROM mayoristas;";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Buscar Mayoristas - <?php echo $_COOKIE["user_name"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            include 'header-mino.php';
        ?>
        <br>
        <div class="container">
            <h2>Mayoristas</h2>
            <p>Se encontraron <?php echo $result->num_rows; ?> mayoristas:</p>            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>direccion</th>
                        <th>descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()) {
                             echo "<tr>";
                            echo "<td>"; echo "$row[id_mayor]"; echo "</td>";
                            echo "<td>"; echo "$row[fecha]"; echo "</td>";
                            echo "<td>"; echo "$row[estado]"; echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
     
    </body>
</html>