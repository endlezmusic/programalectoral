<?php
// Establecer conexión con la base de datos
$servername = "db5014880599.hosting-data.io";
$username = "dbu4435745";
$password = "EjQdlc16051996.";
$dbname = "dbs12360921";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$provincia = $_POST['provincia'];
$municipio = $_POST['municipio'];
$distrito_municipal = $_POST['distrito_municipal'];
$recinto = $_POST['recinto'];
$direccion_recinto = $_POST['direccion_recinto'];
$sector = $_POST['sector'];
$mesa = $_POST['mesa'];
$colegios_fusionados = $_POST['colegios_fusionados'];

// Consulta SQL para insertar los datos en la base de datos sin incluir la columna id
$sql = "INSERT INTO colegios_electorales (provincia, municipio, distrito_municipal, recinto, direccion_recinto, sector, mesa, colegios_fusionados) 
        VALUES ('$provincia', '$municipio', '$distrito_municipal', '$recinto', '$direccion_recinto', '$sector', '$mesa', '$colegios_fusionados')";

if ($conn->query($sql) === TRUE) {
    echo "Colegio electoral agregado correctamente";
} else {
    echo "Error al agregar colegio electoral: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
