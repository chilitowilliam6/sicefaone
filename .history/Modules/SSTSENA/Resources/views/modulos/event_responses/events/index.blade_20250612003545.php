<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Respuesta a Accidente #4</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #ff8c00);
            color: #ffffff;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1e3c72;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover {
            background: #ff8c00;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #1e3c72;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group select {
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
            background-size: 12px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#">Usua</a>
        <a href="#">Lesiones</a>
        <a href="#">Riesgos</a>
        <a href="#">Tipos Accidentes</a>
        <a href="#">Tipo de persona</a>
        <a href="#">Tipo de Incidentes</a>
        <a href="#">Tipo de Emergencias</a>
        <a href="#">Actos Inseguros</a>
        <a href="#">Respuesta de eventos</a>
        <a href="#">Estado de Solicitudes</a>
        <a href="#">Historial</a>
    </div>
    <div class="content">
        <div class="form-container">
            <h1 class="text-2xl font-bold mb-4 text-center">Agregar Respuesta a Accidente #4</h1>
            <form>
                <div class="form-group">
                    <label for="respuesta">Respuesta</label>
                    <textarea id="respuesta" rows="4" placeholder="Escribe tu respuesta"></textarea>
                </div>
                <div class="form-group">
                    <label for="acciones">Acciones Tomadas</label>
                    <textarea id="acciones" rows="4" placeholder="Detalla las acciones tomadas"></textarea>
                </div>
                <div class="form-group">
                    <label for="gravedad">Gravedad</label>
                    <select id="gravedad">
                        <option value="">Seleccione una opción</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</body>
</html>