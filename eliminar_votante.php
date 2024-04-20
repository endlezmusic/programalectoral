<?php
// Asegúrate de tener la lógica para la conexión a tu base de datos en el archivo 'conexion.php'
include 'conexion.php';

// Verifica si se recibió la solicitud para eliminar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
    // Obtén la cédula del votante a eliminar
    $cedula = $_GET["eliminar"];

    // Prepara la consulta SQL para eliminar el votante
    $sql = "DELETE FROM votantes WHERE cedula = ?";

    // Prepara la sentencia
    $stmt = $conn->prepare($sql);

    // Vincula el parámetro
    $stmt->bind_param("s", $cedula);

    // Ejecuta la sentencia
    if ($stmt->execute()) {
        echo "Votante eliminado exitosamente";
    } else {
        echo "Error al eliminar votante: " . $stmt->error;
    }

    // Cierra la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    echo "Solicitud no válida para eliminar votante";
}
?>
