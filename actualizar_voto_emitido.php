<?php
$servername = 'db5014880599.hosting-data.io';
$username = 'dbu4435745';
$password = 'EjQdlc16051996.';
$database = 'dbs12360921';

try {
    // Crear conexión usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Configurar PDO para lanzar excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cedula']) && !empty(trim($_POST['cedula']))) {
        $cedula = trim($_POST['cedula']);

        // Aquí puedes agregar más validación para el formato de la cédula si es necesario
        if (!preg_match('/^\d{3}-\d{7}-\d{1}$/', $cedula)) {
            throw new Exception('Formato de cédula inválido.');
        }

        // Iniciar transacción
        $conn->beginTransaction();

        if (!cedulaExiste($cedula, $conn)) {
            throw new Exception('Cédula no encontrada en el padrón.');
        }

        if (!marcarVotoEmitido($cedula, $conn)) {
            throw new Exception('Error al registrar el voto.');
        }

        if (!actualizarRecuentoVotos($conn)) {
            throw new Exception('Error al actualizar el recuento de votos.');
        }

        // Si todo fue exitoso, hacer commit de la transacción
        $conn->commit();
        http_response_code(200); // OK
        echo json_encode(['message' => 'Voto registrado y recuento actualizado exitosamente.']);
    } else {
        throw new Exception('No se proporcionó la cédula o es inválida.');
    }
} catch (Exception $e) {
    // En caso de error, revertir la transacción
    if ($conn->inTransaction()) {
        $conn->rollback();
    }
    http_response_code(400); // Bad Request o Internal Server Error dependiendo del error
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Cierra la conexión
    $conn = null;
}

function cedulaExiste($cedula, $conn) {
    $sql = "SELECT COUNT(*) AS existe FROM Padron WHERE cedula = :cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['existe'] == 1;
}

function marcarVotoEmitido($cedula, $conn) {
    $sql = "UPDATE Padron SET estado = 1 WHERE cedula = :cedula";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function actualizarRecuentoVotos($conn) {
    $sql = "UPDATE RecuentoVotos SET votos_emitidos = votos_emitidos + 1 WHERE id_eleccion = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
?>
