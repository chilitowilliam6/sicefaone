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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #f5f6f5;
            --accent-color: #3b82f6;
            --text-color: #333333;
            --sidebar-bg: linear-gradient(180deg, #1e293b 0%, #334155 100%);
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-collapsed-width: 70px;
            --sidebar-full-width: 280px;
            --icon-hover-glow: 0 0 12px rgba(59, 130, 246, 0.4);
            --border-color: rgba(148, 163, 184, 0.2);
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .sidebar {
            width: var(--sidebar-full-width);
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            backdrop-filter: blur(10px);
            color: #ffffff;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 1000;
            scrollbar-width: thin;
            scrollbar-color: var(--accent-color) transparent;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--accent-color); border-radius: 2px; }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            overflow-x: hidden;
        }

        .main-content {
            margin-left: var(--sidebar-full-width);
            padding: 20px;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* Header del sidebar mejorado */
        .sidebar .p-3.text-center.border-bottom {
            padding: 24px 20px !important;
            border-bottom: 1px solid var(--border-color) !important;
            background: rgba(59, 130, 246, 0.05);
        }

        .sidebar .p-3.text-center.border-bottom a {
            color: white !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
            letter-spacing: -0.025em;
            transition: opacity 0.3s ease;
        }

        /* Perfil de usuario mejorado */
        .sidebar .p-3.d-flex.align-items-center.border-bottom {
            padding: 16px 20px !important;
            border-bottom: 1px solid var(--border-color) !important;
            background: rgba(255, 255, 255, 0.05);
            gap: 12px;
        }

        .sidebar .p-3.d-flex.align-items-center.border-bottom img {
            border: 2px solid var(--accent-color);
            transition: transform 0.3s ease;
        }

        .sidebar .p-3.d-flex.align-items-center.border-bottom span {
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Enlaces de navegación mejorados */
        .nav-link {
            color: #e2e8f0 !important;
            padding: 12px 16px !important;
            border-radius: 10px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            font-size: 0.9rem !important;
            font-weight: 500 !important;
            display: flex !important;
            align-items: center !important;
            position: relative !important;
            margin: 2px 12px !important;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-color) 0%, #6366f1 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: inherit;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            opacity: 1;
        }

        .nav-link i {
            position: relative;
            z-index: 1;
            width: 20px;
            margin-right: 12px;
        }

        .nav-link span {
            position: relative;
            z-index: 1;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px !important;
            margin: 2px 8px !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff !important;
            transform: translateX(4px);
            box-shadow: var(--icon-hover-glow);
        }

        /* Accordion mejorado */
        .accordion-button {
            color: #e2e8f0 !important;
            background-color: transparent !important;
            padding: 12px 16px !important;
            font-weight: 500 !important;
            font-size: 0.9rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex !important;
            align-items: center !important;
            border-radius: 10px !important;
            margin: 2px 12px !important;
            position: relative;
            overflow: hidden;
        }

        .accordion-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-color) 0%, #6366f1 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: inherit;
        }

        .accordion-button:hover::before,
        .accordion-button:not(.collapsed)::before {
            opacity: 1;
        }

        .accordion-button i {
            position: relative;
            z-index: 1;
            width: 20px;
            margin-right: 12px;
        }

        .accordion-button span {
            position: relative;
            z-index: 1;
        }

        .sidebar.collapsed .accordion-button {
            justify-content: center;
            padding: 12px !important;
            margin: 2px 8px !important;
        }

        .accordion-button:not(.collapsed) {
            color: #ffffff !important;
            transform: translateX(4px);
            box-shadow: var(--icon-hover-glow);
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
            margin-left: auto;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .sidebar.collapsed .accordion-button::after {
            display: none;
        }

        /* Submenús mejorados */
        .accordion-body {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 4px 12px;
        }

        .accordion-body .nav-link {
            color: #cbd5e1 !important;
            padding: 8px 16px !important;
            font-size: 0.85rem !important;
            margin: 2px 8px !important;
        }

        .accordion-body .nav-link i {
            width: 16px;
            opacity: 0.7;
        }

        /* Estados colapsados */
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

        .sidebar.collapsed .p-3.text-center.border-bottom a,
        .sidebar.collapsed .p-3.d-flex.align-items-center.border-bottom span {
            opacity: 0;
        }

        .sidebar.collapsed .p-3.d-flex.align-items-center.border-bottom img {
            margin-right: 0 !important;
            transform: scale(1.1);
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
            transition: margin-inline-start 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
                margin-inline-start: calc(-1 * var(--sidebar-full-width));
                width: var(--sidebar-full-width);
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
                                    aria-expanded="false" aria-controls="lesionesCollapse" data-label="Lesiones">
                                    <i class="fas fa-bone me-2"></i><span>Lesiones</span>
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipos">
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
                                    aria-expanded="false" aria-controls="riesgosCollapse" data-label="Riesgos">
                                    <i class="fas fa-biohazard me-2"></i><span>Riesgos</span>
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo">
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
                                    aria-expanded="false" aria-controls="accidentesCollapse" data-label="Tipos Accidentes">
                                    <i class="fas fa-car-crash me-2"></i><span>Tipos Accidentes</span>
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle me-2"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo">
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
                                    aria-expanded="false" aria-controls="personasCollapse" data-label="Tipo de persona">
                                    <i class="fas fa-users me-2"></i><span>Tipo de persona</span>
                                </button>
                            </h2>
                            <div id="personasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link ps-4"
                                        data-label="Lista Personas">
                                        <i class="far fa-circle me-2"></i><span>Lista Personas</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo Persona">
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
                                    aria-expanded="false" aria-controls="incidentesCollapse" data-label="Tipo de Incidentes">
                                    <i class="fas fa-exclamation-triangle me-2"></i><span>Tipo de Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Incidentes">
                                        <i class="far fa-circle me-2"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo de Incidente">
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
                                    aria-expanded="false" aria-controls="emergenciasCollapse" data-label="Tipo de Emergencias">
                                    <i class="fas fa-first-aid m-1"></i><span>Tipo de Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Emergencias">
                                        <i class="fas fa-first-aid m-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo de Emergencia">
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
                                    aria-expanded="false" aria-controls="actosinsegurosCollapse" data-label="Actos Inseguros">
                                    <i class="fas fa-car-crash me-2"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosinsegurosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link ps-4"
                                        data-label="Tipo Actos Inseguros">
                                        <i class="far fa-circle me-2"></i><span>Tipo Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo">
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
                                aria-expanded="false" aria-controls="reportesCollapse" data-label="Accidentes">
                                <i class="fas fa-ambulance me-2"></i><span>Accidentes</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link ps-4"
                                    data-label="Lista de Accidentes">
                                    <i class="far fa-circle me-2"></i><span>Lista de Accidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link ps-4"
                                    data-label="Reportar Accidente">
                                    <i class="far fa-circle me-2"></i><span>Reportar Accidente</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse"
                                aria-expanded="false" aria-controls="reportesCollapse" data-label="Personas Involucradas">
                                <i class="fas fa-ambulance me-2"></i><span>Personas Involucradas</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link ps-4"
                                    data-label="Lista de Personas Involucradas">
                                    <i class="far fa-circle me-2"></i><span>Lista de Personas Involucradas</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.people_involved.create') }}"
                                    class="nav-link ps-4" data-label="Agregar Persona Involucrada">
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
                                aria-expanded="false" aria-controls="incidentsCollapse" data-label="Incidentes">
                                <i class="fas fa-exclamation-triangle me-2"></i><span>Incidentes</span>
                            </button>
                        </h2>
                        <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menu
Accordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link ps-4"
                                    data-label="Lista de Incidentes">
                                    <i class="far fa-circle me-2"></i><span>Lista de Incidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link ps-4"
                                    data-label="Reportar Incidente">
                                    <i class="far fa-circle me-2"></i><span>Reportar Incidente</span>
                                </a>
                            </div>
                        </div>