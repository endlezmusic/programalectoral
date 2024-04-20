<?php
  $host_name = 'db5014880599.hosting-data.io';  // El hostname o dirección IP del servidor de la base de datos
  $database = 'dbs12360921';                    // El nombre de la base de datos
  $user_name = 'dbu4435745';                    // El usuario de la base de datos
  $password = 'EjQdlc16051996';                 // La contraseña del usuario de la base de datos
  $dbh = null;                                  // Inicializa la variable $dbh como null

  try {
    // Intenta establecer una conexión con la base de datos usando PDO
    $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
    // Configura el modo de error para que lance excepciones, facilitando la detección de errores
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // Captura cualquier excepción relacionada con la conexión de la base de datos y la imprime
    echo "Error!:" . $e->getMessage() . "<br/>";
    die();  // Termina el script si hay un error
  }
?>
