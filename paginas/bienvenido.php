<?php
include("conexion.php");

// Verificar si el usuario ha iniciado sesión correctamente
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    exit;
}

$correo = $_SESSION['correo'];

// Obtener los datos del residente desde la base de datos
$consulta = "SELECT * FROM residente WHERE CORREO = '$correo'";
$resultado = mysqli_query($conn, $consulta);
$fila = mysqli_fetch_assoc($resultado);

// Mostrar los datos del residente
$nombre = $fila['NOMBRE'];
$apellido = $fila ['APELLIDO'];
$codigo = $fila['ID_RESIDENTE'];
$telefono = $fila['TELEFONO'];
$correo = $fila['CORREO'];
$numeroCasa = $fila['NUMERO_CASA'];

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
    <title>Bienvenido</title>
</head>
<body>

<div class="datos">
    <h1>Bienvenido, <?php echo $nombre; ?>!</h1>
    <p>codigo: <?php echo $codigo; ?></p>
    <p>Nombre: <?php echo $nombre . ' ' . $apellido; ?></p>
    <p>Apellido: <?php echo $apellido; ?></p>
    <p>Número de Casa: <?php echo $numeroCasa; ?></p>
    <p>Correo Electronico: <?php echo $correo; ?></p>
    <p>Teléfono: <?php echo $telefono; ?></p>
</div>


    <br>
    <br>
    <br>

     <section class="fachada-1">
        <h1 align="center">Solicitudes de ingreso</h1>
        <p align="center">Te mostramos las solicitudes de ingreso que has recibido últimamente.</p>
        <br>
        <br>
        <br>
        <br>
         <div id="id01" class="w3-modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-hor-8 w3-display-topright">&times;</span>
		<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:600px">

			<section class="card-solicitud">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <h2>Solicitud.</h2>
                        <p>Nombre Completo del Visitante: <?php echo $nombre_visita . ' ' . $apellido; ?></p>
                        <p>DPI: <?php echo $dpi_visita; ?></p>
                        <p>Descripcion del Vehículo: <?php echo $descripcion_visita; ?></p>
                        <p>Telefono: <?php echo $telefono_visita; ?></p>
                        <p>Fecha de ingreso: <?php echo $fecha_visita; ?></p>
                        <p>Motivo: <?php echo $motivo_visita; ?></p>
                <article>
                    <p>¿Qué deseas realizar con esta solicitud?</p>
                    
                    <a href="actualizar.php?codigo=<?php echo $codigo; ?>&id_detalle_visita=<?php echo $id_detalle_visita; ?> ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </a>
                    
                    <a href="denegar.php?codigo=<?php echo $codigo; ?>&id_detalle_visita=<?php echo $id_detalle_visita; ?> ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                        
                
                </article>
			</section>

		</div>
        <table style="border-spacing: 50px;" align="center">
            <tr>
                <th align="center">Pendientes</th>
                <th align="center">Aceptados</th>
                <th align="center">Denegados</th>
            </tr>

            <?php
            //codigo para mostrar las solicitudes en la tabla
            $pendiente = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 0 AND ID_RESIDENTE=".$codigo;
            $aprobada = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 1 AND ID_RESIDENTE=".$codigo;
            $denegada = "SELECT NOMBRE_COMPLETO FROM VISTA_SOLICITUD WHERE ID_STATUS = 2 AND ID_RESIDENTE=".$codigo;
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
                echo '<td><button onclick="document.getElementById('id01').style.display='block'" class="user">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>' . (isset($pendientes[$i]) ? $pendientes[$i] : '') . '</td>';
                echo '<td>' . (isset($aceptados[$i]) ? $aceptados[$i] : '') . '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></td>';
                echo '<td>' . (isset($denegados[$i]) ? $denegados[$i] : '') . '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></td>';
                echo '</tr>';
            }
            ?>
        </table>


    </section>

</body>
</html>
