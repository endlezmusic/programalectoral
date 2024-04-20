<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Votante</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Botón para eliminar votante -->
    <button onclick="eliminarVotante('cedula_a_eliminar')">Eliminar Votante</button>

    <script>
        function eliminarVotante(cedula) {
            $.ajax({
                type: "GET",
                url: "eliminar_votante.php",
                data: { eliminar: cedula },
                success: function(response) {
                    alert(response); // Muestra la respuesta del servidor (puede ser un mensaje de éxito o error)
                    // Aquí podrías actualizar la lista de votantes si se elimina correctamente
                },
                error: function() {
                    alert('Error al procesar la solicitud');
                }
            });
        }
    </script>
</body>
</html>
