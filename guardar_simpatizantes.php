<?php
include 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Registrar'])) {
    $cedula = $_POST['cedula'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $responsable = $_POST['responsable'] ?? '';
    $afiliacion = $_POST['afiliacion'] ?? '';
    $apodo = $_POST['apodo'] ?? '';
    $colegio = $_POST['colegio'] ?? '';
    $recinto = $_POST['recinto'] ?? '';
    $municipio = $_POST['municipio'] ?? '';
    $distrito = $_POST['distrito'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    if (empty($cedula) || empty($nombre) || empty($responsable)) {
        echo json_encode(["success" => false, "message" => "Por favor, completa todos los campos necesarios."]);
        exit;
    }

    $sql = "INSERT INTO Simpatizantes (cedula, nombre, responsable, afiliacion, apodo, colegio, recinto, municipio, distrito, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt && $stmt->execute([$cedula, $nombre, $responsable, $afiliacion, $apodo, $colegio, $recinto, $municipio, $distrito, $telefono])) {
        echo json_encode(["success" => true, "message" => "Registro guardado con éxito."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar el registro: " . ($stmt ? $stmt->errorInfo()[2] : 'Statement preparation failed')]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Solicitud no válida. Asegúrate de que el método y los datos sean correctos."]);
}
?>
