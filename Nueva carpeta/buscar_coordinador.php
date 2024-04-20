<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los parámetros de búsqueda del GET
$nombre = $_GET['nombre'] ?? '';
$apellido = $_GET['apellido'] ?? '';
$cedula = $_GET['cedula'] ?? '';

// Consulta SQL para buscar coordinadores según los parámetros
$sql = "SELECT * FROM coordinadores WHERE nombre LIKE '%$nombre%' AND apellido LIKE '%$apellido%' AND cedula LIKE '%$cedula%'";

$resultado = $conn->query($sql);

if ($resultado) {
    $coordinadores = [];
    while ($row = $resultado->fetch_assoc()) {
        // Construir un array con los datos de los coordinadores encontrados
        $coordinadores[] = [
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'cedula' => $row['cedula']
            // Agrega más campos si es necesario
        ];
    }
    // Devolver los datos en formato JSON
    echo json_encode($coordinadores);
} else {
    // Manejar errores
    echo json_encode(['error' => 'Error al buscar coordinadores']);
}

// Cerrar la conexión a la base de datos al finalizar
$conn->close();
?>
