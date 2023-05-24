<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
</head>
<body>

<?php
include("conexion.php");

if (isset($_POST['btn-ingresar'])) {
    $correo = $_POST['Correo'];
    $contrasenaIngresada = $_POST['Contraseña'];
    $contrasenaEncriptada = sha1($contrasenaIngresada);

    // Verificar si el usuario existe en la base de datos
    $consulta = "SELECT contrasenia FROM residente WHERE CORREO = '$correo'";
    $resultado = mysqli_query($conn, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
    $contrasenaAlmacenada = $fila['contrasenia'];

    if ($contrasenaEncriptada == $contrasenaAlmacenada) {
        // Contraseña correcta, permitir acceso a la página siguiente
        session_start();
        $_SESSION['correo'] = $correo;
        header("Location: bienvenido.php"); // Redirigir a la página de bienvenida
        exit; // Importante: asegúrate de agregar exit para detener la ejecución del script después de la redirección
    } else {
        // Contraseña incorrecta, mostrar mensaje de error
        // Puedes utilizar SweetAlert2 para mostrar un mensaje emergente
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Contraseña incorrecta',
            text: 'La contraseña ingresada es incorrecta',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            setTimeout(() => {
                window.location.href = 'residentes-login.html';
            }, 1500); // Redirigir después de 1.5 segundos 
        });
    </script>";

	
    }
}
?>

</body>
</html>
