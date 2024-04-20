<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Votantes</title>
    <style>
        body {
            background-color: #035AA6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        .table-container table {
            color: white;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .table-container th,
        .table-container td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #D99441;
        }

        .actions {
            margin: 10px 0;
        }

        .actions input,
        .actions select {
            padding: 8px;
            margin-right: 10px;
        }

        .actions button {
            background-color: #D99441;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 10px 20px;
            margin-bottom: 10px;
        }

        .actions button:hover {
            background-color: #035AA6;
        }

        iframe {
            display: none;
            width: 100%;
            height: 500px;
            border: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            background-color: #D99441;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 8px 16px;
            margin: 0 5px;
        }

        .pagination button:hover {
            background-color: #035AA6;
        }

        .pagination .current {
            background-color: #035AA6;
            cursor: default;
        }

        /* Estilos para representar el estado de voto */
        .estado-voto {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px; /* Ajusta el margen según sea necesario */
            display: inline-block;
        }

        .votado {
            background-color: green; /* Puedes ajustar el color según tus preferencias */
        }

        .no_votado {
            background-color: red; /* Puedes ajustar el color según tus preferencias */
        }

        .estado-indefinido {
            background-color: gray; /* Puedes ajustar el color según tus preferencias */
        }
        .table-container .estado-voto {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                margin-right: 5px;
                display: inline-block;
            }

            .table-container .votado {
                background-color: green;
            }

            .table-container .no_votado {
                background-color: red;
            }

            .table-container .estado-indefinido {
                background-color: gray;
            }
    </style>
</head>

