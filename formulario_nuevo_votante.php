<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Nuevo Votante</title>
</head>
<body>

<h2>Formulario de Nuevo Votante</h2>

<form action="procesar_nuevo_votante.php" method="post">
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre"><br>

  <label for="municipio">Municipio:</label>
  <input type="text" id="municipio" name="municipio"><br>

  <!-- Otros campos del votante -->

  <input type="submit" value="Agregar Votante">
  <label for="coordinador">Coordinador:</label>
<select id="coordinador" name="coordinador">
    <?php
    // Aquí se obtienen los coordinadores de la base de datos y se muestran como opciones
    // Puedes utilizar una consulta SQL para obtener los coordinadores
    $sql_coordinadores = "SELECT id, nombre FROM coordinadores";
    $result_coordinadores = $conn->query($sql_coordinadores);

    if ($result_coordinadores->num_rows > 0) {
        while ($row_coordinador = $result_coordinadores->fetch_assoc()) {
            echo "<option value='" . $row_coordinador["id"] . "'>" . $row_coordinador["nombre"] . "</option>";
        }
    }
    ?>
</select>

</form>

</body>
</html>
