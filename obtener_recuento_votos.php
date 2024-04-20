<?php
// Asegúrate de incluir tu script de conexión a la base de datos antes de este bloque de código.
include 'conexion.php';

// Establece el encabezado de tipo de contenido a JSON
header('Content-Type: application/json');

try {
    // Consulta SQL para obtener el recuento de votos emitidos
    $sql = "SELECT COUNT(*) as votos_emitidos FROM RecuentoVotos WHERE voto_emitido = 1";
    $resultado = $conn->query($sql);

    if ($resultado) {
        // Obtiene el resultado de la consulta
        $fila = $resultado->fetch_assoc();
        $votosEmitidos = $fila['votos_emitidos'];

        // Utiliza JSON_UNESCAPED_UNICODE para mantener caracteres Unicode
        echo json_encode(['votos_emitidos' => $votosEmitidos], JSON_UNESCAPED_UNICODE);
    } else {
        // Lanza una excepción si la consulta falla
        throw new Exception('Error al ejecutar la consulta en la base de datos.');
    }
} catch (Exception $e) {
    // Captura cualquier excepción y devuelve un mensaje de error
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
} finally {
    // Asegúrate de cerrar la conexión a la base de datos
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
