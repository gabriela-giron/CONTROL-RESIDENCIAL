<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <meta http-equiv="refresh" content="3;url=http://localhost/CONTROL-RESIDENCIAL/paginas/bienvenido.php">
</head>
<body>

<?php
    include("conexion.php");

    $codigo_get = $_GET['codigo'];
    $id_detalle_visita_get = $_GET['id_detalle_visita'];

   
        $consulta3 = "UPDATE DETALLE_VISITA SET ID_STATUS = 2 WHERE ID_RESIDENTE = '$codigo_get' AND ID_DETALLE_VISITA = '$id_detalle_visita_get';";
        $exec_consulta_3 = mysqli_query($conn, $consulta3);

        if (!$exec_consulta_3) {
            echo '<script>swal.fire("Error", "Error al realizar los cambios", "error").then(() => {
                window.location.href = "../paginas/bienvenido.php";
            });</script>';
        } else {
            echo '<script>swal.fire("Éxito", "Se ha aceptado la visita", "success").then(() => {
                window.location.href = "../paginas/bienvenido.php";
            });</script>';
        }


?>

</body>
</html>




