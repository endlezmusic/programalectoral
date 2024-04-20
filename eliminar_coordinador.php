<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Recibiendo la cédula del coordinador a eliminar desde la solicitud
    $coordinador_cedula = $_GET['cedula'];

    // Consulta para eliminar al coordinador por su cédula
    $sql = "DELETE FROM coordinadores WHERE cedula = '$coordinador_cedula'";

    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // Indica éxito en la eliminación
        echo json_encode(array("message" => "Coordinador eliminado exitosamente"));
    } else {
        http_response_code(500); // Indica un error interno del servidor
        echo json_encode(array("message" => "Error al intentar eliminar el coordinador"));
    }
} else {
    http_response_code(400); // Indica solicitud incorrecta
    echo json_encode(array("message" => "Método de solicitud no válido"));
}

$conn->close();
?>
