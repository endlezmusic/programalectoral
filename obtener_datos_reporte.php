<?php
include 'conexion.php';

// Seleccionar la base de datos
mysqli_select_db($conn, 'dbs12360921');

// Verificar la conexión a la base de datos
if (!$conn) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Error de conexión a la base de datos: ' . mysqli_connect_error()));
    exit();
}

// Funciones para obtener los datos de la base de datos
function obtenerCantidadVotantesRegistrados($conexion) {
    $query = "SELECT COUNT(*) AS total_votantes FROM votantes";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_votantes'];
    } else {
        throw new Exception("Error al obtener la cantidad de votantes registrados");
    }
}

function obtenerCantidadCoordinadores($conexion) {
    $query = "SELECT COUNT(*) AS total_coordinadores FROM coordinadores";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_coordinadores'];
    } else {
        throw new Exception("Error al obtener la cantidad de coordinadores");
    }
}

function obtenerCantidadVotosEmitidos($conexion) {
    $query = "SELECT COUNT(*) AS votos_emitidos FROM votos WHERE estado = 'Emitido'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['votos_emitidos'];
    } else {
        throw new Exception("Error al obtener la cantidad de votos emitidos");
    }
}


function obtenerCantidadVotosNoEmitidos($conexion) {
    // Primero, obtenemos el total de votantes en el padrón
    $totalVotantesQuery = "SELECT COUNT(*) AS total_votantes FROM Padron";
    $totalVotantesResult = mysqli_query($conexion, $totalVotantesQuery);
    if ($totalVotantesResult) {
        $totalVotantesRow = mysqli_fetch_assoc($totalVotantesResult);
        $totalVotantes = $totalVotantesRow['total_votantes'];
    } else {
        throw new Exception("Error al obtener el total de votantes del padrón");
    }

    // Luego, obtenemos el número de votos emitidos
    $votosEmitidosQuery = "SELECT COUNT(*) AS votos_emitidos FROM votos WHERE estado = 'Emitido'";
    $votosEmitidosResult = mysqli_query($conexion, $votosEmitidosQuery);
    if ($votosEmitidosResult) {
        $votosEmitidosRow = mysqli_fetch_assoc($votosEmitidosResult);
        $votosEmitidos = $votosEmitidosRow['votos_emitidos'];
    } else {
        throw new Exception("Error al obtener la cantidad de votos emitidos");
    }

    // Calculamos los votos no emitidos restando los votos emitidos del total de votantes
    $votosNoEmitidos = $totalVotantes - $votosEmitidos;

    return $votosNoEmitidos;
}


function obtenerUniversoVotantes($conexion) {
    $query = "SELECT COUNT(*) AS universo_votantes FROM Padron";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['universo_votantes'];
    } else {
        throw new Exception("Error al obtener el universo de votantes");
    }
}

// Manejar las solicitudes GET para obtener los datos
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $datos = array(
            "votantesRegistrados" => obtenerCantidadVotantesRegistrados($conn),
            "cantidadCoordinadores" => obtenerCantidadCoordinadores($conn),
            "personasQueVotaron" => obtenerCantidadVotosEmitidos($conn),
            "personasFaltanVotar" => obtenerCantidadVotosNoEmitidos($conn),
            "universoVotantes" => obtenerUniversoVotantes($conn)
        );

        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($datos);
    } catch (Exception $e) {
        // Manejar cualquier excepción
        header('Content-Type: application/json');
        echo json_encode(array('error' => $e->getMessage()));
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
