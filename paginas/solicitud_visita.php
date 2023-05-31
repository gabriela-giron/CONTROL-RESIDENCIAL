<html>
<head> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <meta http-equiv="refresh" content="2;url=http://localhost/CONTROL-RESIDENCIAL/paginas/visitas.html">

</head>

<body>
    <?php
    include("conexion.php");

    if (isset($_POST['btn-ingresar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dpi = $_POST['dpi'];
        $placa = $_POST['placa'];
        $descripcion = $_POST['descripcion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        // Verificar campos vacíos
        if (empty($nombre) || empty($apellido) || empty($dpi) || empty($placa) || empty($descripcion) || empty($telefono) || empty($correo)) {
            echo '<script>swal.fire("Error", "Por favor complete todos los campos", "error");</script>';
            exit;
        }

        // Verificar longitud del DPI
        if (strlen($dpi) !== 13) {
            echo '<script>swal.fire("Error", "El DPI debe tener 13 dígitos", "error");</script>';
            exit;
        }

        // Verificar formato de correo válido
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo '<script>swal.fire("Error", "El correo proporcionado no es válido", "error");</script>';
            exit;
        }

        // Verificar fecha de ingreso válida (no anterior a la fecha actual)
        $fechaIngreso = $_POST['fecha_ingreso'];
        $fechaActual = date('Y-m-d');
        if ($fechaIngreso < $fechaActual) {
            echo '<script>swal.fire("Error", "Seleccione una fecha de ingreso válida", "error");</script>';
            exit;
        }

        // Insercion de datos en la tabla datos_residente
        $consultaDatosResidente = "INSERT INTO datos_residente (nombre, apellido, dpi, placa_vehiculo, descripcion, telefono, correo) VALUES ('$nombre', '$apellido', '$dpi', '$placa', '$descripcion', '$telefono', '$correo')";
        $execConsultaDatosResidente = mysqli_query($conn, $consultaDatosResidente);

        if (!$execConsultaDatosResidente) {
            echo '<script>swal.fire("Error", "Error al ingresar los datos del residente", "error");</script>';
        } else {
            // Obtener el ID del residente insertado
            $idResidente = mysqli_insert_id($conn);

            $codigoResidente = $_POST['id_residente'];
            $nombreResidente = $_POST['nombre'];
            $numeroCasa = $_POST['numero_casa'];
            $motivoVisita = $_POST['motivo_visita'];

            // Verificar campos vacíos del residente
            if (empty($codigoResidente) || empty($nombreResidente) || empty($numeroCasa) || empty($motivoVisita)) {
                echo '<script>swal.fire("Error", "Por favor complete todos los campos del residente", "error");</script>';
                exit;
            }

            // Insertar datos en la tabla detalle_visita
            $consultaDetalleVisita = "INSERT INTO detalle_visita (codigo_residente, nombre_residente, fecha_ingreso, numero_casa, motivo_visita) VALUES ('$codigoResidente', '$nombreResidente', '$fechaIngreso', '$numeroCasa', '$motivoVisita')";
            $execConsultaDetalleVisita = mysqli_query($conn, $consultaDetalleVisita);

            if (!$execConsultaDetalleVisita) {
                echo '<script>swal.fire("Error", "Error al ingresar los detalles de la visita", "error");</script>';
            } else {
                echo '<script>swal.fire("Éxito", "Usuario ingresado con éxito", "success").then(() => {
                    window.location.href = "../paginas/visitas.html";
                        });</script>';
            }
        }
    }
    ?>
</body>
</html>
