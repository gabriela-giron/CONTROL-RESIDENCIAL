<html>
<head> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <meta http-equiv="refresh" content="5;url=http://localhost/CONTROL-RESIDENCIAL/paginas/visitas.html">
</head>
<body>
    <?php
    include("conexion.php");

    if (isset($_POST['btn-ingresar'])) {
        $nombre = $_POST['Nombre(s)'];
        $apellido = $_POST['Apellido(s)'];
        $dpi = $_POST['DPI'];
        $placa_vehiculo = $_POST['placa_vehiculo'];
        $descripcion_vehiculo = $_POST['descripcion_vehiculo'];
        $telefono = $_POST['Telefono'];
        $correo = $_POST['Correo'];

        // Verificar campos vacíos
        if (empty($nombre) || empty($apellido) || empty($dpi) || empty($placa_vehiculo) || empty($descripcion_vehiculo) || empty($telefono) || empty($correo) ) {
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
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_actual = date('Y-m-d');
        if ($fecha_ingreso < $fecha_actual) {
            echo '<script>swal.fire("Error", "Seleccione una fecha de ingreso válida porfavor", "error");</script>';
            exit;
        }

        // Insercion de datos en la tabla datos_visitante
        $consultadatos_visitante = "INSERT INTO datos_visitante(nombre, apellido, dpi, placa_vehiculo, descripcion_vehiculo, telefono, correo) VALUES ('$nombre', '$apellido', '$dpi', '$placa_vehiculo', '$descripcion_vehiculo', '$telefono', '$correo')";
        $execConsultadatos_visitante = mysqli_query($conn, $consultadatos_visitante);

        if (!$execConsultadatos_visitante) {
            echo '<script>swal.fire("Error", "Error al ingresar los datos del residente", "error");</script>';
        } else {
            
            $id_residente = $_POST['id_residente'];
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $direccion = $_POST['direccion'];
            $motivo_visita = $_POST['motivo_visita'];

            // Verificar campos vacíos visitante
            if (empty($id_residente) || empty($fecha_ingreso) || empty($direccion) || empty($motivo_visita)) {
                echo '<script>swal.fire("Error", "Por favor complete todos los campos del visitante", "error");</script>';
                exit;
            }

            // Insertar datos en la tabla detalle_visita
            $consultadetalle_visita = "INSERT INTO detalle_visita (id_residente, fecha_ingreso, direccion, motivo_visita) VALUES ('$id_residente', '$fecha_ingreso', '$direccion', '$motivo_visita')";
            $execConsultadetalle_visita = mysqli_query($conn, $consultadetalle_visita);

            if (!$execConsultadetalle_visita) {
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
