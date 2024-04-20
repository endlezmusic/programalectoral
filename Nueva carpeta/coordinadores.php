<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Coordinadores</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="button.css">
    <!-- Agrega tus estilos CSS aquí o en un archivo separado -->

    <style>
        /* Estilos para la tabla y botones */
        body {
            background-color: #035AA6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white; /* Color del texto blanco */
        }

        .table-container table {
            color: white; /* Color del texto de la tabla */
            border-collapse: collapse;
            width: 100%;
        }

        .table-container th, .table-container td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #D99441;
        }

        .actions button,
        .lateral-bottom-left button {
            background-color: #D99441;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 10px 20px;
            margin-bottom: 10px;
        }

        .actions button:hover,
        .lateral-bottom-left button:hover {
            background-color: #035AA6;
        }

        iframe {
            display: none;
            width: 100%;
            height: 500px;
            border: none;
        }
    </style>

    <script>
        // Funciones JavaScript para las acciones del usuario
        function visualizarVotosCoordinador(cedula) {
            window.location.href = `votantes_coordinador.php?cedula=${cedula}`;
        }

        function buscarCoordinador() {
            // Obtener el valor de búsqueda del formulario
            const nombreCompleto = document.getElementById('nombreCompleto').value;

            // Realizar la solicitud al servidor utilizando fetch o XMLHttpRequest
            fetch(`buscar_coordinador.php?nombreCompleto=${nombreCompleto}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al buscar coordinador');
                    }
                    return response.json();
                })
                .then(data => {
                    // Manejar los datos recibidos (por ejemplo, mostrar en una tabla HTML)
                    mostrarResultados(data);
                })
                .catch(error => {
                    // Manejar errores
                    console.error('Error en la búsqueda:', error);
                    mostrarError('Error al buscar coordinador. Inténtalo de nuevo.');
                });
        }

        function mostrarResultados(data) {
            // Lógica para mostrar los resultados en una tabla o en el formato deseado
            // Por ejemplo, puedes crear una tabla HTML dinámicamente y mostrar los resultados en ella
            const resultadosDiv = document.getElementById('resultados');

            // Limpiar los resultados anteriores si los hay
            resultadosDiv.innerHTML = '';

            if (data.length === 0) {
                resultadosDiv.innerText = 'No se encontraron coordinadores.';
            } else {
                const table = document.createElement('table');
                const headerRow = table.createTHead().insertRow();
                const headers = ['Nombre', 'Cédula', 'Comunidad']; // Puedes agregar más columnas según tus datos

                headers.forEach(headerText => {
                    const header = document.createElement('th');
                    const textNode = document.createTextNode(headerText);
                    header.appendChild(textNode);
                    headerRow.appendChild(header);
                });

                const tbody = table.createTBody();

                data.forEach(coordinador => {
                    const row = tbody.insertRow();
                    const rowData = [coordinador.nombre, coordinador.cedula, coordinador.comunidad]; // Puedes agregar más datos

                    rowData.forEach(text => {
                        const cell = row.insertCell();
                        const textNode = document.createTextNode(text);
                        cell.appendChild(textNode);
                    });
                });

                resultadosDiv.appendChild(table);
            }
        }

        function mostrarError(mensaje) {
            // Mostrar un mensaje de error al usuario
            const errorDiv = document.getElementById('error');
            errorDiv.innerText = mensaje;
        }

        function organizarCoordinadores(criterio) {
            // Lógica para organizar los coordinadores según el criterio seleccionado
            // ...
        }

        function exportarListaVotantesCoordinador(cedula) {
            window.location.href = `exportar_votantes.php?cedula=${cedula}`;
        }

        function editarCoordinador(cedula) {
            window.location.href = `editar_coordinador.php?cedula=${cedula}`;
        }

        function eliminarCoordinador(cedula) {
            fetch(`eliminar_coordinador.php?cedula=${cedula}`, {
                method: 'DELETE',
            })
            .then(response => {
                console.log('Coordinador eliminado');
                location.reload(); // Recarga la página después de eliminar
            })
            .catch(error => {
                console.error('Error al eliminar coordinador:', error);
            });
        }

        function mostrarFormularioAgregar() {
            var iframe = document.getElementById('iframeAgregarCoordinador');
            var urlAgregarCoordinador = 'agregar_coordinador.php';

            iframe.src = urlAgregarCoordinador;
            iframe.style.display = 'block';
        }
    </script>
</head>
<body>

<div class="table-container">
    <h2>Lista de Coordinadores</h2>
    <div class="actions">
        <input type="text" id="nombreCompleto" placeholder="Nombre Completo">
        <button onclick="buscarCoordinador()">Buscar Coordinador</button>
        <select onchange="organizarCoordinadores(this.value)">
            <option value="">Organizar por:</option>
            <option value="votos">Cantidad de Votos</option>
            <option value="alfabetico">Alfabéticamente</option>
        </select>
        <button onclick="exportarListaVotantesCoordinador(cedula)">Exportar Lista de Votantes por Coordinador</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Comunidad</th>
                <th>Colegio</th>
                <th>Apodo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';

            $sql = "SELECT * FROM coordinadores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row_votante = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_votante["cedula"] . "</td>";
                    echo "<td>" . $row_votante["nombre"] . "</td>";
                    echo "<td>" . $row_votante["comunidad"] . "</td>";
                    echo "<td>" . $row_votante["colegio"] . "</td>";
                    echo "<td>" . $row_votante["apodo"] . "</td>";

                    echo "<td>";
                    echo "<button onclick=\"editarCoordinador('{$row_votante["cedula"]}');\">Editar</button>";
                    echo "<button onclick=\"eliminarCoordinador('{$row_votante["cedula"]}');\">Eliminar</button>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>0 resultados</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<div class="lateral-bottom-left">
    <button onclick="mostrarFormularioAgregar()">Añadir Coordinador</button>
    <button onclick="window.location.href='index.html'">Volver al Inicio</button>
    <iframe id="iframeAgregarCoordinador" src=""></iframe>
</div>

</body>
</html>
