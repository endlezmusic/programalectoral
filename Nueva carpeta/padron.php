<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Votantes</title>
</head>
<body>
    <h1>Lista de Votantes</h1>

    <section>
        <h2>Agregar Votante</h2>
        <!-- Formulario para agregar un votante -->
        <form action="procesar_agregar.php" method="post">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido">
            <label for="coordinador">Coordinador:</label>
            <input type="text" id="coordinador" name="coordinador">
            <label for="apodo">Apodo:</label>
            <input type="text" id="apodo" name="apodo">
            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" name="municipio">
            <label for="colegio_electoral">Colegio Electoral:</label>
            <input type="text" id="colegio_electoral" name="colegio_electoral">
            <input type="submit" value="Agregar Votante">
        </form>
    </section>

    <section>
        <h2>Votantes</h2>
        <?php
        include 'conexion.php'; // Asegúrate de tener la conexión a la base de datos aquí

        $sql = "SELECT * FROM votantes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>
            <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Coordinador</th>
            <th>Apodo</th>
            <th>Municipio</th>
            <th>Colegio Electoral</th>
            <th>Acciones</th>
            </tr>";
            while ($row_votante = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_votante["cedula"] . "</td>";
                echo "<td>" . $row_votante["nombre"] . "</td>";
                echo "<td>" . $row_votante["apellido"] . "</td>";
                echo "<td>" . $row_votante["coordinador"] . "</td>";
                echo "<td>" . (isset($row_votante["apodo"]) ? $row_votante["apodo"] : '') . "</td>"; // Verifica si existe el campo "apodo"
                echo "<td>" . $row_votante["municipio"] . "</td>";
                echo "<td>" . $row_votante["colegio_electoral"] . "</td>";
                echo "<td>";
                echo "<button onclick=\"eliminarVotante('" . $row_votante['cedula'] . "');\">Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay votantes en la lista.";
        }

        $conn->close(); // Cierra la conexión a la base de datos al finalizar
        ?>
    </section>



    <!-- Resto del código... -->

    <script>
        function eliminarVotante(cedula) {
            // Lógica para eliminar un votante con la cédula proporcionada
            // Se puede hacer una solicitud a un archivo PHP mediante AJAX para manejar la eliminación

            // Por ejemplo, utilizando fetch() o XMLHttpRequest
            fetch(`eliminar_votante.php?eliminar=${cedula}`)
                .then(response => response.text())
                .then(data => {
                    // Manejar la respuesta después de eliminar el votante
                    console.log(data); // Puedes mostrar un mensaje de éxito o recargar la lista de votantes
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }
    </script>
</body>
</html>
