<?php
    if(!isset($_COOKIE["user_CUIT"])) {
       header('Location: ../index.php');
    }
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preventista ONLINE - Pedido - <?php echo $_COOKIE["user_name"] ?></title>
        <meta charset="UTF-8">
        <link rel="icon" href="../images/Logo.gif" type="image/gif">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            include 'header-mino.php';
        ?>
        <h3>Pedido para: <?php echo $_SESSION["mayo_nombre"] ?></h3>
        <br>
        <br>
        <div class="container">
            <p>Se agregaron <?php echo $_SESSION["cant_p_p"]; ?> productos:</p>
            <div class="col-sm-6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($x = 1; $x <= $_SESSION["cant_p_p"]; $x++) {
                                echo "<tr>";
                                echo "<td>" . $_SESSION["pedido"] [$x]["cod"] . "</td>";
                                echo "<td>" . $_SESSION["pedido"] [$x]["cant"] . "</td>";
                                echo "<td><input id=stock_check type='checkbox' name='check_borrar'></td>";
                                echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-success" onclick="agregarURL('cualquiera', 0)">Enviar</button>
            <button type="button" class="btn btn-success" style="background-color:red">Eliminar Pedido</button>
            <button type="button" class="btn btn-success" style="background-color:red">Eliminar Seleccionados</button>
            </div>
        </div>
        
        <?php
            include '../pie.php';
        ?>
        
        <script>
            var id_producto;        //Mantiene el ID del último producto seleccionado

            function agregarURL(id, quien_llamo) {
                var URL;
                if (quien_llamo == 0) {         //MostrarModal
                    id_producto = id;
                    URL = "../minorista/manejar-pedido.php?make=0";
                    selecLlamada(URL, pedidoAgregado);
                }
            }
            
            function selecLlamada(url, cFunction) {
                var xhttp;
                xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        cFunction(this.responseText);
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            }
   
            function mostrarEnviado(resp) {
            }
            
            function pedidoAgregado(resp) {
                if (resp = "OK") {
                    window.alert("El pedido se registró correctamente");
                }
                else {
                        window.alert(resp);
                }
            }

        </script>
     
    </body>
</html>