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
    <!-- Código del encabezado... -->
</head>
<body>
    <!-- Código del cuerpo de la página... -->

    <div class="log-in">
        <img src="../img/JARDIN2.jpeg" alt="">
        <h1 class="titulo">Iniciar Sesión.</h1>
        <form method="POST">
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
