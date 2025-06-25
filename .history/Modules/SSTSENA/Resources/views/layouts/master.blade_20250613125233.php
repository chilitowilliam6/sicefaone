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
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #0a1121;
            --secondary-color: #f5f7fa;
            --accent-color: #00eaff;
            --text-color: #e0e7ff;
            --sidebar-bg: #0a1121;
            --navbar-bg: #ffffff;
            --footer-bg: #0a1121;
            --sidebar-width: 320px;
            --sidebar-hidden-width: 20px;
            --shadow: 0 8px 24px rgba(0, 234, 255, 0.2);
            --transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        body {
            font-family: 'Orbitron', sans-serif;
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
            left: calc(-1 * var(--sidebar-width));
            background: var(--sidebar-bg);
            color: var(--text-color);
            transition: left var(--transition);
            box-shadow: var(--shadow);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar:hover, .sidebar.show {
            left: 0;
        }

        .sidebar-trigger {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-hidden-width);
            height: 100vh;
            background: linear-gradient(to right, rgba(0, 234, 255, 0.2), transparent);
            z-index: 999;
            transition: background 0.3s ease;
        }

        .sidebar-trigger:hover {
            background: linear-gradient(to right, rgba(0, 234, 255, 0.4), transparent);
        }

        .main-content {
            margin-left: 0;
            padding: 32px;
            transition: var(--transition);
            min-height: calc(100vh - 70px);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: var(--shadow);
            padding: 12px 24px;
            z-index: 1100;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #0a1121, #1c2526);
        }

        .sidebar-header img {
            filter: drop-shadow(0 0 8px rgba(0, 234, 255, 0.3));
            transition: var(--transition);
        }

        .nav-link {
            color: var(--text-color);
            padding: 12px 24px;
            border-radius: 12px;
            transition: var(--transition);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
            margin: 8px 16px;
        }

        .nav-link i {
            margin-right: 16px;
            font-size: 1.4rem;
            transition: transform 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--accent-color);
            color: #0a1121;
            box-shadow: 0 4px 16px rgba(0, 234, 255, 0.4);
            transform: scale(1.02);
        }

        .nav-link:hover i {
            transform: rotate(10deg);
        }

        .accordion-button {
            color: var(--text-color);
            background: transparent;
            padding: 12px 24px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            border-radius: 12px;
            margin: 8px 16px;
        }

        .accordion-button i {
            margin-right: 16px;
            font-size: 1.4rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--accent-color);
            color: #0a1121;
            box-shadow: 0 4px 16px rgba(0, 234, 255, 0.4);
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .accordion-body .nav-link {
            padding: 10px 40px;
            font-size: 0.9rem;
            border-radius: 10px;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #0a1121, #1c2526);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .preloader img {
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); filter: brightness(1); }
            50% { transform: scale(1.2); filter: brightness(1.5); }
            100% { transform: scale(1); filter: brightness(1); }
        }

        .navbar .dropdown-menu {
            border: none;
            box-shadow: var(--shadow);
            border-radius: 12px;
            background: #ffffff;
        }

        .dropdown-item {
            padding: 12px 24px;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: #0a1121;
        }

        .badge {
            background-color: var(--accent-color);
            box-shadow: 0 2px 8px rgba(0, 234, 255, 0.4);
        }

        footer {
            background-color: var(--footer-bg);
            color: var(--text-color);
            padding: 20px 0;
            transition: var(--transition);
        }

        footer a {
            color: var(--accent-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
            filter: brightness(1.2);
        }

        @media (max-width: 768px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar-trigger {
                display: none;
            }

            .main-content {
                padding: 20px;
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

    <!-- Sidebar Trigger -->
    <div class="sidebar-trigger"></div>

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
                <img src="{{ asset('images/Favicon2.png') }}" alt="Logo" height="40" class="me-2">
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
                    <div class="accordion" id="menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse"
                                    aria-expanded="false" aria-controls="lesionesCollapse" data-label="Lesiones">
                                    <i class="fas fa-bone"></i><span>Lesiones</span>
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                        <div id="personasInvolucradasCollapse" class="accordion-collapse collapse" data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                            <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                                data-bs-parent="#menu2519a4f5-5b8d-4b5e-81b1-8f4b3b7e0d0a">
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
                const sidebarToggle = document.getElementById('sidebarToggle');

                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                        sidebar.classList.remove('show');
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