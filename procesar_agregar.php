<?php
// Asegúrate de tener la lógica para la conexión a tu base de datos en el archivo 'conexion.php'
include 'conexion.php';

// Verifica si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $colegio = $_POST['colegio'];

    // Prepara la consulta SQL con una sentencia preparada
    $sql = "INSERT INTO votantes (cedula, nombre, colegio) VALUES (?, ?, ?)";

    // Prepara la sentencia
    $stmt = $conn->prepare($sql);

    // Vincula los parámetros
    $stmt->bind_param("sss", $cedula, $nombre, $colegio);

    // Ejecuta la sentencia
    if ($stmt->execute()) {
        echo "Votante agregado exitosamente";
    } else {
        echo "Error al agregar votante: " . $stmt->error;
    }

    // Cierra la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
