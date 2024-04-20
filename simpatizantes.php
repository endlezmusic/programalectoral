<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $cedula = $_POST["cedula"] ?? "";
    $nombre = $_POST["nombre"] ?? "";
    $responsable = $_POST["responsable"] ?? "";
    $afiliacion = $_POST["afiliacion"] ?? "";
    $apodo = $_POST["apodo"] ?? "";
    $colegio = $_POST["colegio"] ?? "";
    $recinto = $_POST["recinto"] ?? "";
    $municipio = $_POST["municipio"] ?? "";
    $distrito = $_POST["distrito"] ?? "";
    $telefono = $_POST["telefono"] ?? "";

    // Validar los datos recibidos (puedes agregar tus propias validaciones aquí)

    // Crear la conexión a la base de datos (ajusta según tus credenciales)
    $servername = 'db5014880599.hosting-data.io';
    $username = 'dbu4435745';
    $password = 'EjQdlc16051996';
    $database = 'dbs12360921';

    // Establecer conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Aquí puedes escribir el código para guardar los datos en la base de datos
    // Ejemplo:
    $sql = "INSERT INTO Simpatizantes (cedula, nombre, responsable, afiliacion, apodo, colegio, recinto, municipio, distrito, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $cedula, $nombre, $responsable, $afiliacion, $apodo, $colegio, $recinto, $municipio, $distrito, $telefono);
    $stmt->execute();
    $stmt->close();

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Puedes redirigir al usuario a una página de éxito o mostrar un mensaje de confirmación aquí
    echo "Los datos han sido guardados correctamente.";
} else {
    // Si no se recibieron datos del formulario, redirigir al usuario a otra página o mostrar un mensaje de error
    echo "No se recibieron datos del formulario.";
}
?>
