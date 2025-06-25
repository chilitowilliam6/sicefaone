<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Lesiones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e3c72;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #2a5298;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            width: calc(100% - 250px);
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
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
        <h1 class="text-2xl font-bold text-blue-900 mb-4">Tipos de Lesiones</h1>
        <button class="bg-blue-700 text-white px-4 py-2 rounded mb-4">Crear Tipo de Lesión</button>
        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 text-left">Nombre</th>
                    <th class="p-2 text-left">Descripción</th>
                    <th class="p-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-2">cortadura</td>
                    <td class="p-2">se corto</td>
                    <td class="p-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded mr-2">Editar</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="p-2">Aprendiz</td>
                    <td class="p-2">ds</td>
                    <td class="p-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded mr-2">Editar</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Copyright © 2023-2025 GDF | Versión 3.2.0</p>
    </div>
</body>
</html>