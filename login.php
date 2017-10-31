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
        
        <div class="container"><h3>Inicie sesión en su cuenta....</h3><br>
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
               <label class="control-label col-sm-2" for="Email">Email:</label>
               <div class="col-sm-10">
                   <input id="Email" class="form-control" type="email" name="Email" placeholder="ejemplo@servermail.com">
               </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="Pass">Contraseña:</label>
               <div class="col-sm-10">
                   <input id="Pass" class="form-control" type="password" name="Pass">
               </div>
            </div>
            <button type="button" class="btn btn-success">Entrar</button>
        </form>
        </div>
        
        <?php
        // put your code here
        ?>
        
    </body>
</html>
