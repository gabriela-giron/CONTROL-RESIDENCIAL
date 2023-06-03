<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <meta http-equiv="refresh" content="3;url=http://localhost/CONTROL-RESIDENCIAL/paginas/bienvenido.php">
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php
include("conexion.php");
//use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

//use PHPMailer\PHPMailer\PHPMailer;

$codigo_get = $_GET['codigo'];
$id_detalle_visita_get = $_GET['id_detalle_visita'];

$consulta3 = "UPDATE DETALLE_VISITA SET ID_STATUS = 1 WHERE ID_RESIDENTE = '$codigo_get' AND ID_DETALLE_VISITA = '$id_detalle_visita_get';";
$exec_consulta_3 = mysqli_query($conn, $consulta3);

if (!$exec_consulta_3) {
    echo '<script>swal.fire("Error", "Error al realizar los cambios", "error").then(() => {
        window.location.href = "../paginas/bienvenido.php";
    });</script>';
} else {
    
    echo '<script>swal.fire("Éxito", "Se ha aceptado la visita", "success").then(() => {
        window.location.href = "../paginas/bienvenido.php";
    });</script>';

    /*$consulta4 = "SELECT * FROM DETALLE_VISITA WHERE ID_DETALLE_VISITA = '$id_detalle_visita_get';";
    $exec_consulta_4 = mysqli_query($conn, $consulta4);
    $fila = mysqli_fetch_assoc($exec_consulta_4);

    $id_visitante = $fila['ID_VISITANTE'];

    $consulta5 = "SELECT * FROM DATOS_VISITANTE WHERE ID_VISITANTE = '$id_visitante';";
    $exec_consulta_5 = mysqli_query($conn, $consulta5);
    $fila = mysqli_fetch_assoc($exec_consulta_5);

    $correo = $fila['CORREO'];

    // Configura el objeto PHPMailer
    $mailer = new PHPMailer();
    $mailer->isSMTP();
    $mailer->Host = 'sandbox.smtp.mailtrap.io';
    $mailer->SMTPAuth = true;
    $mailer->Port = 2525;
    $mailer->Username = '931380dfc9a3c5';
    $mailer->Password = 'db53647d2f2921';

    // Configura el mensaje del correo electrónico
    $mailer->setFrom('prueba1@hotmail.com', 'keren');
    $mailer->addAddress($correo);
    $mailer->Subject = 'prueba keren';
    $mailer->Body = 'prueba keren';

    // Envía el correo electrónico
    if ($mailer->send()) {
        echo "Correo enviado correctamente";
    } else {
        echo "Error al enviar el correo: " . $mailer->ErrorInfo;
    }*/
}
?>
</body>
</html>
