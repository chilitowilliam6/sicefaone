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
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #0d1b2a;
            --secondary-color: #f5f7fa;
            --accent-color: #00aaff;
            --text-color: #e0e7ff;
            --sidebar-bg: #0b132b;
            --navbar-bg: #ffffff;
            --footer-bg: #0d1b2a;
            --sidebar-width: 300px;
            --sidebar-collapsed-width: 80px;
            --shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Exo 2', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: var(--text-color);
            transition: var(--transition);
            box-shadow: var(--shadow);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 32px;
            transition: var(--transition);
            min-height: calc(100vh - 70px);
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: var(--shadow);
            padding: 12px 24px;
            z-index: 1100;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #0b132b, #1b263b);
        }

        .sidebar-header img {
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-header img {
            transform: scale(0.9);
        }

        .sidebar.collapsed .sidebar-header span {
            display: none;
        }

        .nav-link {
            color: var(--text-color);
            padding: 12px 20px;
            border-radius: 10px;
            transition: var(--transition);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
            margin: 6px 12px;
        }

        .nav-link i {
            margin-right: 14px;
            font-size: 1.3rem;
            transition: transform 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--accent-color);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 170, 255, 0.3);
            transform: translateX(4px);
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .accordion-button {
            color: var(--text-color);
            background: transparent;
            padding: 12px 20px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            border-radius: 10px;
            margin: 6px 12px;
        }

        .accordion-button i {
            margin-right: 14px;
            font-size: 1.3rem;
        }

        .sidebar.collapsed .accordion-button {
            justify-content: center;
            padding: 12px;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 170, 255, 0.3);
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .sidebar.collapsed .accordion-button::after {
            display: none;
        }

        .accordion-body .nav-link {
            padding: 10px 36px;
            font-size: 0.9rem;
            border-radius: 8px;
        }

        .sidebar.collapsed .accordion-body .nav-link {
            padding: 10px;
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
            font-size: 1.5rem;
        }

        .sidebar.collapsed .nav-link:hover i,
        .sidebar.collapsed .accordion-button:hover i {
            transform: scale(1.2);
        }

        .sidebar.collapsed .nav-link:hover::after,
        .sidebar.collapsed .accordion-button:hover::after {
            content: attr(data-label);
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 12px);
            background: var(--accent-color);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            white-space: nowrap;
            opacity: 0;
            transform: translateX(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 1001;
        }

        .sidebar.collapsed .nav-link:hover::after,
        .sidebar.collapsed .accordion-button:hover::after {
            opacity: 1;
            transform: translateX(0);
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #0b132b, #1b263b);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .preloader img {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .navbar .dropdown-menu {
            border: none;
            box-shadow: var(--shadow);
            border-radius: 10px;
            background: #ffffff;
        }

        .dropdown-item {
            padding: 12px 24px;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: #ffffff;
        }

        .badge {
            background-color: var(--accent-color);
            box-shadow: 0 2px 6px rgba(0, 170, 255, 0.3);
        }

        footer {
            background-color: var(--footer-bg);
            color: var(--text-color);
            padding: 20px 0;
            margin-inline-start: var(--sidebar-width);
            transition: var(--transition);
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

        @media (max-width: 768px) {
            .sidebar {
                margin-inline-start: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                margin-inline-start: 0;
                width: var(--sidebar-width);
            }

            .sidebar.collapsed {
                margin-inline-start: calc(-1 * var(--sidebar-width));
                width: var(--sidebar-width);
            }

            .main-content {
                margin-inline-start: 0;
                padding: 20px;
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
                padding: 10px;
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
            <button class="btn btn-link text-dark" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-flex align-items-center">
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">15</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">15 Notificaciones</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>4 nuevos mensajes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i>8 solicitudes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-file me-2"></i>3 reportes nuevos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Ver todas</a></li>
                    </ul>
                </div>
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
        <div class="sidebar-header">
            <a href="#" class="text-white text-decoration-none h5 mb-0">
                <img src="{{ asset('images/Favicon2.png') }}" alt="Logo" height="36" class="me-2">
                <span>GDF</span>
            </a>
        </div>
        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2"
                width="40" height="40" alt="Usuario" loading="lazy">
            <span class="text-white">@auth {{ auth()->user()->name }} @endauth</span>
        </div>
        <nav class="nav flex-column p-3">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse"
                                    aria-expanded="false" aria-controls="lesionesCollapse" data-label="Lesiones">
                                    <i class="fas fa-bone"></i><span>Lesiones</span>
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link"
                                        data-label="Crear Tipos">
                                        <i class="far fa-circle"></i><span>Crear Tipos</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse"
                                    aria-expanded="false" aria-controls="riesgosCollapse" data-label="Riesgos">
                                    <i class="fas fa-biohazard"></i><span>Riesgos</span>
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link"
                                        data-label="Crear Tipo">
                                        <i class="far fa-circle"></i><span>Crear Tipo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse"
                                    aria-expanded="false" aria-controls="accidentesCollapse" data-label="Tipos Accidentes">
                                    <i class="fas fa-car-crash"></i><span>Tipos Accidentes</span>
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link"
                                        data-label="Lista de Tipos">
                                        <i class="far fa-circle"></i><span>Lista de Tipos</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link"
                                        data-label="Crear Tipo">
                                        <i class="far fa-circle"></i><span>Crear Tipo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#personasCollapse"
                                    aria-expanded="false" aria-controls="personasCollapse" data-label="Tipo de persona">
                                    <i class="fas fa-users"></i><span>Tipo de persona</span>
                                </button>
                            </h2>
                            <div id="personasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link"
                                        data-label="Lista Personas">
                                        <i class="far fa-circle"></i><span>Lista Personas</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link"
                                        data-label="Crear Tipo Persona">
                                        <i class="far fa-circle"></i><span>Crear Tipo Persona</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#incidentesCollapse"
                                    aria-expanded="false" aria-controls="incidentesCollapse" data-label="Tipo de Incidentes">
                                    <i class="fas fa-exclamation-triangle"></i><span>Tipo de Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link"
                                        data-label="Lista de Incidentes">
                                        <i class="far fa-circle"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link"
                                        data-label="Crear Tipo de Incidente">
                                        <i class="far fa-circle"></i><span>Crear Tipo de Incidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#emergenciasCollapse"
                                    aria-expanded="false" aria-controls="emergenciasCollapse" data-label="Tipo de Emergencias">
                                    <i class="fas fa-first-aid"></i><span>Tipo de Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciasCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link"
                                        data-label="Lista de Emergencias">
                                        <i class="fas fa-first-aid"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link"
                                        data-label="Crear Tipo de Emergencia">
                                        <i class="fas fa-first-aid"></i><span>Crear Tipo de Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#actosinsegurosCollapse"
                                    aria-expanded="false" aria-controls="actosinsegurosCollapse" data-label="Actos Inseguros">
                                    <i class="fas fa-car-crash"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosinsegurosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link"
                                        data-label="Tipo Actos Inseguros">
                                        <i class="far fa-circle"></i><span>Tipo Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link"
                                        data-label="Crear Tipo">
                                        <i class="far fa-circle"></i><span>Crear Tipo</span>
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
                                <i class="fas fa-ambulance"></i><span>Accidentes</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link"
                                    data-label="Lista de Accidentes">
                                    <i class="far fa-circle"></i><span>Lista de Accidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link"
                                    data-label="Reportar Accidente">
                                    <i class="far fa-circle"></i><span>Reportar Accidente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#personasInvolucradasCollapse"
                                aria-expanded="false" aria-controls="personasInvolucradasCollapse" data-label="Personas Involucradas">
                                <i class="fas fa-users"></i><span>Personas Involucradas</span>
                                </button>
                            </h2>
                            <div id="personasInvolucradasCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link"
                                        data-label="Lista de Personas Involucradas">
                                        <i class="far fa-circle"></i><span>Lista de Personas Involucradas</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.people_involved.create') }}" class="nav-link"
                                        data-label="Agregar Persona Involucrada">
                                        <i class="far fa-circle"></i><span>Agregar Persona Involucrada</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#incidentsCollapse"
                                    aria-expanded="false" aria-controls="incidentsCollapse" data-label="Incidentes">
                                    <i class="fas fa-exclamation-triangle"></i><span>Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link"
                                        data-label="Lista de Incidentes">
                                        <i class="far fa-circle"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link"
                                        data-label="Reportar Incidente">
                                        <i class="far fa-circle"></i><span>Reportar Incidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#emergenciesCollapse"
                                    aria-expanded="false" aria-controls="emergenciesCollapse" data-label="Emergencias">
                                    <i class="fas fa-first-aid"></i><span>Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciesCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link"
                                        data-label="Lista de Emergencias">
                                        <i class="far fa-circle"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link"
                                        data-label="Reportar Emergencia">
                                        <i class="far fa-circle"></i><span>Reportar Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#actosCollapse"
                                    aria-expanded="false" aria-controls="actosCollapse" data-label="Actos Inseguros">
                                    <i class="fas fa-exclamation"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosCollapse" class="accordion-collapse collapse"
                                data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link"
                                        data-label="Lista de Actos Inseguros">
                                        <i class="far fa-circle"></i><span>Lista de Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link"
                                        data-label="Reportar Actos Inseguros">
                                        <i class="far fa-circle"></i><span>Reportar Actos Inseguros</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <a href="{{ route('events.index') }}" class="nav-link" data-label="Respuesta de eventos">
                    <i class="fas fa-hourglass-half"></i><span>Respuesta de eventos</span>
                </a>
                <a href="#" class="nav-link" data-label="Estado de Solicitudes">
                    <i class="fas fa-hourglass-half"></i><span>Estado de Solicitudes</span>
                </a>
                <a href="#" class="nav-link" data-label="Historial">
                    <i class="fas fa-clipboard-list"></i><span>Historial</span>
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
                    }, 500);
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
                        sidebar.classList.remove('show');
                        sidebar.classList.add('collapsed');
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