<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrarse</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    
    <?php
            $CUIT_error = $name_error = $email_error = $dire_error = "";
            $CUIT = $name = $email = $dire = "";
            $longitud = $todoOK = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $longitud = strlen($_POST["CUIT"]);
                if ($longitud != 11) {
                   $CUIT_error = " LONGITUD INVALIDA!!!!";
                } else {
                            $CUIT = test_input($_POST["CUIT"]);
                            if (preg_match("/^[0-9]*$/", $CUIT)) {
                                $todoOK += 1;
                            } else {
                                        $CUIT_error = " INVALIDO!!!!";
                            }
                   }
                $longitud = strlen($_POST["name"]);
                if ($longitud > 48 || $longitud < 7) {
                    $name_error = " INVALIDO (demasiado corto o demasiado largo)!!!!";
                } else {
                        $name = test_input($_POST["name"]);
                        if (!preg_match("/^[a-zA-Z .-]*$/", $name)) {
                        $name_error = "Solo permitido letras (sin tildes), espacios, '.' y '-'";
                        } else {
                                   $todoOK += 1; 
                        }
                }
                if (empty($_POST["Email"])) {
                    $email_error = "Un Email es requerido";
                } else {
                            $email = test_input($_POST["Email"]);
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $email_error = "FORMATO INVALIDO!!!!";
                            } else {
                                   $todoOK += 1; 
                            }
                }
                $longitud = strlen($_POST["dire"]);
                if ($longitud > 64) {
                    $dire_error = "DEMASIADO LARGA!!!!";
                } else {
                        $dire = test_input($_POST["dire"]);
                        if (!preg_match("/^[a-zA-Z 0-9.-]*$/", $dire)) {
                        $dire_error = "Solo permitido letras (sin tildes), espacios, '.' y '-'";
                        } else {
                                   $todoOK += 1; 
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
    
    <body>
        <?php
            include 'barra-nav.php';
        ?>
        <br>
        <br>
        <div class="container"><h3>Ingrese sus datos....</h3><br>
          <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <label class="control-label col-sm-2" for="CUIT">CUIT / CUIL:</label>
               <div class="col-sm-4">
                   <input id="CUIT" class="form-control" type="text" name="CUIT" maxlength="11">
                   Ingrese solo números (11 dígitos) <label class="error"><?php echo $CUIT_error;?></label>   
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="name">Nombre:</label>
               <div class="col-sm-4">
                   <input id="name" class="form-control" type="text" name="name">
                   Nombre del comercio o el suyo <label class="error"><?php echo $name_error;?></label>   
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="Email">Email:</label>
               <div class="col-sm-4">
                   <input id="Email" class="form-control" type="email" name="Email" placeholder="ejemplo@servermail.com">
                   <label class="error"><?php echo $email_error;?></label>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Dirección:</label>
               <div class="col-sm-4">
                   <input id="dire" class="form-control" type="text" name="dire" maxlength="64">
                   <label class="error"><?php echo $dire_error;?></label>
               </div>
            </div>
            <button type="submit" class="btn btn-success">Registrarse</button>
          </form>
        </div>
        <br>
        <br>
        
        <?php
            echo $CUIT . "<br>";
            echo $name . "<br>";
            echo $email . "<br>";
            echo $dire . "<br>";
            if ($todoOK == 4) {
                $servername = "localhost";
                $username = "root";
                $DBpass = "G@liLe04";
                $DBname = "preventa";
                $conn = new mysqli($servername, $username, $DBpass, $DBname);
                if ($conn->connect_error) {
                   die("Conexion BD fallida: " . $conn->connect_error);
                }
                $sql = "SELECT CUIT_CUIL, nombre, pass FROM minorista WHERE CUIT_CUIL=" . $CUIT . ";";
                $result = $conn->query($sql);
                if ($row = $result->fetch_assoc()) {
                   echo "El CUIT/CUIL ingresado ya ha sido registrado anteriormente";
                } else {
                            $pass = substr($name, 0, 7) . substr($CUIT, 2);
                            $sql = "INSERT INTO minorista (CUIT_CUIL, nombre, email, pass, direccion) VALUES ('" . 
                                     $CUIT . "', '" . $name . "', '" . $email . "', '" . $pass . "', '" . $dire . "')";
                            if ($conn->query($sql) === TRUE) {
                                echo "Se ha registrado correctamente<br>";
                                echo "Ingrese a su casilla de email para verificar su cuenta";
                            } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                }
            }
        ?>
        
    </body>
</html>
