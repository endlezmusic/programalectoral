<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="button.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 0;
            padding-bottom: 0;
        }
        .card-body {
            padding: 2rem;
        }
        .avatar-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #dee2e6;
            display: block;
            margin: 0 auto 1rem auto;
        }
        .form-control {
            background-color: #f7f7f7;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        .btn-primary {
            background-color: #FFA500; /* Color anaranjado */
            border-color: #FFA500;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #e69500;
            border-color: #e69500;
        }
        .btn-edit {
            font-size: 0.8rem;
            line-height: 1.5;
            border-color: transparent;
            margin-left: auto;
            display: block;
        }
        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .loading-indicator {
            display: none;
            color: #000;
        }
        .btn-group .btn {
            margin-bottom: 10px;
        }
        @media (max-width: 376px) {
            .btn-group .btn {
                display: block;
                width: 100%;
            }
        }
    </style>


    
</head>

<body>
<div class="container">
    <div class="btn-group mt-3">
        <button class="btn btn-primary" onclick="window.location.href='coordinadores.php'">Coordinadores</button>
        <button class="btn btn-primary" onclick="window.location.href='colegios_electorales.php'">Colegios Electorales</button>
        <button class="btn btn-primary" onclick="window.location.href='padron.php'">Padrón</button>
        <button class="btn btn-primary" onclick="window.location.href='analiticas.php'">Analíticas</button>
    </div>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="avatar_placeholder.png" alt="Avatar" class="avatar-img">
                        <button class="btn btn-outline-primary btn-edit">Editar</button>
                    </div>
                    <div class="card-body">
                        <form id="formularioVoto" method="post">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>

                            <div class="mb-3">
                                <label for="responsable" class="form-label">Responsable</label>
                                <input type="text" class="form-control" id="responsable" name="responsable">
                            </div>

                            <div class="mb-3">
                                <label for="afiliacion" class="form-label">Afiliación</label>
                                <input type="text" class="form-control" id="afiliacion" name="afiliacion">
                            </div>

                            <div class="mb-3">
                                <label for="apodo" class="form-label">Apodo</label>
                                <input type="text" class="form-control" id="apodo" name="apodo">
                            </div>
                            
                            <div class="mb-3">
                                <label for="colegio" class="form-label">Colegio</label>
                                <input type="text" class="form-control" id="colegio" name="colegio">
                            </div>

                            <div class="mb-3">
                                <label for="recinto" class="form-label">Recinto</label>
                                <input type="text" class="form-control" id="recinto" name="recinto">
                            </div>

                            <div class="mb-3">
                                <label for="municipio" class="form-label">Municipio</label>
                                <input type="text" class="form-control" id="municipio" name="municipio">
                            </div>

                            <div class="mb-3">
                                <label for="distrito" class="form-label">Distrito</label>
                                <input type="text" class="form-control" id="distrito" name="distrito">
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="reporte">
            <div class="dato" id="votantesRegistrados">Votantes Registrados: Cargando...</div>
            <div class="dato" id="cantidadCoordinadores">Coordinadores: Cargando...</div>
            <div class="dato" id="personasQueVotaron">Votos Emitidos: Cargando...</div>
            <div class="dato" id="personasFaltanVotar">Votos No Emitidos: Cargando...</div>
            <div class="dato" id="universoVotantes">Universo de Votantes: Cargando...</div>
        </div>
    </div>
</div>

</body>

</html>
