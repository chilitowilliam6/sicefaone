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
            --sidebar-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-collapsed-width: 70px;
            --sidebar-full-width: 280px;
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
            background: var(--sidebar-bg);
            color: #ffffff;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            z-index: -1;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            transform: translateX(0);
        }

        .main-content {
            margin-left: var(--sidebar-full-width);
            padding: 20px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            min-height: calc(100vh - 60px);
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
            backdrop-filter: blur(10px);
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: all 0.4s ease;
            background: rgba(255,255,255,0.05);
        }

        .sidebar-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            transition: all 0.4s ease;
        }

        .sidebar.collapsed .sidebar-header h5 {
            font-size: 1rem;
            opacity: 0;
            transform: scale(0.8);
        }

        .user-profile {
            padding: 1rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: all 0.4s ease;
            background: rgba(255,255,255,0.05);
        }

        .user-profile img {
            border-radius: 50%;
            transition: all 0.4s ease;
        }

        .user-profile span {
            margin-left: 0.75rem;
            font-weight: 500;
            transition: all 0.4s ease;
        }

        .sidebar.collapsed .user-profile {
            justify-content: center;
        }

        .sidebar.collapsed .user-profile span {
            opacity: 0;
            transform: translateX(-20px);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.875rem 1.25rem;
            border-radius: 12px;
            margin: 0.25rem 0.75rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 1rem;
            margin: 0.25rem 0.5rem;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.3rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .nav-link:hover i,
        .nav-link.active i {
            transform: scale(1.1);
        }

        .accordion-button {
            color: #ffffff !important;
            background: transparent !important;
            padding: 0.875rem 1.25rem;
            margin: 0.25rem 0.75rem;
            border-radius: 12px !important;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: none !important;
            box-shadow: none !important;
            position: relative;
            overflow: hidden;
        }

        .accordion-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .accordion-button:hover::before {
            left: 100%;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1)) !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
            transform: translateY(-2px);
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .accordion-button {
            justify-content: center;
            padding: 1rem;
            margin: 0.25rem 0.5rem;
        }

        .sidebar.collapsed .accordion-button::after {
            display: none;
        }

        .accordion-body .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.625rem 2rem;
            font-size: 0.9rem;
            margin: 0.125rem 0.75rem;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .accordion-button span,
        .sidebar.collapsed .accordion-body {
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.3s ease;
        }

        /* Tooltip empresarial */
        .sidebar.collapsed .nav-link:hover::after,
        .sidebar.collapsed .accordion-button:hover::after {
            content: attr(data-label);
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 15px);
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 1;
            z-index: 1001;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0.25rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--accent-color), #667eea);
            color: #ffffff;
            transform: translateY(-1px);
        }

        footer {
            background-color: var(--footer-bg);
            color: #ffffff;
            padding: 15px 0;
            margin-inline-start: var(--sidebar-full-width);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        footer.collapsed {
            margin-inline-start: var(--sidebar-collapsed-width);
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-full-width));
                z-index: 1000;
            }

            .sidebar.show {
                margin-left: 0;
                width: var(--sidebar-full-width);
            }

            .sidebar.collapsed {
                margin-left: calc(-1 * var(--sidebar-full-width));
                width: var(--sidebar-full-width);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .main-content.collapsed {
                margin-left: 0;
            }

            footer {
                margin-left: 0;
            }

            footer.collapsed {
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
        <div class="sidebar-header">
            <h5>GDF</h5>
        </div>

        <div class="user-profile">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle"
                width="40" height="40" alt="Usuario" loading="lazy">
            <span>@auth {{ auth()->user()->name }} @endauth</span>
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
                        <div id="incidentsCollapse" class="accordion-collapse collapse" data