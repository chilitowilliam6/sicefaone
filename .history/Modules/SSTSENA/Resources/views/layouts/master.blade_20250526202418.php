<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion SST - Innovación en Seguridad</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --safety-green: #28a745; /* Vibrant safety green */
            --caution-orange: #ff9800; /* Bold caution orange */
            --trust-blue: #007bff; /* Professional blue */
            --dark-bg: #1a2a44; /* Deep blue-gray background */
            --light-bg: #f8f9fa; /* Light neutral background */
            --text-color: #ffffff; /* White text for contrast */
            --hover-glow: #00e676; /* Neon green hover effect */
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--safety-green), var(--trust-blue));
            color: var(--text-color);
            height: 100vh;
            margin: 0;
            overflow-x: hidden;
            transition: background 0.5s ease;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--dark-bg);
            color: var(--text-color);
            padding-top: 20px;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, width 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
            transform: translateX(-200px);
        }

        .sidebar-header {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid var(--safety-green);
            background: linear-gradient(90deg, var(--safety-green), var(--caution-orange));
        }

        .sidebar-header h4 {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--text-color);
            text-transform: uppercase;
        }

        .user-info {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid var(--trust-blue);
        }

        .user-info img {
            border: 2px solid var(--safety-green);
            border-radius: 50%;
        }

        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--text-color) !important;
            padding: 12px 20px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .nav-link i {
            margin-right: 15px;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--hover-glow);
            color: var(--dark-bg) !important;
            border-left: 4px solid var(--caution-orange);
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        .accordion-button {
            background: transparent !important;
            color: var(--text-color) !important;
            font-weight: 500;
            padding: 12px 20px;
            border: none;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .accordion-button::after {
            background: var(--safety-green);
            border-radius: 50%;
            width: 10px;
            height: 10px;
            transition: transform 0.3s ease;
        }

        .accordion-button:not(.collapsed)::after {
            background: var(--caution-orange);
            transform: rotate(90deg);
        }

        .accordion-collapse {
            background: rgba(255, 255, 255, 0.1);
            border-left: 2px solid var(--trust-blue);
        }

        .accordion-body .nav-link {
            padding-left: 40px;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .accordion-body .nav-link:hover {
            background: rgba(0, 230, 118, 0.2);
            color: var(--text-color) !important;
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }

        .navbar {
            background: rgba(26, 42, 68, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1rem;
            position: fixed;
            width: calc(100% - 280px);
            z-index: 1100;
        }

        .navbar .btn {
            color: var(--text-color);
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .navbar {
                width: 100%;
            }
        }

        /* Animation for dynamic effect */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 20px;
            background: var(--hover-glow);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 80%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>Gestion SST</h4>
        </div>
        <div class="user-info">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" width="40" height="40" alt="Usuario" loading="lazy">
            <span class="d-block mt-2">@auth {{ auth()->user()->name }} @endauth</span>
        </div>
        <nav class="nav flex-column">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse" aria-expanded="false" aria-controls="lesionesCollapse">
                                    <i class="fas fa-bone"></i> Lesiones
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipos
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse" aria-expanded="false" aria-controls="riesgosCollapse">
                                    <i class="fas fa-biohazard"></i> Riesgos
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse" aria-expanded="false" aria-controls="accidentesCollapse">
                                    <i class="fas fa-car-crash"></i> Tipos Accidentes
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if (checkRol('sstsena.funcionario'))
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse" aria-expanded="false" aria-controls="reportesCollapse">
                                <i class="fas fa-ambulance"></i> Accidentes
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body">
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link">
                                    <i class="far fa-circle"></i> Lista de Accidentes
                                </a>
                                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link">
                                    <i class="far fa-circle"></i> Reportar Accidente
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
            
            <a href="#" class="nav-link">
                <i class="fas fa-hourglass-half"></i> Estado de Solicitudes
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list"></i> Historial
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid pt-5 mt-3">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                if (window.innerWidth > 768) {
                    sidebar.classList.toggle('collapsed');
                } else {
                    sidebar.classList.toggle('show');
                }
            });

            // Highlight active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const accordionBody = link.closest('.accordion-collapse');
                    if (accordionBody) {
                        accordionBody.classList.add('show');
                        const accordionButton = document.querySelector(`button[data-bs-target="#${accordionBody.id}"]`);
                        if (accordionButton) {
                            accordionButton.classList.remove('collapsed');
                            accordionButton.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });

            // Dynamic hover effect
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.animation = 'pulse 0.5s ease';
                });
                link.addEventListener('animationend', function() {
                    this.style.animation = '';
                });
            });
        });
    </script>
</body>
</html>