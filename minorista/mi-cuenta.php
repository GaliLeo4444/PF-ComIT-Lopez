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
    $sql = "SELECT id_mayor, fecha, estado FROM pedido WHERE id_minor=" . $_COOKIE["user_CUIT"] . ";";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inicio Minorista - <?php echo $_COOKIE["user_name"] ?></title>
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
        <h3>Bienvenido: <?php echo $_COOKIE["user_name"] ?></h3>
        <br>
        <br>
        <div class="container">
            <h2>Pedidos</h2>
            <p>Se encontraron <?php echo $result->num_rows; ?> pedidos:</p>            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Comercio</th>
                        <th>Fecha</th>
                        <th>Estado</th>
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