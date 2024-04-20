<?php
include 'conexion.php'; // Asegúrate de tener la conexión a la base de datos aquí

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Realiza la consulta para obtener los datos del votante por su cédula
    $sql = "SELECT * FROM votantes WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Devuelve los datos del votante en formato JSON
        echo json_encode($row);
    } else {
        echo json_encode([]); // Devuelve un objeto vacío si no se encuentra el votante
    }

    $stmt->close();
    $conn->close();
}
?>
