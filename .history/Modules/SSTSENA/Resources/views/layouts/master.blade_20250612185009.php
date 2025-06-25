<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion SST</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            /* Dark blue for professionalism */
            --secondary-color: #f5f6f5;
            /* Light neutral background */
            --accent-color: #2a6cff;
            /* Vibrant blue for highlights */
            --text-color: #333333;
            /* Dark gray for readability */
            --sidebar-bg: #1f2a44;
            /* Darker blue-gray for sidebar */
            --navbar-bg: #ffffff;
            /* White for navbar */
            --footer-bg: #1a3c6e;
            /* Match primary color for footer */
            --sidebar-collapsed-width: 60px;
            /* Ancho de la sidebar colapsada */
            --sidebar-full-width: 260px;
            /* Ancho completo de la sidebar */
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .sidebar {
            width: var(--sidebar-full-width);
            height: 100vh;
            position: fixed;
            background-color: var(--sidebar-bg);
            color: #ffffff;
            transition: width 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            overflow-x: hidden;
        }

        .main-content {
            margin-left: var(--sidebar-full-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 60px);
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.2s ease, color 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 10px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
            background-color: var(--accent-color);
        }

        .accordion-button {
            color: #ffffff !important;
            background-color: transparent !important;
            padding: 12px 15px;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
        }

        .sidebar.collapsed .accordion-button {
            justify-content: center;
            padding: 12px;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color) !important;
            color: #ffffff !important;
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
            margin-left: auto;
        }

        .sidebar.collapsed .accordion-button::after {
            display: none;
        }

        .accordion-body .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 8px 30px;
            font-size: 0.9rem;
        }

        .sidebar.collapsed .accordion-body .nav-link {
            padding: 8px;
            justify-content: center;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .accordion-button span,
        .sidebar.collapsed .accordion-body {
            display: none;
        }

        .sidebar.collapsed .nav-link i,
        .sidebar.collapsed .accordion-button i {
            margin-right: 0;
            font-size: 1.2rem;
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

        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: #ffffff;
        }

        .badge {
            background-color: var(--accent-color) !important;
        }

        footer {
            background-color: var(--footer-bg);
            color: #ffffff;
            padding: 15px 0;
            position: relative;
            margin-inline-start: var(--sidebar-full-width);
            transition: margin-inline-start 0.3s ease;
        }

        footer.collapsed {
            margin-inline-start: var(--sidebar-collapsed-width);
        }

        footer a {
            color: var(--accent-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .sidebar .p-3.text-center.border-bottom a,
        .sidebar .p-3.d-flex.align-items-center.border-bottom span {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .p-3.text-center.border-bottom a,
        .sidebar.collapsed .p-3.d-flex.align-items-center.border-bottom span {
            opacity: 0;
        }

        .sidebar.collapsed .p-3.d-flex.align-items-center.border-bottom img {
            margin-right: 0 !important;
        }

        @media (max-inline-size: 768px) {
            .sidebar {
                margin-inline-start: calc(-1 * var(--sidebar-full-width));
                z-index: 1000;
            }

            .sidebar.show {
                margin-inline-start: 0;
                width: var(--sidebar-full-width);
            }

            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
                margin-inline-start: 0;
            }

            .main-content {
                margin-inline-start: 0;
                padding: 15px;
            }

            .main-content.collapsed {
                margin-inline-start: 0;
            }

            footer {
                margin-inline-start: 0;
            }

            footer.collapsed {
                margin-inline-start: 0;
            }

            .navbar {
                padding: 0.5rem;
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
    <nav class="navbar navbar-expand fixed-top">
        <div class="container-fluid">
            <!-- Botón para mostrar/ocultar sidebar -->
            <button class="btn btn-link text-dark" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Menú derecho -->
            <div class="d-flex align-items-center">
                <!-- Notificaciones -->
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">15</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <h6 class="dropdown-header">15 Notificaciones</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>4 nuevos
                                mensajes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i>8 solicitudes</a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-file me-2"></i>3 reportes
                                nuevos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Ver todas</a></li>
                    </ul>
                </div>

                <!-- Usuario -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
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

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="p-3 text-center border-bottom">
            <a href="#" class="text-white text-decoration-none h5 mb-0">GDF</a>
        </div>

        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2"
                width="40" height="40" alt="Usuario" loading="lazy">
            <span class="text-white">@auth {{ auth()->user()->name }} @endauth</span>
        </div>

        <nav class="nav flex-column p-2">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <!-- Lesiones -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse"
                                    aria-expanded="false" aria-controls="lesionesCollapse">
                                    <i class="fas fa-bone me-2"></i><span>Lesiones</span>
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipos</span>
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
                                    <i class="fas fa-biohazard me-2"></i><span>Riesgos</span>
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo</span>
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
                                    <i class="fas fa-car-crash me-2"></i><span>Tipos Accidentes</span>
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo</span>
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
                                    <i class="fas fa-users me-2"></i><span>Tipo de persona</span>
                                </button>
                            </h2>
                            <div id="personasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Lista Personas</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo Persona</span>
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
                                    <i class="fas fa-exclamation-triangle me-2"></i><span>Tipo de Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo de Incidente</span>
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
                                    <i class="fas fa-first-aid m-1"></i><span>Tipo de Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link ps-4">
                                        <i class="fas fa-first-aid m-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link ps-4">
                                        <i class="fas fa-first-aid m-2"></i><span>Crear Tipo de Emergencia</span>
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
                                    <i class="fas fa-car-crash me-2"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosinsegurosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Tipo Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo</span>
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
                                <i class="fas fa-ambulance me-2"></i><span>Accidentes</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Lista de Accidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Reportar Accidente</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse"
                                aria-expanded="false" aria-controls="reportesCollapse">
                                <i class="fas fa-ambulance me-2"></i><span>Personas Involucradas</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Lista de Personas Involucradas</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.people_involved.create') }}"
                                    class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Agregar Persona Involucrada</span>
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
                                <i class="fas fa-exclamation-triangle me-2"></i><span>Incidentes</span>
                            </button>
                        </h2>
                        <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Lista de Incidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Reportar Incidente</span>
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
                                <i class="fas fa-first-aid me-2"></i><span>Emergencias</span>
                            </button>
                        </h2>
                        <div id="emergenciesCollapse" class="accordion-collapse collapse"
                            data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Lista de Emergencias</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Reportar Emergencia</span>
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
                                <i class="fas fa-first-aid me-2"></i><span>Actos Inseguros</span>
                            </button>
                        </h2>
                        <div id="actosCollapse" class="accordion-collapse collapse"
                            data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Lista de Actos Inseguros</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i><span>Reportar Actos Inseguros</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
            <a href="{{ route('events.index')}}" class="nav-link">
                <i class="fas fa-hourglass-half me-2"></i><span>Respuesta de eventos</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-hourglass-half me-2"></i><span>Estado de Solicitudes</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list me-2"></i><span>Historial</span>
            </a>
        </nav>
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

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts personalizados -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.preloader').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.preloader').style.display = 'none';
                }, 300);
            }, 500);

            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const footer = document.querySelector('footer');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
                footer.classList.toggle('collapsed');
            });

            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.remove('collapsed');
                    sidebar.classList.remove('show');
                    mainContent.classList.remove('collapsed');
                    footer.classList.remove('collapsed');
                }
            });

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