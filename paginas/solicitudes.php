<?php
include("conexion.php");
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
    <title>Solicitudes</title>
</head>

<body>
    <section class="fachada-1">
        <h1 align="center">Solicitudes de ingreso</h1>
        <p align="center">Te mostramos las solicitudes de ingreso que has recibido últimamente.</p>
        <br>
        <br>
        <br>
        <br>
        <table style="border-spacing: 50px;" align="center">
            <tr>
                <th align="center">Pendientes</th>
                <th align="center">Aceptados</th>
                <th align="center">Denegados</th>
            </tr>

            <?php
            $pendiente = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 0";
            $aprobada = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 1";
            $denegada = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 2";
            $ejecutarp = mysqli_query($conn, $pendiente);
            $ejecutara = mysqli_query($conn, $aprobada);
            $ejecutard = mysqli_query($conn, $denegada);

            $pendientes = array();
            $aceptados = array();
            $denegados = array();

            while ($busqueda = mysqli_fetch_array($ejecutarp)) {
                $pendientes[] = $busqueda[0];
            }

            while ($busqueda2 = mysqli_fetch_array($ejecutara)) {
                $aceptados[] = $busqueda2[0];
            }

            while ($busqueda3 = mysqli_fetch_array($ejecutard)) {
                $denegados[] = $busqueda3[0];
            }

            $maxRows = max(count($pendientes), count($aceptados), count($denegados));

            for ($i = 0; $i < $maxRows; $i++) {
                echo '<tr>';
                echo '<td>' . (isset($pendientes[$i]) ? $pendientes[$i] : '') . '</td>';
                echo '<td>' . (isset($aceptados[$i]) ? $aceptados[$i] : '') . '</td>';
                echo '<td>' . (isset($denegados[$i]) ? $denegados[$i] : '') . '</td>';
                echo '</tr>';
            }
            ?>
        </table>


    </section>
</body>

</html>