<?php
    if(!isset($_COOKIE["user_CUIT"])) {
       header('Location: ../index.php');
    }
    $servername = "localhost";
    $username = "root";
    $password = "G@liLe04";
    $dbname = "preventa";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexion BD fallida: " . $conn->connect_error);
    }
    $sql = "SELECT CUIT, nombre, direccion, descripcion FROM mayorista";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preventista ONLINE - Buscar Mayoristas - <?php echo $_COOKIE["user_name"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="icon" href="../images/Logo.gif" type="image/gif">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            include 'header-mino.php';
        ?>
        <br>
        <div class="container">
            <h2>Mayoristas</h2>
            <p>Se encontraron <?php echo $result->num_rows; ?> mayoristas:</p>            
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>direccion</th>
                        <th>descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='ver-productos.php?c=". $row['CUIT'] . "&n=" . urlencode($row['nombre']) . "'>" . $row['nombre'] . "</a></td>";
                            echo "<td>" . $row['direccion'] . "</td>";
                            echo "<td>" . $row['descripcion'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
            include '../pie.php';
        ?>

        <script>
            var xmlhttp, resp, txt = "";
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    resp = JSON.parse(this.responseText);
                    window.alert(resp[0].descripcion);
                }
            };
            
            function cualEs(id) {
                //xmlhttp.open("GET", "datos-producto.php?x=" + id, true);
                //xmlhttp.send();
                window.alert(id);
            }

            function funcionFiltro() {
                var input, filter, table, tr, td, i;
                input = document.getElementById("filtro");
                filter = input.value.toUpperCase();
                table = document.getElementById("tabla");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                                    tr[i].style.display = "none";
                        }
                    }       
                }
            }
            
        </script>
    </body>
</html>