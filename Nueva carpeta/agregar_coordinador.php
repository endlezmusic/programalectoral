<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Coordinador</title>
    <style>
        /* Estilos para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.6);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        
        .container {
            width: 40%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow-y: auto;
            height: 60%; /* Definir una altura fija */
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        label {
            margin-bottom: 5px;
        }
        
        input[type="text"] {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        input[type="submit"] {
            width: 50%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
        button.close {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px;
            background-color: #ccc;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        button.close:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>

<div class="modal-background" id="modal" onclick="closeModal(event)">
    <div class="container">
        <h2>Agregar Coordinador</h2>

        <form action="agregar_coordinador.php" method="post">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" onblur="checkDuplicateCedula(this.value)">
            <span id="cedulaError" style="color: red;"></span>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido">

            <label for="zona">Zona:</label>
            <input type="text" id="zona" name="zona">

            <label for="colegio">Colegio:</label>
            <input type="text" id="colegio" name="colegio">

            <label for="apodo">Apodo:</label>
            <input type="text" id="apodo" name="apodo">

            <input type="submit" value="Agregar Coordinador">
        </form>

        <button class="close" onclick="closeModal(event)">Cerrar</button>
    </div>
</div>

<script>
    var modal = document.getElementById('modal');

    function closeModal(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    function checkDuplicateCedula(cedula) {
        fetch(`verificar_cedula.php?cedula=${cedula}`)
            .then(response => response.json())
            .then(data => {
                const cedulaError = document.getElementById('cedulaError');
                if (data.duplicate) {
                    cedulaError.innerText = 'La cédula ya existe';
                } else {
                    cedulaError.innerText = '';
                }
            })
            .catch(error => console.error('Error al verificar la cédula:', error));
    }

    function reloadAfterAddCoordinator() {
        closeModal({ target: modal });
        setTimeout(function() {
            window.location.href = window.location.href;
        }, 1000);
    }
</script>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $zona = $_POST['zona'];
    $colegio = $_POST['colegio'];
    $apodo = $_POST['apodo'];

    $sql = "INSERT INTO coordinadores (cedula, nombre, apellido, zona, colegio, apodo) 
            VALUES ('$cedula', '$nombre', '$apellido', '$zona', '$colegio', '$apodo')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Coordinador registrado correctamente";
        echo '<script>reloadAfterAddCoordinator();</script>';
        exit();
    } else {
        echo "Error al agregar el coordinador: " . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>
