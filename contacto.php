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
                        <a class="navbar-brand" href="index.php">PoneleUnNombre</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="home-mayorista.php">Page 2</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href=""><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                    </div>
                </div>
             </nav>
        </header>
        <br>
        <br>

        <?php
            $nombre_error = $email_error = "";
            $nombre = $email = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $name_error = "Su nombre es requerido!!!!";
                } else {
                    $nombre = test_input($_POST["nombre"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
                        $nombre_error = "Solo letras y espacios en blanco son permitidos!!!!";
                    }
                }

                if (empty($_POST["Email"])) {
                    $email_error = " Un email es requerido!!!!";
                } else {
                    $email = test_input($_POST["Email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email_error = "Formato de email inválido";
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

        <div class="container"><h3>Formulario de contacto</h3><br>
          <p class="error">* Campos requeridos.</p>
          <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <label class="control-label col-sm-2" for="name">Nombre:</label>
               <div class="col-sm-10">
                   <input id="Nombre" class="form-control" type="text" name="name">
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
               <label class="control-label col-sm-2" for="Comentario">Comentario:</label>
               <div class="col-sm-10">
                   <textarea class="form-control" id="Coment" name="coment"></textarea>
               </div>
            </div>
            <button type="button" class="btn btn-success">Enviar</button>
          </form>
        </div>

    </body>
</html>