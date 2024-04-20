<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $comunidad = $_POST['comunidad'];
    $colegio = $_POST['colegio'];
    $apodo = $_POST['apodo'];

    // Consulta SQL para actualizar la información del coordinador
    $sql = "UPDATE coordinadores SET cedula='$cedula', nombre='$nombre', comunidad='$comunidad', colegio='$colegio', apodo='$apodo'";

    if ($conn->query($sql) === TRUE) {
        echo "Información del coordinador actualizada exitosamente";
        // Redireccionar a la lista de coordinadores después de actualizar
        header("Location: lista_coordinadores.php");
        exit();
    } else {
        echo "Error al actualizar la información del coordinador: " . $conn->error;
    }
} else {
    echo "No se han recibido datos para actualizar";
}

$conn->close();
?>
