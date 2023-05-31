<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <meta http-equiv="refresh" content="3;url=http://localhost/CONTROL-RESIDENCIAL/paginas/visitas.html">
</head>
<body>
<?php
include("conexion.php");

if (isset($_POST['btn-ingresar'])) {
    // Obtener los datos del visitante
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dpi = $_POST['dpi'];
    $placa_vehiculo = $_POST['placa_vehiculo'];
    $descripcion_vehiculo = $_POST['descripcion_vehiculo'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Validaciones y verificaciones de datos (código omitido por brevedad)

    // Inserción de datos en la tabla datos_visitante
    $consultadatos_visitante = "INSERT INTO datos_visitante (nombre, apellido, dpi, placa_vehiculo, descripcion_vehiculo, telefono, correo) VALUES ('$nombres', '$apellidos', '$dpi', '$placa_vehiculo', '$descripcion_vehiculo', '$telefono', '$correo')";
    $execConsultadatos_visitante = mysqli_query($conn, $consultadatos_visitante);

    if (!$execConsultadatos_visitante) {
        echo '<script>swal.fire("Error", "Error al ingresar los datos del visitante", "error");</script>';
    } else {
        // Obtener el ID del visitante insertado
        $id_visitante = mysqli_insert_id($conn);

        // Obtener los datos adicionales de la visita
        $id_residente = $_POST['id_residente'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $direccion = $_POST['direccion'];
        $motivo_visita = $_POST['motivo_visita'];

        // Verificar campos vacíos del visitante (código omitido por brevedad)

        // Insertar datos en la tabla detalle_visita
        $consultadetalle_visita = "INSERT INTO detalle_visita (id_visitante, id_residente, fecha_ingreso, direccion, motivo_visita) VALUES ('$id_visitante', '$id_residente', '$fecha_ingreso', '$direccion', '$motivo_visita')";
        $execConsultadetalle_visita = mysqli_query($conn, $consultadetalle_visita);

        if (!$execConsultadetalle_visita) {
            echo '<script>swal.fire("Error", "Error al ingresar los detalles de la visita", "error");</script>';
        } else {
            echo '<script>swal.fire("Éxito", "Solicitud ingresada con éxito", "success").then(() => {
                window.location.href = "../paginas/visitas.html";
            });</script>';
        }
    }
}
?>

</body>
</html>
