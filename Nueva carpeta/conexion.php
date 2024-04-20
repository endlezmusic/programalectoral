<?php
$servername = 'db5014880599.hosting-data.io';
$username = 'dbu4435745';
$password = 'EjQdlc16051996.';
$database = 'dbs12360921';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