<body>
    <h1>Lista de votantes</h1>

    <section class="actions">
        <input type="text" id="nombreCompleto" placeholder="Nombre Completo">
        <button onclick="buscarVotante()">Buscar Votante</button>
        <select id="cantidadPerfiles" onchange="cambiarCantidadPerfiles()">
            <option value="15">15 perfiles</option>
            <option value="50">50 perfiles</option>
            <option value="100">100 perfiles</option>
            <option value="500">500 perfiles</option>
        </select>
        <select onchange="organizarVotantes(this.value)">
            <option value="">Organizar por:</option>
            <option value="afiliacion">Afiliación</option>
            <option value="nombre">Nombre</option>
            <option value="colegio">Colegio</option>
        </select>
        <button onclick="exportarListaVotantes()">Exportar Lista de Votantes</button>
    </section>

    <section class="table-container">
        <h2>Padrón Electoral</h2>

        <?php
        include 'conexion.php';

        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $sql_padron_count = "SELECT COUNT(*) as count FROM Padron";
        $result_padron_count = $conn->query($sql_padron_count);
        $total_profiles = $result_padron_count->fetch_assoc()['count'];

        $total_pages = ceil($total_profiles / $limit);

        $sql_padron = "SELECT * FROM Padron LIMIT $limit OFFSET $offset";
        $result_padron = $conn->query($sql_padron);

        if ($result_padron) {
            if ($result_padron->num_rows > 0) {
                echo "<table border='1'>
                <tr>
                <th>Imagen</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Afiliación</th>
                <th>Colegio</th>
                <th>Teléfono</th>
                <th>Acciones</th>
                </tr>";

                while ($row_padron = $result_padron->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . htmlspecialchars($row_padron["ruta_imagen"]) . "' alt='Imagen' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "<td>" . htmlspecialchars($row_padron["cedula"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row_padron["nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row_padron["afiliacion"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row_padron["colegio"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row_padron["telefono"]) . "</td>";
                    echo "<td>";
                    echo "<button onclick=\"asignarPadron('" . htmlspecialchars($row_padron['cedula']) . "');\">Asignar</button>";
                    echo "<button onclick=\"editarPadron('" . htmlspecialchars($row_padron['cedula']) . "');\">Editar</button>";
                    echo "<button onclick=\"eliminarPadron('" . htmlspecialchars($row_padron['cedula']) . "');\">Eliminar</button>";
                    echo "</td>";

                    // Determinar el estado de voto (puedes ajustar esta lógica según tus necesidades)
                    $estadoVoto = ($row_padron['voto_emitido'] == 1) ? 'votado' : 'no_votado';

                    // Mostrar el estado de voto usando un círculo con diferentes colores
                    echo "<td class='estado-voto $estadoVoto'></td>";

                    echo "</tr>";
                }

                echo "</table>";

                // Mostrar paginación
                echo "<div class='pagination'>";
                if ($page > 1) {
                    echo "<button onclick=\"cambiarPagina(" . ($page - 1) . ")\">&#8249; Anterior</button>";
                }

                $start = max(1, $page - 3);
                $end = min($total_pages, $page + 3);

                for ($i = $start; $i <= $end; $i++) {
                    if ($i == $page) {
                        echo "<button class='current' disabled>$i</button>";
                    } else {
                        echo "<button onclick=\"cambiarPagina($i)\">$i</button>";
                    }
                }

                if ($page < $total_pages) {
                    echo "<button onclick=\"cambiarPagina(" . ($page + 1) . "\">Siguiente &#8250;</button>";
                }
                echo "</div>";
            } else {
                echo "<p>No hay perfiles en el padrón electoral.</p>";
            }
        } else {
            echo "<p>Error en la consulta SQL: " . htmlspecialchars($conn->error) . "</p>";
        }

        $conn->close();
        ?>

    </section>

    <div id="formulario-container"></div>
    <div id="resultados"></div>
    <div id="error"></div>

<script>
        function buscarVotante() {
            const nombreCompleto = document.getElementById('nombreCompleto').value;

            fetch(`buscar_votante.php?nombreCompleto=${encodeURIComponent(nombreCompleto)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al buscar votante');
                    }
                    return response.json();
                })
                .then(data => {
                    mostrarResultados(data);
                })
                .catch(error => {
                    console.error('Error en la búsqueda:', error);
                    mostrarError('Error al buscar votante. Inténtalo de nuevo.');
                });
        }

        function organizarVotantes(criterio) {
    const orderByClause = obtenerOrderByClause(criterio);

    // Realizar una nueva consulta SQL con el criterio de ordenamiento
    fetch(`organizar_votantes.php?orderBy=${encodeURIComponent(orderByClause)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al organizar votantes');
            }
            return response.json();
        })
        .then(data => {
            // Actualizar la visualización de la tabla con los datos organizados
            // Puedes utilizar la función existente mostrarResultados(data)
            mostrarResultados(data);
        })
        .catch(error => {
            console.error('Error al organizar votantes:', error);
            mostrarError('Error al organizar votantes. Inténtalo de nuevo.');
        });
}

