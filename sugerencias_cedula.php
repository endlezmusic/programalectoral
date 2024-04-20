<?php
// Archivo sugerencias_cedula.php

// Conecta a la base de datos (utiliza tus propias credenciales)
$servername = 'db5014880599.hosting-data.io';
$username = 'dbu4435745';
$password = 'EjQdlc16051996.';
$database = 'dbs12360921';

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Obtiene el valor de la cédula desde la solicitud GET
$cedula = $_GET['cedula'];

// Realiza una consulta SQL para obtener sugerencias basadas en la cédula
$sql = "SELECT nombre, afiliacion, colegio, telefono FROM Padron WHERE cedula LIKE '$cedula%'";
$result = $conn->query($sql);

// Almacena los resultados en un array
$sugerencias = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sugerencias[] = $row;
    }
}

// Devuelve las sugerencias como JSON
echo json_encode($sugerencias);

// Cierra la conexión a la base de datos
$conn->close();
?>
