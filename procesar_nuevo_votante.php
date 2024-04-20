<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$municipio = $_POST['municipio'];
// Otros campos del votante...

$sql = "INSERT INTO tu_tabla (nombre, municipio /*, otros campos...*/) 
        VALUES ('$nombre', '$municipio' /*, otros valores...*/)";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo votante agregado correctamente<br>";
    echo '<a href="formulario_nuevo_votante.php">Agregar otro votante</a>';
} else {
    echo "Error al agregar votante: " . $conn->error;
}

$conn->close();
?>
