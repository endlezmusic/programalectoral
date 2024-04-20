<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Colegios Electorales</title>
</head>
<body>

<h2>Lista de Colegios Electorales</h2>

<table border="1">
  

</table>


<form action="agregar_colegio.php" method="get">
  <button type="submit">Agregar Colegio Electoral</button>
</form>

<tr>
    <th>Identificador</th>
    <th>Nombre</th>
    <th>Acciones</th>
  </tr>

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

  // Consulta SQL para obtener los colegios electorales
  $sql = "SELECT identificador, nombre FROM colegios_electorales";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Mostrar los datos de los colegios electorales en la tabla
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["identificador"] . "</td>";
      echo "<td>" . $row["nombre"] . "</td>";
      echo "<td>";
      echo "<form action='editar_colegio.php' method='get'>";
      echo "<input type='hidden' name='id' value='" . $row["identificador"] . "'>";
      echo "<button type='submit'>Editar</button>";
      echo "</form>";
      echo "<form action='borrar_colegio.php' method='get'>";
      echo "<input type='hidden' name='id' value='" . $row["identificador"] . "'>";
      echo "<button type='submit'>Borrar</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='3'>No se encontraron colegios electorales</td></tr>";
  }

  // Cerrar la conexión
  $conn->close();
  ?>

</body>
</html>
