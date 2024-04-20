<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

  

// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar que se hayan recibido los datos necesarios
    if (isset($data['cedula'], $data['afiliacion'], $data['nombre'], $data['colegio'], $data['ruta_imagen'], $data['telefono'])) {
        // Sanitizar y escapar los datos recibidos
        $cedula = $conn->real_escape_string($data['cedula']);
        $afiliacion = $conn->real_escape_string($data['afiliacion']);
        $nombre = $conn->real_escape_string($data['nombre']);
        $colegio = $conn->real_escape_string($data['colegio']);
        $ruta_imagen = $conn->real_escape_string($data['ruta_imagen']);
        $telefono = $conn->real_escape_string($data['telefono']);

        // Actualizar la información en la base de datos
        $sql = "UPDATE Padron SET afiliacion = '$afiliacion', nombre = '$nombre', colegio = '$colegio', ruta_imagen = '$ruta_imagen', telefono = '$telefono' WHERE cedula = '$cedula'";

        if ($conn->query($sql)) {
            // La actualización fue exitosa
            $response = array('success' => true, 'message' => 'Edición guardada con éxito');
            echo json_encode($response);
        } else {
            // Hubo un error en la consulta SQL
            $response = array('success' => false, 'message' => 'Error al guardar la edición: ' . $conn->error);
            echo json_encode($response);
        }
    } else {
        // Datos incompletos o incorrectos
        $response = array('success' => false, 'message' => 'Datos incompletos o incorrectos');
        echo json_encode($response);
    }
} else {
    // Método de solicitud no válido
    $response = array('success' => false, 'message' => 'Método de solicitud no válido');
    echo json_encode($response);
}

$conn->close();
?>
