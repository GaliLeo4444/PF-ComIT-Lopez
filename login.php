<?php
            $msg_error = "";
            $CUIT = $pass = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["CUIT"])) {
                    $msg_error = "Ingrese ambos campos";
                } else {
                            $CUIT = test_input($_POST["CUIT"]);
                            if ((!preg_match("/^[0-9]*$/", $CUIT)) or (strlen($CUIT) != 11)) {
                                $msg_error = " INVALIDO!!!!";
                            } else {
                                        if (empty($_POST["pass"])) {
                                            $msg_error = "Ingrese ambos campos";
                                        } else {
                                                    $pass = test_input($_POST["pass"]);
                                                    $servername = "localhost";
                                                    $username = "root";
                                                    $DBpass = "G@liLe04";
                                                    $DBname = "preventa";
                                                    $conn = new mysqli($servername, $username, $DBpass, $DBname);
                                                    if ($conn->connect_error) {
                                                        die("Conexion BD fallida: " . $conn->connect_error);
                                                    }
                                                   if ($_POST["comercio"] == "minorista") {
                                                      $sql = "SELECT CUIT_CUIL, nombre, pass FROM minorista WHERE CUIT_CUIL=" . $CUIT . " AND pass='" . $pass . "';";
                                                   } else {
                                                                $sql = "SELECT CUIT, nombre, pass FROM mayorista WHERE CUIT=" . $CUIT . " AND pass='" . $pass . "';";
                                                   }
                                                   $result = $conn->query($sql);
                                                   if ($row = $result->fetch_assoc()) {
                                                      setcookie('user_CUIT', $CUIT, time() + 1200, "/");
                                                      setcookie('user_name', $row["nombre"], time() + 1200, "/");
                                                      if ($_POST["comercio"] == "minorista") {
                                                          echo "<script language='javascript'>window.location='minorista/mi-cuenta.php'</script>";
                                                      } else {
                                                                echo "<script language='javascript'>window.location='mayorista/mi-cuenta.php'</script>";
                                                      }
                                                   } else {
                                                            $msg_error = "CUIT/CUIL o contraseña incorrecto/s";
                                                   }
                                        }
                            }
                }
            }
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Entrar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <?php
            include 'barra-nav.php';
        ?>
        <br>
        <br>
        
        <div class="container"><h3>Inicie sesión en su cuenta....</h3><br>
          <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <label class="control-label col-sm-2" for="CUIT / CUIL">CUIT / CUIL:</label>
               <div class="col-sm-4">
                   <input id="CUIT" class="form-control" type="text" name="CUIT" maxlength="11">
                   <?php echo $msg_error;?>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="Contraseña">Contraseña:</label>
               <div class="col-sm-4">
                   <input id="pass" class="form-control" type="password" name="pass">
                   <?php echo $msg_error;?>
               </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="radio" name="comercio" value="minorista" checked> Minorista<br>
                    <input type="radio" name="comercio" value="mayorista"> Mayorista
                </div>
            </div><br>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        </div>
        <br>
        <br>
        
    </body>
</html>
