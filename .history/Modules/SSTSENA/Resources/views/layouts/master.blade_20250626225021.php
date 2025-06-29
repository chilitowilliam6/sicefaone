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
            --secondary-color: #f5f6f5;
            --accent-color: #2a6cff;
            --text-color: #333333;
            --sidebar-bg: #ffffff;
            --sidebar-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --navbar-bg:rgb(255, 255, 255);
            --footer-bg: #1a3c6e;
            --sidebar-collapsed-width: 60px;
            --sidebar-full-width: 260px;
            --icon-hover-glow: 0 0 8px rgba(68, 127, 255, 0.3);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-collapsed-width);
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: var(--text-color);
            transition: width var(--transition-speed) ease;
            box-shadow: var(--sidebar-shadow);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.expanded {
            width: var(--sidebar-full-width);
        }

        .main-content {
            margin-left: var(--sidebar-collapsed-width);
            padding: 20px;
            transition: margin-left var(--transition-speed) ease;
            min-height: calc(100vh - 60px);
        }

        .main-content.expanded {
            margin-left: var(--sidebar-full-width);
        }

      .navbar {
    background-color: var(--navbar-bg);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem 1rem; /* Increased vertical padding from 0.5rem to 1rem */
    z-index: 1100;
}

        .nav-link {
            color: var(--text-color);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
        }

        .sidebar:not(.expanded) .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
            background-color: var(--accent-color);
            box-shadow: var(--icon-hover-glow);
        }

        .accordion-button {
            color: var(--text-color) !important;
            background-color: transparent !important;
            padding: 12px 15px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            border-radius: 6px;
        }

        .sidebar:not(.expanded) .accordion-button {
            justify-content: center;
            padding: 12px;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color) !important;
            color: #ffffff !important;
            box-shadow: var(--icon-hover-glow);
        }

        .accordion-button::after {
            filter: brightness(0.2);
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .sidebar:not(.expanded) .accordion-button::after {
            display: none;
        }

        .accordion-body .nav-link {
            color: var(--text-color);
            padding: 8px 30px;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .sidebar:not(.expanded) .accordion-body .nav-link {
            padding: 8px;
            justify-content: center;
        }

        .sidebar:not(.expanded) .nav-link span,
        .sidebar:not(.expanded) .accordion-button span,
        .sidebar:not(.expanded) .accordion-body {
            display: none;
        }

        .sidebar:not(.expanded) .nav-link i,
        .sidebar:not(.expanded) .accordion-button i {
            margin-right: 0;
            font-size: 1.3rem;
            transition: transform 0.2s ease;
        }

        .sidebar:not(.expanded) .nav-link:hover i,
        .sidebar:not(.expanded) .accordion-button:hover i {
            transform: scale(1.2);
        }

        /* Tooltip-like label on hover in collapsed state */
        .sidebar:not(.expanded) .nav-link:hover::after,
        .sidebar:not(.expanded) .accordion-button:hover::after {
            content: attr(data-label);
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 10px);
            background: var(--accent-color);
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.9rem;
            white-space: nowrap;
            opacity: 0;
            transform: translateX(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 1001;
        }

        .sidebar:not(.expanded) .nav-link:hover::after,
        .sidebar:not(.expanded) .accordion-button:hover::after {
            opacity: 1;
            transform: translateX(0);
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
            margin-inline-start: var(--sidebar-collapsed-width);
            transition: margin-inline-start var(--transition-speed) ease;
        }

        footer.expanded {
            margin-inline-start: var(--sidebar-full-width);
        }

        footer a {
            color: var(--accent-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .sidebar .p-3.text-center.border-bottom,
        .sidebar .p-3.d-flex.align-items-center.border-bottom {
            transition: all var(--transition-speed) ease;
        }

        .sidebar:not(.expanded) .p-3.text-center.border-bottom a,
        .sidebar:not(.expanded) .p-3.d-flex.align-items-center.border-bottom span {
            opacity: 0;
        }

        .sidebar:not(.expanded) .p-3.d-flex.align-items-center.border-bottom img {
            margin-right: 0 !important;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-inline-start: calc(-1 * var(--sidebar-full-width));
                width: var(--sidebar-full-width);
                z-index: 1000;
            }

            .sidebar.expanded {
                margin-inline-start: 0;
            }

            .main-content {
                margin-inline-start: 0;
                padding: 15px;
            }

            .main-content.expanded {
                margin-inline-start: 0;
            }

            footer {
                margin-inline-start: 0;
            }

            footer.expanded {
                margin-inline-start: 0;
            }

            .navbar {
                padding: 0.5rem;
            }
        }

        /* Icon styles */
        .nav-link i, .accordion-button i {
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .nav-link:hover i, .accordion-button:hover i {
            color: var(--accent-color);
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('images/images.png') }}" alt="Logo" height="80" loading="lazy">
    </div>

 <!-- Navbar -->
<nav class="navbar navbar-expand fixed-top bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Botón para mostrar/ocultar sidebar + Título -->
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-dark me-2" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Título con margen izquierdo -->
            <div class="d-flex align-items-center ms-3">
                <i class="fas fa-hard-hat text-warning me-2"></i>
                <span class="fw-bold text-dark">Sistema de Gestión SST</span>
            </div>
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
            <a href="#" class="text-dark text-decoration-none h5 mb-0">GDF</a>
        </div>

        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2"
                width="40" height="40" alt="Usuario" loading="lazy">
            <span class="text-dark">@auth {{ auth()->user()->name }} @endauth</span>
        </div>

        <nav class="nav flex-column p-2">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <!-- Lesiones -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipos</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Riesgos -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipo</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Accidentes -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipo</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Tipo de persona -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#personasCollapse"
                                    aria-expanded="false" aria-controls="personasCollapse" data-label="Tipo de persona">
                                    <i class="fas fa-users me-2"></i><span>Tipo de Cargo</span>
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipo de Cargo</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Incidentes -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipo de Incidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Emergencias -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#emergenciasCollapse"
                                    aria-expanded="false" aria-controls="emergenciasCollapse" data-label="Tipo de Emergencias">
                                    <i class="fas fa-first-aid me-2"></i><span>Tipo de Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link ps-4"
                                        data-label="Lista de Emergencias">
                                        <i class="fas fa-first-aid me-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link ps-4"
                                        data-label="Crear Tipo de Emergencia">
                                        <i class="fas fa-first-aid me-2"></i><span>Registrar Tipo de Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Actos Inseguros -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                                        <i class="far fa-circle me-2"></i><span>Registrar Tipo</span>
                                    </a>
                                </div>
                         
                            </div>
                                    <a href="{{ route('events.index')}}" class="nav-link" data-label="Respuesta de eventos">
                <i class="fas fa-hourglass-half me-2"></i><span>Respuesta de eventos</span>
            </a>
                        </div>
                    </div>
                @endif

                @if (checkRol('sstsena.funcionario'))
                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
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
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#incidentsCollapse"
                                aria-expanded="false" aria-controls="incidentsCollapse" data-label="Incidentes">
                                <i class="fas fa-exclamation-triangle me-2"></i><span>Incidentes</span>
                            </button>
                        </h2>
                        <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
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
                    </div>

                    <!-- Emergencias -->
                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#emergenciesCollapse"
                                aria-expanded="false" aria-controls="emergenciesCollapse" data-label="Emergencias">
                                <i class="fas fa-first-aid me-2"></i><span>Emergencias</span>
                            </button>
                        </h2>
                        <div id="emergenciesCollapse" class="accordion-collapse collapse"
                            data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link ps-4"
                                    data-label="Lista de Emergencias">
                                    <i class="far fa-circle me-2"></i><span>Lista de Emergencias</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link ps-4"
                                    data-label="Reportar Emergencia">
                                    <i class="far fa-circle me-2"></i><span>Reportar Emergencia</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Actos Inseguros -->
                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#actosCollapse"
                                aria-expanded="false" aria-controls="actosCollapse" data-label="Actos Inseguros">
                                <i class="fas fa-first-aid me-2"></i><span>Actos Inseguros</span>
                            </button>
                        </h2>
                        <div id="actosCollapse" class="accordion-collapse collapse"
                            data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link ps-4"
                                    data-label="Lista de Actos Inseguros">
                                    <i class="far fa-circle me-2"></i><span>Lista de Actos Inseguros</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link ps-4"
                                    data-label="Reportar Actos Inseguros">
                                    <i class="far fa-circle me-2"></i><span>Reportar Actos Inseguros</span>
                                </a>
                            </div>
                        </div>
                          <a href="{{ route('')" class="nav-link" data-label="Historial">
                <i class="fas fa-clipboard-list me-2"></i><span>Historial</span>
            </a>
                    </div>
                @endif
            @endauth
           
          
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
            <span>Gestion SST © 2023-2025 <a href="#" class="text-primary text-decoration-none">SST</a></span>
            <span class="float-end d-none d-sm-inline">Versión 1.1</span>
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
            let isHoverEnabled = true;

            // Toggle sidebar on button click
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                mainContent.classList.toggle('expanded');
                footer.classList.toggle('expanded');
                isHoverEnabled = !sidebar.classList.contains('expanded');
            });

            // Hover behavior for desktop
            if (window.innerWidth > 768) {
                sidebar.addEventListener('mouseenter', function() {
                    if (isHoverEnabled) {
                        sidebar.classList.add('expanded');
                        mainContent.classList.add('expanded');
                        footer.classList.add('expanded');
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (isHoverEnabled) {
                        sidebar.classList.remove('expanded');
                        mainContent.classList.remove('expanded');
                        footer.classList.remove('expanded');
                    }
                });
            }

            // Close sidebar on click outside for mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    footer.classList.remove('expanded');
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