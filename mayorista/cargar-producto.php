g?<php
            if(!isset($_COOKIE["user_CUIT"])) {
                echo "<script language='javascript'>window.location='http://127.0.0.1/Proyecto_ComIT/index.php'</script>";
            }
            $cod_error = $precio_error = $cant_error = $stock_error = $desc_error = "";
            $codigo = $desc = "";
            $precio = $cant = $stock = 0;
            $longitud = $todoOK = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $longitud = strlen($_POST["codigo"]);
                if ($longitud > 16) {
                   $cod_error = " LONGITUD INVALIDA!!!!";
                } else {
                            $codigo = test_input($_POST["codigo"]);
                            if (preg_match("/^[a-zA-Z0-9-]*$/", $codigo)) {
                                $todoOK += 1;
                            } else {
                                        $cod_error = " INVALIDO!!!!";
                            }
                   }
                if (empty($_POST["precio"])) {
                    $precio = 0;
                } else {
                            $precio = test_input($_POST["precio"]);
                            if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
                                $precio_error = "NUMERO iNVALIDO!!!!";
                            } else {
                                   $todoOK += 1; 
                            }
                }
                if (empty($_POST["cant"])) {
                    $cant = 0;
                } else {
                            $cant = test_input($_POST["cant"]);
                            if (!filter_var($cant, FILTER_VALIDATE_INT)) {
                                $cant_error = "NUMERO iNVALIDO!!!!";
                            } else {
                                   $todoOK += 1; 
                            }
                }
                if (!($_POST["stock_check"])) {
                    $stock = -1;
                } else {
                            $stock = test_input($_POST["stock"]);
                            if (!filter_var($cant, FILTER_VALIDATE_INT)) {
                                $stock_error = "NUMERO iNVALIDO!!!!";
                            } else {
                                   $todoOK += 1; 
                            }
                }
                $longitud = strlen($_POST["desc"]);
                if ($longitud > 256) {
                    $desc_error = "DEMASIADO LARGA!!!!";
                } else {
                        $desc = test_input($_POST["desc"]);
                        if (!preg_match("/^[a-zA-Z 0-9.-]*$/", $desc)) {
                        $desc_error = "Solo permitido letras (sin tildes), espacios, '.' y '-'";
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

<!DOCTYPE html>
<html>
    <head>
        <title>Agregar Productos</title>
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
        <br>
        <div class="container"><h3>Ingresar nuevo producto</h3><br>
          <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <label class="control-label col-sm-2">Código:</label>
               <div class="col-sm-4">
                   <input id="codigo" class="form-control" type="text" name="codigo" maxlength="16">
                   Se permiten dígitos alfanumeros (máx 16) <label class="error"><?php echo $cod_error;?></label>   
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Precio Unitario:</label>
               <div class="col-sm-4">
                   <input id="precio" class="form-control" type="text" name="precio" placeholder="xx.xx">
                   <label class="error"><?php echo $precio_error;?></label>   
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Cantidad mínima:</label>
               <div class="col-sm-4">
                   <input id="cant" class="form-control" type="text" name="cant">
                   <label class="error"><?php echo $cant_error;?></label>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Stock:</label>
               <div class="col-sm-4">
                   <input id=stock_check type="checkbox" name="stock_check" value="stock_check">  Manejar Stock
                   <input id="stock" class="form-control" type="text" name="stock">
                   <label class="error"><?php echo $stock_error;?></label>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Descripción:</label>
               <div class="col-sm-4">
                   <input id="desc" class="form-control" type="text" name="desc" maxlength="256">
                   <label class="error"><?php echo $desc_error;?></label>
               </div>
            </div>
            <button type="submit" class="btn btn-success">Agregar Producto</button>
          </form>
        </div>
        <br>
        <br>
        
        <?php
            echo $codigo . "<br>";
            echo $precio . "<br>";
            echo $cant . "<br>";
            echo $stock . "<br>";
            echo $desc . "<br>";
            if ($todoOK == 5) {
                $servername = "localhost";
                $username = "root";
                $DBpass = "G@liLe04";
                $DBname = "preventa";
                $conn = new mysqli($servername, $username, $DBpass, $DBname);
                if ($conn->connect_error) {
                   die("Conexion BD fallida: " . $conn->connect_error);
                }
                $sql = "INSERT INTO producto (id_mayor, codigo, precio_unit, min_unit, stock, descripcion) VALUES (" . 
                        $_COOKIE["user_CUIT"] . ", '" . $codigo . "', " . $precio . ", " . $cant . ", " . $stock . ", '" . $desc . "');";
                if ($conn->query($sql) === TRUE) {
                    echo "El producto se ha agregado correctamente";
                } else {
                           echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        ?>

    </body>
</html>
