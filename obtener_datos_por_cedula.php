<?php
header('Content-Type: application/json');

$servername = 'db5014880599.hosting-data.io';
$username = 'dbu4435745';
$password = 'EjQdlc16051996';
$database = 'dbs12360921';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $conn->connect_error]);
    exit;
}

if (!isset($_GET['cedula'])) {
    echo json_encode(['error' => 'No se proporcionó la cédula.']);
    exit;
}

$cedula = validarCedula($_GET['cedula']);
if (!$cedula) {
    echo json_encode(['error' => 'Formato de cédula no válido.']);
    exit;
}

$sql = "SELECT nombre, afiliacion, colegio, telefono FROM Padron WHERE cedula = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conn->error]);
    exit;
}

$stmt->bind_param('s', $cedula);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $datos = $result->fetch_assoc();
    echo json_encode($datos);
} else {
    echo json_encode(['error' => 'No se encontraron datos para la cédula proporcionada.']);
}

$stmt->close();
$conn->close();

function validarCedula($cedula) {
    return preg_match('/^\d{3}-\d{7}-\d{1}$/', $cedula) ? $cedula : false;
}
?>
