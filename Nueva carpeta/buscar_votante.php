<?php
// Conectarse a la base de datos (asegúrate de tener las credenciales y la conexión establecida)

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Realizar la consulta SQL para buscar el votante por cédula
    $sql = "SELECT * FROM votantes WHERE cedula = '$cedula'";
    $result = $conn->query($sql);

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
