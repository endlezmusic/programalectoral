<?php
include 'conexion.php'; // Asegúrate de tener la conexión a la base de datos aquí

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Consulta SQL para verificar si la cédula existe en la base de datos
    $sql = "SELECT COUNT(*) as count FROM coordinadores WHERE cedula = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // Devolver respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['duplicate' => ($count > 0)]);
    } else {
        echo json_encode(['duplicate' => false]);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó una cédula']);
}
$conn->close();
?>
