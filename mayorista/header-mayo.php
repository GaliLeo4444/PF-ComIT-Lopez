<?php
    echo '
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="http://127.0.0.1/Proyecto_ComIT/index.php">Inicio</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="">Mi Cuenta <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="mi-cuenta.php">Inicio Mi Cuenta</a></li>
                                    <li><a href="productos.php">Ver productos</a></li>
                                    <li><a href="cargar-producto.php">Cargar Productos</a></li>
                                </ul>
                            </li>
                            <li><a href="http://127.0.0.1/Proyecto_ComIT/contacto.php">Contacto</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="http://127.0.0.1/Proyecto_ComIT/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                        </ul>
                    </div>
                </div>
             </nav>
        </header>'
?>