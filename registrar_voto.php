<?php
header('Content-Type: application/json'); // Asegúrate de que esta línea esté al principio
include 'conexion.php';

if (isset($_POST['cedula']) && isset($_POST['colegio'])) {
    $cedula = $_POST['cedula'];
    $colegio = $_POST['colegio'];

    // Consulta SQL para actualizar la columna votos_emitidos en la tabla RecuentoVoto
    $sql = "UPDATE RecuentoVoto SET votos_emitidos = votos_emitidos + 1 WHERE colegio = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $colegio);

        if ($stmt->execute()) {
            echo json_encode(array('success' => 'Voto registrado con éxito.'));
        } else {
            echo json_encode(array('error' => 'Error al registrar el voto.'));
        }

        $stmt->close();
    } else {
        echo json_encode(array('error' => 'Error al preparar la consulta.'));
    }
} else {
    echo json_encode(array('error' => 'Datos incompletos.'));
}

$conn->close();
?>
