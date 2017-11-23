<?php
        if(!isset($_COOKIE["user_CUIT"])) {
            header('Location: http://127.0.0.1/Proyecto_ComIT/index.php');
        }
        session_start();
        $estado_p = "NO vistos";
        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
             die("Conexion BD fallida: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           $estado_p = $_POST["sel_estado"]; 
        }
        $sql = "SELECT id_minor, fecha, estado FROM pedido WHERE id_mayor=" . $_COOKIE["user_CUIT"] . ";";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preventista ONLINE - Inicio Mi Cuenta - <?php echo $_SESSION["nombre_com"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="icon" href="../images/Logo.gif" type="image/gif">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            include 'header-mayo.php';
        ?>
        <h3>Bienvenido: <?php echo $_SESSION["nombre_com"] ?></h3>
        <br>
        <br>
        <div class="container">
            <h4>Cargar pedidos por</h4>
            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="sel1">Seleccionar estado:</label>
                        <select class="form-control" id="sel_estado" name="sel_estado">
                            <option>NO vistos</option>
                            <option>Vistos</option>
                            <option>Aceptados</option>
                            <option>Rechazados</option>
                        </select>
                    </div>
                    <br>
                    <label for="orden_fecha">Orden según fecha: </label>
                    <label class="radio-inline">
                        <input type="radio" name="orden_fecha"> Ascendente
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="orden_fecha"> Descendente
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Ver</button>
            </form>
        </div>
        <br>
        <br>
        <div class="container">
            <h2>Pedidos</h2>
            <p><?php echo "Se encontraron " . $result->num_rows . " pedidos " . $estado_p; ?></p>
            <div>
                    <button type="button" class="btn btn-success">Aceptar</button>
                    <button type="button" class="btn btn-success" style="background-color:red">Rechazar</button>
           </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Comercio</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()) {
                             echo "<tr>";
                            echo "<td>"; echo "$row[id_minor]"; echo "</td>";
                            echo "<td>"; echo "$row[fecha]"; echo "</td>";
                            echo "<td>"; echo "$row[estado]"; echo "</td>";
                            echo "<td><input id=stock_check type='checkbox' name='check_estado'></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <?php
            include '../pie.php';
        ?>
     
    </body>
</html>