function obtenerOrderByClause(criterio) {
    // Esta función podría retornar una cadena que se utilizará en tu consulta SQL
    // para especificar el ordenamiento según el criterio seleccionado.

    // Aquí hay un ejemplo básico, pero puedes personalizarlo según tus necesidades.
    switch (criterio) {
        case 'afiliacion':
            return 'ORDER BY afiliacion ASC';
        case 'nombre':
            return 'ORDER BY nombre ASC';
        case 'colegio':
            return 'ORDER BY colegio ASC';
        default:
            return ''; // Ordenar por defecto si el criterio no se reconoce
    }
}

        

        function exportarListaVotantes() {
            // Lógica para exportar la lista de votantes
            // ...
        }

        function mostrarResultados(data) {
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = '';

            if (data.length === 0) {
                resultadosDiv.innerText = 'No se encontraron votantes.';
            } else {
                const table = document.createElement('table');
                const headerRow = table.createTHead().insertRow();
                const headers = ['Imagen', 'Cédula', 'Nombre', 'Afiliación', 'Colegio', 'Teléfono'];

                headers.forEach(headerText => {
                    const header = document.createElement('th');
                    const textNode = document.createTextNode(headerText);
                    header.appendChild(textNode);
                    headerRow.appendChild(header);
                });

                const tbody = table.createTBody();

                data.forEach(votante => {
                    const row = tbody.insertRow();
                    const rowData = [votante.imagen, votante.cedula, votante.nombre, votante.afiliacion, votante.colegio, votante.telefono];

                    rowData.forEach((text, index) => {
                        const cell = row.insertCell();
                        if (index === 0) {
                            const img = document.createElement('img');
                            img.src = text;
                            img.alt = 'Imagen';
                            img.style.maxWidth = '100px';
                            img.style.maxHeight = '100px';
                            cell.appendChild(img);
                        } else {
                            const textNode = document.createTextNode(text);
                            cell.appendChild(textNode);
                        }
                    });
                });

                resultadosDiv.appendChild(table);
            }
        }

        function mostrarError(mensaje) {
            const errorDiv = document.getElementById('error');
            errorDiv.innerText = mensaje;
        }

        function asignarPadron(cedula) {
            // Lógica para asignar un perfil del padrón a un votante
            // ...
        }

        function editarPadron(cedula) {
            // Lógica para editar la información de un perfil del padrón
            // ...
            fetch(`obtener_padron.php?cedula=${encodeURIComponent(cedula)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener la información del padrón');
                    }
                    return response.json();
                })
                .then(data => {
                    mostrarFormularioEdicion(data);
                })
                .catch(error => {
                    console.error('Error al obtener la información del padrón:', error);
                    mostrarError('Error al obtener la información del padrón. Inténtalo de nuevo.');
                });
        }

        function mostrarFormularioEdicion(data) {
            const formulario = document.createElement('form');
            formulario.innerHTML = `
                <label for="editAfiliacion">Afiliación:</label>
                <input type="text" id="editAfiliacion" value="${data.afiliacion}" required>
                <br>
                <label for="editCedula">Cédula:</label>
                <input type="text" id="editCedula" value="${data.cedula}" readonly>
                <br>
                <label for="editNombre">Nombre:</label>
                <input type="text" id="editNombre" value="${data.nombre}" required>
                <br>
                <label for="editColegio">Colegio:</label>
                <input type="text" id="editColegio" value="${data.colegio}" required>
                <br>
                <label for="editImagen">Imagen URL:</label>
                <input type="text" id="editImagen" value="${data.ruta_imagen}" required>
                <br>
                <label for="editTelefono">Teléfono:</label>
                <input type="text" id="editTelefono" value="${data.telefono}" required>
                <br>
                <button type="button" onclick="guardarEdicion('${data.cedula}')">Guardar</button>
            `;

            const formularioContainer = document.getElementById('formulario-container');
            formularioContainer.innerHTML = '';
            formularioContainer.appendChild(formulario);
        }

        function guardarEdicion(cedula) {
            const afiliacionEditada = document.getElementById('editAfiliacion').value;
            const nombreEditado = document.getElementById('editNombre').value;
            const colegioEditado = document.getElementById('editColegio').value;
            const imagenEditada = document.getElementById('editImagen').value;
            const telefonoEditado = document.getElementById('editTelefono').value;

            fetch('guardar_edicion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    cedula: cedula,
                    afiliacion: afiliacionEditada,
                    nombre: nombreEditado,
                    colegio: colegioEditado,
                    ruta_imagen: imagenEditada,
                    telefono: telefonoEditado,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al guardar la edición');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Edición guardada con éxito:', data);
                })
                .catch(error => {
                    console.error('Error al guardar la edición:', error);
                    mostrarError('Error al guardar la edición. Inténtalo de nuevo.');
                });
        }

        function eliminarPadron(cedula) {
            // Lógica para eliminar un perfil del padrón
            // ...
        }

        function cambiarCantidadPerfiles() {
            const cantidadPerfiles = document.getElementById('cantidadPerfiles').value;
            window.location.href = `padron.php?limit=${cantidadPerfiles}&page=1`;
        }

        function cambiarPagina(page) {
            const cantidadPerfiles = document.getElementById('cantidadPerfiles').value;
            window.location.href = `padron.php?limit=${cantidadPerfiles}&page=${page}`;
        }
    </script>

</body>

</html>
























 

