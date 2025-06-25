<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
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
        table {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
        }
        thead tr:first-child {
            background-color: #e9ecef;
        }
        thead tr:nth-child(2) {
            background-color: #f8f9fa;
            color: #34495e;
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
        <div class="container mt-5">
            <h1 class="text-2xl font-bold text-blue-900 mb-4">Lista de Eventos</h1>

            @if (session('success'))
                <div id="alertaExito" class="bg-white border border-success text-center p-3 rounded shadow mx-auto" style="max-width: 400px;">
                    <div class="text-success text-3xl">✔️</div>
                    <h5 class="mt-2 text-success">¡Éxito!</h5>
                    <p class="mb-0 text-muted">{{ session('success') }}</p>
                </div>
                <script>
                    setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);
                </script>
            @endif

            <!-- Accidentes -->
            <h2 class="text-xl font-semibold text-blue-900 mt-6">Accidentes</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-center" style="font-size: 24px; color: #1a3c6e; font-weight: bold;">Accidentes</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Descripción</th>
                            <th>Severidad</th>
                            <th>Respuestas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accidents as $accident)
                            <tr>
                                <td>{{ $accident->id }}</td>
                                <td>{{ $accident->date_time->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $accident->description ?? 'Sin descripción' }}</td>
                                <td>{{ ucfirst($accident->severity) }}</td>
                                <td>{{ $accident->eventResponses->count() }}</td>
                                <td>
                                    <a href="{{ route('sstsena.accidents.responses.index', $accident->id) }}" class="btn btn-sm btn-primary" style="background-color: #1a3c6e; border-color: #1a3c6e;">Ver Respuestas</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No se encontraron accidentes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Incidentes -->
            <h2 class="text-xl font-semibold text-blue-900 mt-6">Incidentes</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-center" style="font-size: 24px; color: #1a3c6e; font-weight: bold;">Incidentes</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Descripción</th>
                            <th>Severidad</th>
                            <th>Respuestas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incidents as $incident)
                            <tr>
                                <td>{{ $incident->id }}</td>
                                <td>{{ $incident->date_time->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $incident->description ?? 'Sin descripción' }}</td>
                                <td>{{ ucfirst($incident->severity) }}</td>
                                <td>{{ $incident->eventResponses->count() }}</td>
                                <td>
                                    <a href="{{ route('sstsena.incidents.responses.index', $incident->id) }}" class="btn btn-sm btn-primary" style="background-color: #1a3c6e; border-color: #1a3c6e;">Ver Respuestas</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No se encontraron incidentes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Emergencias -->
            <h2 class="text-xl font-semibold text-blue-900 mt-6">Emergencias</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-center" style="font-size: 24px; color: #1a3c6e; font-weight: bold;">Emergencias</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Descripción</th>
                            <th>Severidad</th>
                            <th>Respuestas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($emergencies as $emergency)
                            <tr>
                                <td>{{ $emergency->id }}</td>
                                <td>{{ $emergency->date_time->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $emergency->description ?? 'Sin descripción' }}</td>
                                <td>{{ ucfirst($emergency->severity) }}</td>
                                <td>{{ $emergency->eventResponses->count() }}</td>
                                <td>
                                    <a href="{{ route('sstsena.emergencies.responses.index', $emergency->id) }}" class="btn btn-sm btn-primary" style="background-color: #1a3c6e; border-color: #1a3c6e;">Ver Respuestas</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No se encontraron emergencias.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Actos Inseguros -->
            <h2 class="text-xl font-semibold text-blue-900 mt-6">Actos Inseguros</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-center" style="font-size: 24px; color: #1a3c6e; font-weight: bold;">Actos Inseguros</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Descripción</th>
                            <th>Severidad</th>
                            <th>Respuestas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($unsafeActs as $unsafeAct)
                            <tr>
                                <td>{{ $unsafeAct->id }}</td>
                                <td>{{ $unsafeAct->date_time->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $unsafeAct->description ?? 'Sin descripción' }}</td>
                                <td>{{ ucfirst($unsafeAct->severity) }}</td>
                                <td>{{ $unsafeAct->eventResponses->count() }}</td>
                                <td>
                                    <a href="{{ route('sstsena.unsafe_acts.responses.index', $unsafeAct->id) }}" class="btn btn-sm btn-primary" style="background-color: #1a3c6e; border-color: #1a3c6e;">Ver Respuestas</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No se encontraron actos inseguros.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Copyright © 2023-2025 GDF | Versión 3.2.0</p>
    </div>
</body>
</html>