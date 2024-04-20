<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Colegio Electoral</title>
</head>
<body>

<h2>Agregar Colegio Electoral</h2>

<form action="procesar_agregar_colegio.php" method="post">
  <label for="provincia">Provincia:</label><br>
  <input type="text" id="provincia" name="provincia"><br>

  <label for="municipio">Municipio:</label><br>
  <input type="text" id="municipio" name="municipio"><br>

  <label for="distrito_municipal">Distrito Municipal:</label><br>
  <input type="text" id="distrito_municipal" name="distrito_municipal"><br>

  <label for="recinto">Recinto:</label><br>
  <input type="text" id="recinto" name="recinto"><br>

  <label for="direccion_recinto">Dirección del Recinto:</label><br>
  <input type="text" id="direccion_recinto" name="direccion_recinto"><br>

  <label for="sector">Sector:</label><br>
  <input type="text" id="sector" name="sector"><br>

  <label for="mesa">Mesa:</label><br>
  <input type="text" id="mesa" name="mesa"><br>

  <label for="colegios_fusionados">Colegios Fusionados:</label><br>
  <input type="text" id="colegios_fusionados" name="colegios_fusionados"><br><br>

  <input type="submit" value="Agregar Colegio Electoral">
</form>

</body>
</html>
