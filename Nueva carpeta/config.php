// Crear un archivo de configuración externo (config.php)
<?php
define('DB_HOST', 'db5014880599.hosting-data.io');
define('DB_NAME', 'dbs12360921');
define('DB_USER', 'dbu4435745');
define('DB_PASSWORD', '<EjQdlc16051996.>');
?>

// En tu archivo principal
<?php
include 'config.php';

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Resto del código...
?>
