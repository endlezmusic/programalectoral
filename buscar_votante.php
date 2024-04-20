<?php
// Conectarse a la base de datos (asegúrate de tener las credenciales y la conexión establecida)

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Utilizar sentencias preparadas para evitar inyecciones SQL
    $sql = "SELECT * FROM votantes WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    // Manejar errores
    if (!$result) {
        // Devolver mensaje de error en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error en la consulta SQL']);
        exit;
    }

    $votante = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Agregar los datos del votante a un array
            $votante[] = $row;
        }
    }

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($votante);
}
?>
