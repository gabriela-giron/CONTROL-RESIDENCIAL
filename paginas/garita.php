


<?php
include("conexion.php");



if(isset($_POST["btn-ingresar"])) {
    $correo = $_POST["Correo"];
    $contraseña = $_POST["Contraseña"];

    if ($correo == "admin" && $contraseña == "admin") {
        // Las credenciales son correctas
        echo "Inicio de sesión exitoso";

        // Consulta SQL para obtener los campos deseados de la tabla detalle_visita
        $query = "SELECT ID_DETALLE_VISITA, ID_RESIDENTE, FECHA_INGRESO, DIRECCION, ID_STATUS FROM detalle_visita";

        // Ejecutar la consulta
        $result = mysqli_query($conn, $query);

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Mostrar los resultados en una tabla
            echo '<table>
                    <tr>
                        <th>ID Detalle Visita</th>
                        <th>ID Residente</th>
                        <th>Fecha Ingreso</th>
                        <th>Dirección</th>
                        <th>Status</th>
                    </tr>';

            // Recorrer los resultados y mostrarlos en filas de la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>'.$row['ID_DETALLE_VISITA'].'</td>';
                echo '<td>'.$row['ID_RESIDENTE'].'</td>';
                echo '<td>'.$row['FECHA_INGRESO'].'</td>';
                echo '<td>'.$row['DIRECCION'].'</td>';
                echo '<td>'.$row['ID_STATUS'].'</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No se encontraron registros.';
        }
    } else {
        // Las credenciales son incorrectas
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Garita.</title>
</head>
<body>
   
<div class="nav">
        <h3 class="titulo-nav">Los Jardines.</h3>
        <nav class="navegacion">
            <ul class="opciones">
                <li><a href="visitas.html">Solicitar visita</a></li>
                <li><a href="#">Residentes</a></li>
		<li><a href="garita.php">Garita</a></li>
            </ul>
        </nav>
    </div>
    <div class="form1">
        <img src="../img/JARDIN2.jpeg" alt="">
        
        <form method="POST">
	    <h1 class="titulo">Iniciar Sesión.</h1>
            <label for="correo">Correo</label>
            <input type="text" name="Correo" required>
            <label for="passw">Contraseña</label>
            <input type="password" name="Contraseña" required>

            <hr>
            <button class="log-in" name="btn-ingresar">Ingresar</button>
        </form>
    </div>
</body>
</html>
