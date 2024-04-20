<?php
$servername = "db5014880599.hosting-data.io"; // o la IP del servidor de bases de datos
$username = "dbu4435745";
$password = "EjQdlc16051996";
$dbname = "dbs12360921";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recuperar datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$responsable = $_POST['responsable'];
$afiliacion = $_POST['afiliacion'];
$apodo = $_POST['apodo'];
$colegio = $_POST['colegio'];
$recinto = $_POST['recinto'];
$municipio = $_POST['municipio'];
$distrito = $_POST['distrito'];
$telefono = $_POST['telefono'];

// Preparar y vincular
$stmt = $conn->prepare("INSERT INTO votantes (cedula, nombre, responsable, afiliacion, apodo, colegio, recinto, municipio, distrito, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $cedula, $nombre, $responsable, $afiliacion, $apodo, $colegio, $recinto, $municipio, $distrito, $telefono);

// Ejecutar
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar datos: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
