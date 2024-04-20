<?php
include 'conexion.php';

if (isset($_GET['cedula'])) {
    $coordinador_cedula = $_GET['cedula'];

    // Consulta para obtener la información del coordinador específico por cédula
    $sql = "SELECT * FROM coordinadores WHERE cedula = '$coordinador_cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Mostrar formulario para editar la información del coordinador
        $row = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Editar Coordinador</title>
            <link rel="stylesheet" href="button.css">
        </head>
        <body>
            <h2>Editar Coordinador</h2>
            <form action="actualizar_coordinador.php" method="post">
                <input type="hidden" name="cedula" value="<?php echo $row['cedula']; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
                Comunidad: <input type="text" name="comunidad" value="<?php echo $row['comunidad']; ?>"><br>
                Colegio: <input type="text" name="colegio" value="<?php echo $row['colegio']; ?>"><br>
                Apodo: <input type="text" name="apodo" value="<?php echo $row['apodo']; ?>"><br>
                <input type="submit" value="Actualizar">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "No se encontró el coordinador";
    }
} else {
    echo "Cédula del coordinador no proporcionada";
}

$conn->close();
?>
