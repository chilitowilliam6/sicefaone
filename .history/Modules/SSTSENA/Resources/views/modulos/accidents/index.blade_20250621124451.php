<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Accidentes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Styles for Professional Look */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #1a4971;
            border-color: #1a4971;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #143c5a;
        }
        .btn-success {
            background-color: #2e7d32;
            border-color: #2e7d32;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #1b5e20;
        }
        .header-title {
            color: #1e3a8a;
            font-weight: 700;
        }
        .stat-icon {
            color: #1a4971;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Header -->
        <h2 class="header-title text-3xl mb-4 text-center">Lista de Accidentes</h2>

        <!-- Card -->
        <div class="card shadow-lg p-4 mb-5 bg-white">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <!-- Info de registros -->
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <i class="fas fa-chart-bar stat-icon me-3" style="font-size: 2rem;"></i>
                    <h5 class="mb-0 text-gray-800 font-weight-bold">
                        Total de Registros: <span class="text-primary font-weight-bold">{{ $accidents->count() }}</span>
                    </h5>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex action-buttons gap-3">
                    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-success shadow-sm px-4 py-2">
                        <i class="fas fa-plus-circle me-2"></i> Nuevo Accidente
                    </a>
                    <button class="btn btn-primary shadow-sm px-4 py-2" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                        <i class="fas fa-user-plus me-2"></i> Personas Involucradas
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>