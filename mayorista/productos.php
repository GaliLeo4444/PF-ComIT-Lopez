<?php
        if(!isset($_COOKIE["user_CUIT"])) {
            echo "<script language='javascript'>window.location='http://127.0.0.1/Proyecto_ComIT/index.php'</script>";
        }
        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
             die("Conexion BD fallida: " . $conn->connect_error);
        }
        $sql = "SELECT codigo, precio_unit, min_unit, stock, descripcion FROM producto WHERE id_mayor=" . $_COOKIE["user_CUIT"] . ";";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Productos - <?php echo $_COOKIE["user_name"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            include 'header-mayo.php';
        ?>
        <h3>Productos cargados en la base de datos:</h3>
        <br>
        <br>
        <div class="container">
            <p>Se encontraron <?php echo $result->num_rows; ?> productos</p>            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Precio Unitario</th>
                        <th>Unidades Min.</th>
                        <th>Stock</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()) {
                             echo "<tr>";
                            echo "<td>"; echo "$row[codigo]"; echo "</td>";
                            echo "<td>"; echo "$row[precio_unit]"; echo "</td>";
                            echo "<td>"; echo "$row[min_unit]"; echo "</td>";
                            if ($row['stock'] == -1) {
                               echo "<td>N/A</td>";
                            } else {
                                        echo "<td>"; echo "$row[stock]"; echo "</td>";
                            }
                            echo "<td>"; echo "$row[descripcion]"; echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
     
    </body>
</html>