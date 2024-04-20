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
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
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

<div class="modal-background" id="modal" onclick="closeModal()">
    <div class="container" onclick="event.stopPropagation()">
        <h2>Agregar Coordinador</h2>

        <form action="agregar_coordinador.php" method="post">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula">

            <!-- Resto de campos del formulario -->

            <input type="submit" value="Agregar Coordinador">
        </form>

        <button class="close" onclick="closeModal()">Cerrar</button>
    </div>
</div>

<script>
    var modal = document.getElementById('modal');

    function closeModal() {
        modal.style.display = 'none';
    }

    // Cierra automáticamente después de agregar un coordinador
    setTimeout(function() {
        closeModal();
    }, 3000); // Cambiar este valor al tiempo que desees
</script>

</body>
</html>
