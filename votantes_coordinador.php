<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $coordinador_id = $_GET['id'];

    // Consulta para obtener los votantes del coordinador específico
    $sql = "SELECT * FROM votantes WHERE coordinador_id = $coordinador_id";
    $result = $conn->query($sql);

    // Mostrar los votantes en una tabla, por ejemplo
    if ($result->num_rows > 0) {
        echo "<h2>Votantes del Coordinador</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <!-- Otros campos -->
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["apellido"] . "</td>
                    <!-- Otros campos -->
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Este coordinador no tiene votantes registrados.";
    }
} else {
    echo "ID del coordinador no proporcionado";
}

$conn->close();
?>
