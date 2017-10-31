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
                        <a class="navbar-brand" href="index.php">Home</a>
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
        <h3>Pedidos pendientes:</h3>
        <br>
        
        
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "G@liLe04";
            $dbname = "preventa";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id_minor, fecha, cantidad FROM pedido WHERE id_mayor=4444";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "Comercio: " . $row["id_minor"]. " - Fecha: " . $row["fecha"]. "Cantidad: " . $row["cantidad"]. "<br>";
                }
            } else {
                    echo "No se encontraron pedidos!!!!";
            }
        
       /* <div class="container">
  <h2>Table</h2>
  <p>Using all the table classes on one table:</p>                                          
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Anna</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Debbie</td>
      </tr>
      <tr>
        <td>3</td>
        <td>John</td>
      </tr>
    </tbody>
  </table>
</div>
        */
        ?>
        
    </body>
</html>
