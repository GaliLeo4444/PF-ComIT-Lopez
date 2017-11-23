<?php
        if(!isset($_COOKIE["user_CUIT"])) {
            header('Location: http://127.0.0.1/Proyecto_ComIT/index.php');
        }
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "G@liLe04";
        $dbname = "preventa";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
             die("Conexion BD fallida: " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $seleccion = $_POST["seleccion"];
            if ($seleccion == "Todos"){
                $sql = "SELECT * FROM producto WHERE id_mayor=" . $_COOKIE["user_CUIT"] . ";";
                $seleccionado = 0;
            }
            elseif ($seleccion == "Sin stock"){
                    $sql = "SELECT * FROM producto WHERE id_mayor=" . $_COOKIE["user_CUIT"] . " AND stock=0;";
                    $seleccionado = 1;
            }
                else {
                        $sql = "SELECT * FROM producto WHERE id_mayor=" . $_COOKIE["user_CUIT"] . " AND stock=-1;";
                        $seleccionado = 2;
                }
        }
        else {
                $sql = "SELECT * FROM producto WHERE id_mayor=" . $_COOKIE["user_CUIT"] . ";";
                $seleccionado = 0;
        }
        $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Preventista ONLINE - Lista de Productos - <?php echo $_SESSION["nombre_com"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <link rel="icon" href="../images/Logo.gif" type="image/gif">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
             #filtro {
                background-image: url('/images/searchicon.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
                width: 100%;
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                border: 1px solid #ddd;
                margin-bottom: 12px;
             }
             
             /* Full-width input fields */
            input[type=text] {
                width: 40%;
                padding: 5px 5px;;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }
            
            textarea {
                width: 40%;
                padding: 5px 5px;;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            /* Set a style for all buttons */
            .buttonModal {
                background-color: #4CAF50;
                color: white;
                padding: 10px 16px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 30%;
                position: center;
            }

            button:hover {
                opacity: 0.7;
            }

            /* Center the image and position the close button */
            .imgcontainer {
                text-align: center;
                margin: 12px 0 12px 0;
                position: relative;
            }

            img.avatar {
                width: 40%;
                border-radius: 50%;
            }

            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                padding-top: 20px;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 40%; /* Could be more or less, depending on screen size */
                text-align:center;
                font-size: 80%;
            }

            /* The Close Button (x) */
            .close {
                position: absolute;
                right: 25px;
                top: 0;
                color: #000;
                font-size: 30px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: red;
                cursor: pointer;
            }

            /* Add Zoom Animation */
            .animate {
                -webkit-animation: animatezoom 0.6s;
                animation: animatezoom 0.6s
            }

            @-webkit-keyframes animatezoom {
                from {-webkit-transform: scale(0)} 
                to {-webkit-transform: scale(1)}
            }
            
            @keyframes animatezoom {
                from {transform: scale(0)} 
                to {transform: scale(1)}
            }

            /* Change styles for span and cancel button on extra small screens */
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }
            }

        </style>
    </head>


    <body>
        <?php
            include 'header-mayo.php';
        ?>
        <h3>Productos cargados en la base de datos:</h3>
        <br>
        <div class="container">
            <h4>Cargar pedidos por</h4>
            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <div class="col-sm-3">
                        <select class="form-control" id="seleccion" name="seleccion">
                            <option>Todos</option>
                            <option>Sin stock</option>
                            <option>Sin control de stock</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Ver</button>
            </form>
        </div>
        <br>
        <br>
        <div class="container">
            <p>Se encontraron <?php echo $result->num_rows; ?> productos</p>
            <input type="text" id="filtro" onkeyup="funcionFiltro()" placeholder="Filtrar por nombres....">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Precio Unitario</th>
                        <th>Unidades Min.</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo "<script>document.getElementById('seleccion').selectedIndex = '" . $seleccionado . "';</script>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr id='" . "$row[num]" . "' onclick='agregarURL(id, 0)'>";
                            echo "<td>" . "$row[codigo]" . "</td>";
                            echo "<td>$" . "$row[precio_unit]" . "</td>";
                            echo "<td>" . "$row[min_unit]" . "</td>";
                            if ($row['stock'] == -1) {
                               echo "<td>-</td>";
                            } else {
                                        echo "<td>" . "$row[stock]" . "</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
 
        <div id="ventanaModal" class="modal">
            <div class="modal-content animate">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('ventanaModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="../mayorista/images-productos/producto_muestra.png" alt="Imagen Producto">
                </div>
                <div>
                    <label><b>Codigo</b></label><br>
                    <input type="text" id="codigo">
                    <br><br>
                    <label><b>Precio Unitario</b></label><br>
                    <input type="text" id="precio">
                    <br><br>
                    <label><b>Mínima cantidad</b></label><br>
                    <input type="text" id="cant">
                    <br><br>
                    <label><b>Stock</b></label><br>
                    <input type="text" id="stock">
                    <br><br>
                    <label><b>Descripción</b></label><br>
                    <textarea id="desc"></textarea>
                    <br><br>
                </div>
                <div style="background-color:#f1f1f1">
                    <button type="button" class="buttonModal">Actualizar</button>
                    <button type="button" class="buttonModal" style="background-color:red" onclick='agregarURL("cualquiera", 4)'>Eliminar</button>
                </div>
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
                    URL = "datos-producto.php?p=" + id;
                    selecLlamada(URL, mostrarModal);
                }
                else {
                        URL = "manejar-producto.php?make=0" + "&num=" + id_producto;
                        window.alert(URL);
                        selecLlamada(URL, manejarProducto);
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
   
            function mostrarModal(resp) {
                var A;
                A = JSON.parse(resp);
                document.getElementById('codigo').value = A[0].codigo;
                document.getElementById('precio').value = "$" + A[0].precio_unit;
                document.getElementById('cant').value = A[0].min_unit;
                document.getElementById('stock').value = A[0].stock;
                document.getElementById('desc').value = A[0].descripcion;
                document.getElementById('ventanaModal').style.display = 'block';
            }
            
            function manejarProducto(resp) {
                    window.alert("El producto ha sido eliminado");
                    document.getElementById('ventanaModal').style.display = 'none';
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

            var modal = document.getElementById('ventanaModal');
            window.onclick = function(event) {      //Para cerrarla si se hace click fuera de la ventana modal
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
     
    </body>
</html>