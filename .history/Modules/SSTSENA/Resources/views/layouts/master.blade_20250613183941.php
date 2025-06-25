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

    <!-- Boxicons (for Agrocefa-style icons) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #2c3e50; /* Agrocefa primary color */
            --secondary-color: #f5f6f5;
            --accent-color: #3498db; /* Agrocefa accent color */
            --text-color: #333333;
            --sidebar-bg: #2c3e50; /* Agrocefa sidebar background */
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-collapsed-width: 60px;
            --sidebar-full-width: 260px;
            --icon-hover-glow: 0 0 8px rgba(52, 152, 219, 0.5);
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
            transition: width 0.3s ease;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.close {
            width: var(--sidebar-collapsed-width);
            overflow-x: hidden;
        }

        .main-content {
            margin-left: var(--sidebar-full-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 60px);
        }

        .main-content.close {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
        }

        .sidebar header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar header .image-text {
            display: flex;
            align-items: center;
        }

        .sidebar header .image-text .name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ffffff;
        }

        .sidebar header .image-text .profession {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar header .toggle {
            font-size: 1.5rem;
            color: #ffffff;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .sidebar.close header .toggle {
            transform: rotate(180deg);
        }

        .sidebar .menu-bar {
            padding: 10px;
        }

        .sidebar .menu-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .nav-link {
            margin: 5px 0;
        }

        .sidebar .nav-link a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar.close .nav-link a {
            justify-content: center;
            padding: 10px;
        }

        .sidebar .nav-link a:hover,
        .sidebar .nav-link a.active {
            background-color: var(--accent-color);
            color: #ffffff;
            box-shadow: var(--icon-hover-glow);
        }

        .sidebar .nav-link .icon {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .sidebar.close .nav-link .icon {
            margin-right: 0;
        }

        .sidebar .nav-link .nav-text {
            font-size: 0.95rem;
        }

        .sidebar.close .nav-link .nav-text {
            display: none;
        }

        .sidebar .nav-link.reports {
            position: relative;
        }

        .sidebar .nav-link.reports .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link.reports.active .arrow {
            transform: rotate(180deg);
        }

        .sidebar .sub-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        .sidebar .sub-list.show {
            display: block;
        }

        .sidebar .sub-list li a {
            padding: 8px 30px;
            font-size: 0.9rem;
        }

        .sidebar.close .sub-list {
            display: none;
        }

        .sidebar.close .nav-link:hover::after {
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

        .sidebar.close .nav-link:hover::after {
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
            margin-inline-start: var(--sidebar-full-width);
            transition: margin-inline-start 0.3s ease;
        }

        footer.close {
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

            .sidebar.close {
                margin-inline-start: calc(-1 * var(--sidebar-full-width));
                width: var(--sidebar-full-width);
            }

            .main-content {
                margin-inline-start: 0;
                padding: 15px;
            }

            .main-content.close {
                margin-inline-start: 0;
            }

            footer {
                margin-inline-start: 0;
            }

            footer.close {
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
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle"
                        width="40" height="40" alt="Usuario" loading="lazy">
                </span>
                <div class="text logo-text">
                    <span class="name">GDF</span>
                    <span class="profession">@auth {{ auth()->user()->name }} @endauth</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <!-- Lesiones -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Lesiones">
                                    <i class='bx bx-band-aid icon'></i>
                                    <span class="text nav-text">Lesiones</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}"
                                            class="side-link" data-label="Lista de Tipos">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}"
                                            class="side-link" data-label="Crear Tipos">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Riesgos">
                                    <i class='bx bx-biohazard icon'></i>
                                    <span class="text nav-text">Riesgos</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}"
                                            class="side-link" data-label="Lista de Tipos">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}"
                                            class="side-link" data-label="Crear Tipo">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Tipos Accidentes">
                                    <i class='bx bx-car icon'></i>
                                    <span class="text nav-text">Tipos Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}"
                                            class="side-link" data-label="Lista de Tipos">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}"
                                            class="side-link" data-label="Crear Tipo">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipo de persona -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Tipo de persona">
                                    <i class='bx bx-user icon'></i>
                                    <span class="text nav-text">Tipo de persona</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.TypePerson.index') }}"
                                            class="side-link" data-label="Lista Personas">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista Personas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.TypePerson.create') }}"
                                            class="side-link" data-label="Crear Tipo Persona">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo Persona</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Tipo de Incidentes">
                                    <i class='bx bx-error icon'></i>
                                    <span class="text nav-text">Tipo de Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.incident_types.index') }}"
                                            class="side-link" data-label="Lista de Incidentes">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Incidentes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.incident_types.create') }}"
                                            class="side-link" data-label="Crear Tipo de Incidente">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo de Incidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Tipo de Emergencias">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="text nav-text">Tipo de Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.emergency_type.index') }}"
                                            class="side-link" data-label="Lista de Emergencias">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Emergencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.emergency_type.create') }}"
                                            class="side-link" data-label="Crear Tipo de Emergencia">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo de Emergencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Actos Inseguros">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="text nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}"
                                            class="side-link" data-label="Tipo Actos Inseguros">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Tipo Actos Inseguros</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}"
                                            class="side-link" data-label="Crear Tipo">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (checkRol('sstsena.funcionario'))
                            <!-- Accidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Accidentes">
                                    <i class='bx bx-ambulance icon'></i>
                                    <span class="text nav-text">Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.accidents.index') }}"
                                            class="side-link" data-label="Lista de Accidentes">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Accidentes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.accidents.create') }}"
                                            class="side-link" data-label="Reportar Accidente">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Accidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Personas Involucradas -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Personas Involucradas">
                                    <i class='bx bx-users icon'></i>
                                    <span class="text nav-text">Personas Involucradas</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.people_involved.index') }}"
                                            class="side-link" data-label="Lista de Personas Involucradas">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Personas Involucradas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.people_involved.create') }}"
                                            class="side-link" data-label="Agregar Persona Involucrada">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Agregar Persona Involucrada</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Incidentes">
                                    <i class='bx bx-error icon'></i>
                                    <span class="text nav-text">Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.incidents.index') }}"
                                            class="side-link" data-label="Lista de Incidentes">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Incidentes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.incidents.create') }}"
                                            class="side-link" data-label="Reportar Incidente">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Incidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Emergencias">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="text nav-text">Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.emergencies.index') }}"
                                            class="side-link" data-label="Lista de Emergencias">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Emergencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.emergencies.create') }}"
                                            class="side-link" data-label="Reportar Emergencia">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Emergencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link" data-label="Actos Inseguros">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="text nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}"
                                            class="side-link" data-label="Lista de Actos Inseguros">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Actos Inseguros</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}"
                                            class="side-link" data-label="Reportar Actos Inseguros">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Actos Inseguros</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!-- Respuesta de eventos -->
                        <li class="nav-link">
                            <a href="{{ route('events.index') }}" class="side-link" data-label="Respuesta de eventos">
                                <i class='bx bx-hourglass icon'></i>
                                <span class="text nav-text">Respuesta de eventos</span>
                            </a>
                        </li>

                        <!-- Estado de Solicitudes -->
                        <li class="nav-link">
                            <a href="#" class="side-link" data-label="Estado de Solicitudes">
                                <i class='bx bx-hourglass icon'></i>
                                <span class="text nav-text">Estado de Solicitudes</span>
                            </a>
                        </li>

                        <!-- Historial -->
                        <li class="nav-link">
                            <a href="#" class="side-link" data-label="Historial">
                                <i class='bx bx-history icon'></i>
                                <span class="text nav-text">Historial</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
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

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts personalizados -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader
            window.addEventListener('load', function() {
                setTimeout(function() {
                    document.querySelector('.preloader').style.opacity = '0';
                    setTimeout(function() {
                        document.querySelector('.preloader').style.display = 'none';
                    }, 300);
                }, 500);
            });

            // Sidebar toggle
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const footer = document.querySelector('footer');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const toggleIcon = document.querySelector('.sidebar header .toggle');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('close');
                mainContent.classList.toggle('close');
                footer.classList.toggle('close');
            });

            toggleIcon.addEventListener('click', function() {
                sidebar.classList.toggle('close');
                mainContent.classList.toggle('close');
                footer.classList.toggle('close');
            });

            // Close sidebar on click outside for mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.add('close');
                    mainContent.classList.remove('close');
                    footer.classList.remove('close');
                }
            });

            // Submenu toggle
            const reportLinks = document.querySelectorAll('.nav-link.reports');
            reportLinks.forEach(reportLink => {
                const subList = reportLink.querySelector('.sub-list');
                reportLink.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default navigation for parent link
                    if (subList.classList.contains('show')) {
                        subList.classList.remove('show');
                        reportLink.classList.remove('active');
                    } else {
                        // Close other sublists
                        document.querySelectorAll('.sub-list.show').forEach(list => {
                            list.classList.remove('show');
                            list.parentElement.classList.remove('active');
                        });
                        subList.classList.add('show');
                        reportLink.classList.add('active');
                    }
                });
            });

            // Highlight active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.side-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const parentSubList = link.closest('.sub-list');
                    if (parentSubList) {
                        parentSubList.classList.add('show');
                        parentSubList.parentElement.classList.add('active');
                    }
                }
            });
        });
    </script>
</body>

</html>