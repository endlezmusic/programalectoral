<?php
// Asegúrate de tener la lógica para la conexión a tu base de datos en el archivo 'conexion.php'
include 'conexion.php';

// Verifica si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $coordinador = $_POST['coordinador'];

    // Prepara la consulta SQL para insertar un nuevo votante
    $sql = "INSERT INTO votantes (cedula, nombre, coordinador) VALUES ('$cedula', '$nombre', '$coordinador')";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Votante agregado exitosamente";
    } else {
        echo "Error al agregar votante: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
