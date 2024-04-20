<?php
include 'conexion.php'; // Asegúrate de tener la conexión a la base de datos aquí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha enviado información por POST

    // Validación de datos - Ejemplo: verifica si el campo 'nombre' no está vacío
    if (!empty($_POST['nombre'])) {
        // Obtén los valores del formulario y sanitízalos si es necesario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $apodo = $_POST['apodo'];
        $coordinador = $_POST['coordinador'];
        $municipio = $_POST['municipio'];
        $colegioElectoral = $_POST['colegio_electoral'];
        // Otros campos del formulario

        // Consulta SQL preparada para insertar datos de forma segura
        $sql = "INSERT INTO votantes (nombre, apellido, apodo, coordinador, municipio, colegio_electoral /*, otros campos...*/) 
                VALUES (?, ?, ?, ?, ?, ? /*, otros valores...*/)";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("ssssss" /*, otros tipos...*/, $nombre, $apellido, $apodo, $coordinador, $municipio, $colegioElectoral /*, otros valores...*/);

        if ($stmt->execute()) {
            // Éxito al insertar los datos en la base de datos
            $stmt->close(); // Cerrar la declaración
            $conn->close(); // Cerrar la conexión

            // Redirección después del envío del formulario
            header("Location: index.html");
            exit(); // Termina el script después de la redirección
        } else {
            // Error al insertar datos
            echo "Error al insertar datos: " . $conn->error;
        }
    } else {
        echo "El campo 'nombre' está vacío"; // Mensaje de error si el campo 'nombre' está vacío
    }
} else {
    // Si no hay datos enviados por POST, maneja esta situación
    echo "No se han recibido datos del formulario";
}
?>
