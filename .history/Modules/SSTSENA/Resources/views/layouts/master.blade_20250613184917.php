<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion SST</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Minimal Custom CSS for Animations and Tweaks -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --accent-color: #2a6cff;
            --sidebar-bg: linear-gradient(180deg, #1f2a44 0%, #2a3a5a 100%);
            --icon-hover-glow: 0 0 8px rgba(42, 108, 255, 0.5);
        }

        body {
            background-color: #f5f6f5;
            line-height: 1.6;
        }

        .offcanvas {
            background: var(--sidebar-bg);
            transition: transform 0.3s ease;
        }

        .main-content {
            padding: 20px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
            background-color: var(--accent-color);
            box-shadow: var(--icon-hover-glow);
            transform: translateX(5px);
        }

        .accordion-button {
            color: #ffffff !important;
            background-color: transparent !important;
            padding: 12px 15px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color) !important;
            box-shadow: var(--icon-hover-glow);
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 8px 30px;
            border-radius: 6px;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffffff;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
        }

        .preloader.fade-out {
            opacity: 0;
        }

        footer {
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 15px 0;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('images/images.png') }}" alt="Logo" height="80" loading="lazy">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand fixed-top bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Botón para mostrar/ocultar sidebar -->
            <button class="btn btn-link text-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Menú derecho -->
            <div class="ms-auto d-flex align-items-center">
                <!-- Notificaciones -->
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle text-dark position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">15</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><h6 class="dropdown-header">15 Notificaciones</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i>4 nuevos mensajes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>8 solicitudes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark me-2"></i>3 reportes nuevos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Ver todas</a></li>
                    </ul>
                </div>

                <!-- Usuario -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar (Offcanvas) -->
    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarLabel">
                <a href="#" class="text-white text-decoration-none">GDF</a>
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2"
                 width="40" height="40" alt="Usuario" loading="lazy">
            <span>@auth {{ auth()->user()->name }} @endauth</span>
        </div>

        <div class="offcanvas-body p-2">
            <nav class="nav flex-column">
                @auth
                    @if (checkRol('sstsena.admin'))
                        <div class="accordion" id="menuAccordion">
                            <!-- Lesiones -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse"
                                            aria-expanded="false" aria-controls="lesionesCollapse">
                                        <i class="bi bi-bandaid me-2"></i><span>Lesiones</span>
                                    </button>
                                </h2>
                                <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Lista de Tipos</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipos</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Riesgos -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse"
                                            aria-expanded="false" aria-controls="riesgosCollapse">
                                        <i class="bi bi-exclamation-triangle me-2"></i><span>Riesgos</span>
                                    </button>
                                </h2>
                                <div id="riesgosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Lista de Tipos</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipo</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Accidentes -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse"
                                            aria-expanded="false" aria-controls="accidentesCollapse">
                                        <i class="bi bi-car-front me-2"></i><span>Tipos Accidentes</span>
                                    </button>
                                </h2>
                                <div id="accidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Lista de Tipos</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipo</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo de persona -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#personasCollapse"
                                            aria-expanded="false" aria-controls="personasCollapse">
                                        <i class="bi bi-people me-2"></i><span>Tipo de persona</span>
                                    </button>
                                </h2>
                                <div id="personasCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Lista Personas</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipo Persona</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Incidentes -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#incidentesCollapse"
                                            aria-expanded="false" aria-controls="incidentesCollapse">
                                        <i class="bi bi-exclamation-circle me-2"></i><span>Tipo de Incidentes</span>
                                    </button>
                                </h2>
                                <div id="incidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Lista de Incidentes</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipo de Incidente</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Emergencias -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#emergenciasCollapse"
                                            aria-expanded="false" aria-controls="emergenciasCollapse">
                                        <i class="bi bi-heart-pulse me-2"></i><span>Tipo de Emergencias</span>
                                    </button>
                                </h2>
                                <div id="emergenciasCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-heart-pulse me-2"></i><span>Lista de Emergencias</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-heart-pulse me-2"></i><span>Crear Tipo de Emergencia</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Actos Inseguros -->
                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#actosinsegurosCollapse"
                                            aria-expanded="false" aria-controls="actosinsegurosCollapse">
                                        <i class="bi bi-exclamation-diamond me-2"></i><span>Actos Inseguros</span>
                                    </button>
                                </h2>
                                <div id="actosinsegurosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                    <div class="accordion-body p-0">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Tipo Actos Inseguros</span>
                                        </a>
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link ps-4">
                                            <i class="bi bi-circle me-2"></i><span>Crear Tipo</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (checkRol('sstsena.funcionario'))
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse"
                                        aria-expanded="false" aria-controls="reportesCollapse">
                                        <i class="bi bi-ambulance me-2"></i><span>Accidentes</span>
                                </button>
                            </h2>
                            <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Lista de Accidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Reportar Accidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse"
                                        aria-expanded="false" aria-controls="reportesCollapse">
                                        <i class="bi bi-people me-2"></i><span>Personas Involucradas</span>
                                </button>
                            </h2>
                            <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Lista de Personas Involucradas</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.people_involved.create') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Agregar Persona Involucrada</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Incidentes -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#incidentsCollapse"
                                        aria-expanded="false" aria-controls="incidentsCollapse">
                                        <i class="bi bi-exclamation-circle me-2"></i><span>Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Reportar Incidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Emergencias -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#emergenciesCollapse"
                                        aria-expanded="false" aria-controls="emergenciesCollapse">
                                        <i class="bi bi-heart-pulse me-2"></i><span>Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link ps-4">
                                        <i class="bi bi-heart-pulse me-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link ps-4">
                                        <i class="bi bi-heart-pulse me-2"></i><span>Reportar Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Actos Inseguros -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#actosCollapse"
                                        aria-expanded="false" aria-controls="actosCollapse">
                                        <i class="bi bi-exclamation-diamond me-2"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Lista de Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link ps-4">
                                        <i class="bi bi-circle me-2"></i><span>Reportar Actos Inseguros</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <a href="{{ route('events.index')}}" class="nav-link">
                    <i class="bi bi-hourglass-split me-2"></i><span>Respuesta de eventos</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-hourglass-split me-2"></i><span>Estado de Solicitudes</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="bi bi-clipboard-check me-2"></i><span>Historial</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container-fluid pt-5 mt-3">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <div class="container-fluid">
            <span>Copyright © 2023-2025 <a href="#" class="text-primary text-decoration-none">GDF</a></span>
            <span class="float-end d-none d-sm-inline">Versión 3.2.0</span>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (kept for compatibility with your existing logic) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 (kept as per your original code) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Scripts -->
    <script>
        window.addEventListener('load', function() {
            // Preloader animation
            setTimeout(function() {
                const preloader = document.querySelector('.preloader');
                preloader.classList.add('fade-out');
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 300);
            }, 500);

            // Highlight active menu item
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const accordionBody = link.closest('.accordion-collapse');
                    if (accordionBody) {
                        accordionBody.classList.add('show');
                        const accordionButton = document.querySelector(
                            `button[data-bs-target="#${accordionBody.id}"]`);
                        if (accordionButton) {
                            accordionButton.classList.remove('collapsed');
                            accordionButton.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>