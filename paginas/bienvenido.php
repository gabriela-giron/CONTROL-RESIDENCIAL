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
    <h1>Bienvenido, <?php echo $nombre; ?>!</h1>
    <p>codigo: <?php echo $codigo; ?></p>
    <p>Nombre: <?php echo $nombre . ' ' . $apellido; ?></p>
    <p>Apellido: <?php echo $apellido; ?></p>
    <p>Número de Casa: <?php echo $numeroCasa; ?></p>
    <p>Correo Electronico: <?php echo $correo; ?></p>
    <p>Teléfono: <?php echo $telefono; ?></p>
   
</body>
</html>
