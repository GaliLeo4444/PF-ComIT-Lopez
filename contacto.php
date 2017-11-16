<!DOCTYPE html>
<html>
    <head>
        <title>Contacto</title>
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
            $nombre_error = $email_error = "";
            $nombre = $email = $mensaje = $todoOK = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nombre_error = "Su nombre es requerido!!!!";
                } else {
                        $nombre = test_input($_POST["name"]);
                        if (empty($_POST["Email"])) {
                            $email_error = " Un email es requerido!!!!";
                        } else {
                                    $email = test_input($_POST["Email"]);
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        $email_error = "FORMATO INVALIDO!!!!";
                                    } else {
                                                $mensaje = test_input($_POST["mensaje"]);
                                                $todoOK = "Su mensaje ha sido enviado correctamente";
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
    
    <body>
        <?php
            include 'barra-nav.php';
        ?>
        <br>
        <br>
        <div class="container"><h3>Formulario de contacto</h3><br>
          <p class="error">* Campos requeridos.</p>
          <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <label class="control-label col-sm-2" for="name">Nombre:</label>
               <div class="col-sm-10">
                   <input id="name" class="form-control" type="text" name="name">
                   <span class="error">* <?php echo $nombre_error;?></span>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="Email">Email:</label>
               <div class="col-sm-10">
                   <input id="Email" class="form-control" type="email" name="Email" placeholder="ejemplo@servermail.com">
                   <span class="error">* <?php echo $email_error;?></span>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2">Mensaje:</label>
               <div class="col-sm-10">
                   <textarea class="form-control" id="mensaje" name="mensaje"></textarea>
               </div>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
          </form>
        </div>
        <br>
        <br>
        
        <?php
            echo $todoOK;
            echo $nombre . "<br>";
            echo $email . "<br>";
            echo $mensaje . "<br>";
        ?>

    </body>
</html>
