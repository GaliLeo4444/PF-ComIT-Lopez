<!DOCTYPE html>
<html>
    <head>
        <title>Inicio Mayorista</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <?php
            $servername = "localhost";
            $username = "root";
            $password = "G@liLe04";
            $dbname = "preventa";
            $mayorista = "";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexion BD fallida: " . $conn->connect_error);
            }
            $sql = "SELECT id_minor, fecha, estado FROM pedido WHERE id_mayor=" . $mayorista;
            $result = $conn->query($sql);
        ?>
    
    <body>
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="index.php">Inicio</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="home-mayorista.php">Mi Cuenta <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="">Ver pedidos</a></li>
                                    <li><a href="">Ver productos</a></li>
                                    <li><a href="cargar-producto.php">Cargar Productos</a></li>
                                </ul>
                            </li>
                            <li><a href="contacto.php">Contacto</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                        </ul>
                    </div>
                </div>
             </nav>
        </header>
        <br>
        <br>
        <div class="container">
            <h2>Pedidos</h2>
            <p>Se encontraron <?php $result->num_rows; ?> pedidos:</p>            
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
                            echo "<td>"; echo "$row[id_minor]"; echo "</td>";
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
