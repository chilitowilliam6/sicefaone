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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #f5f6f5;
            --accent-color: #2a6cff;
            --text-color: #333333;
            --sidebar-bg: #1f2a44;
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 78px;
            --icon-hover-glow: 0 0 8px rgba(42, 108, 255, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            padding: 10px 14px;
            transition: all 0.5s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.close {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar .image-text {
            display: flex;
            align-items: center;
        }

        .sidebar header {
            position: relative;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar header .image-text {
            margin-bottom: 10px;
        }

        .sidebar header .image {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar header .image i {
            font-size: 40px;
            color: #ffffff;
        }

        .sidebar header .logo-text {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
        }

        .sidebar header .name {
            margin-top: 2px;
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
        }

        .sidebar header .profession {
            font-size: 16px;
            margin-top: -2px;
            display: block;
            color: #ffffff;
        }

        .sidebar header .toggle {
            position: absolute;
            top: 50%;
            right: -25px;
            transform: translateY(-50%) rotate(180deg);
            height: 25px;
            width: 25px;
            background-color: var(--accent-color);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            font-size: 22px;
            transition: all 0.5s ease;
        }

        .sidebar.close .toggle {
            transform: translateY(-50%) rotate(0deg);
        }

        .sidebar .menu-bar {
            height: calc(100% - 80px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }

        .sidebar .menu {
            margin-top: 10px;
        }

        .sidebar li.nav-link {
            list-style: none;
            height: 50px;
            margin: 5px 0;
            display: flex;
            align-items: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar li.nav-link:hover {
            background: var(--accent-color);
        }

        .sidebar li.nav-link a {
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            padding: 0 10px;
            transition: all 0.3s ease;
        }

        .sidebar li.nav-link a.active {
            background: var(--accent-color);
            color: #ffffff;
        }

        .sidebar li.nav-link .icon {
            min-width: 50px;
            font-size: 20px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar li.nav-link .text {
            color: #ffffff;
            font-size: 15px;
            font-weight: 400;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.close li.nav-link .text {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar li.nav-link.reports {
            position: relative;
        }

        .sidebar li.nav-link.reports .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .sidebar li.nav-link.reports.active .arrow {
            transform: rotate(180deg);
        }

        .sidebar li.nav-link.reports .sub-list {
            display: none;
            background: #2a3a5a;
            width: 100%;
            border-radius: 6px;
            margin-top: 5px;
            padding: 5px 0;
        }

        .sidebar li.nav-link.reports .sub-list li {
            list-style: none;
            height: 40px;
        }

        .sidebar li.nav-link.reports .sub-list li a {
            padding-left: 60px;
            font-size: 14px;
        }

        .sidebar.close li.nav-link.reports .sub-list {
            display: none !important;
        }

        .sidebar .bottom-content li {
            list-style: none;
            height: 50px;
            margin: 5px 0;
            display: flex;
            align-items: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar .bottom-content li:hover {
            background: var(--accent-color);
        }

        .sidebar .bottom-content li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            padding: 0 10px;
            color: #ffffff;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.5s ease;
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
            position: fixed;
            width: 100%;
            top: 0;
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

        footer {
            background-color: var(--footer-bg);
            color: #ffffff;
            padding: 15px 0;
            position: relative;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.5s ease;
        }

        footer.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        @media (max-width: 768px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.close {
                left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
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
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">15</span>
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

                <!-- Usuario -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    <nav class="sidebar close" id="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <i class="fas fa-shield-alt"></i>
                </span>
                <div class="text logo-text">
                    <span class="name">GDF</span>
                    <span class="profession text-center">
                        @auth {{ auth()->user()->name }} @endauth
                    </span>
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
                                <a href="#" class="side-link">
                                    <i class='bx bx-bone icon'></i>
                                    <span class="text nav-text">Lesiones</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}" class="side-link {{ Route::is('sstsena.admin.injury_types.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}" class="side-link {{ Route::is('sstsena.admin.injury_types.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-biohazard icon'></i>
                                    <span class="text nav-text">Riesgos</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}" class="side-link {{ Route::is('sstsena.admin.risk_types.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}" class="side-link {{ Route::is('sstsena.admin.risk_types.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-car icon'></i>
                                    <span class="text nav-text">Tipos Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}" class="side-link {{ Route::is('sstsena.admin.accident_types.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Tipos</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}" class="side-link {{ Route::is('sstsena.admin.accident_types.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipo de persona -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-users icon'></i>
                                    <span class="text nav-text">Tipo de persona</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="side-link {{ Route::is('sstsena.admin.TypePerson.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista Personas</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="side-link {{ Route::is('sstsena.admin.TypePerson.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo Persona</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-error icon'></i>
                                    <span class="text nav-text">Tipo de Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.incident_types.index') }}" class="side-link {{ Route::is('sstsena.admin.incident_types.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Incidentes</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.incident_types.create') }}" class="side-link {{ Route::is('sstsena.admin.incident_types.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo de Incidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="text nav-text">Tipo de Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="side-link {{ Route::is('sstsena.admin.emergency_type.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Emergencias</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="side-link {{ Route::is('sstsena.admin.emergency_type.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Crear Tipo de Emergencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="text nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="side-link {{ Route::is('sstsena.admin.unsafe_act_types.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Tipo Actos Inseguros</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="side-link {{ Route::is('sstsena.admin.unsafe_act_types.create') ? 'active' : '' }}">
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
                                <a href="#" class="side-link">
                                    <i class='bx bx-ambulance icon'></i>
                                    <span class="text nav-text">Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="side-link {{ Route::is('sstsena.funcionario.accidents.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Accidentes</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="side-link {{ Route::is('sstsena.funcionario.accidents.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Accidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Personas Involucradas -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-group icon'></i>
                                    <span class="text nav-text">Personas Involucradas</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="side-link {{ Route::is('sstsena.funcionario.people_involved.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Personas Involucradas</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.people_involved.create') }}" class="side-link {{ Route::is('sstsena.funcionario.people_involved.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Agregar Persona Involucrada</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-error icon'></i>
                                    <span class="text nav-text">Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="side-link {{ Route::is('sstsena.funcionario.incidents.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Incidentes</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="side-link {{ Route::is('sstsena.funcionario.incidents.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Incidente</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="text nav-text">Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="side-link {{ Route::is('sstsena.funcionario.emergencies.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Emergencias</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="side-link {{ Route::is('sstsena.funcionario.emergencies.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Emergencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link reports">
                                <a href="#" class="side-link">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="text nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-list">
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="side-link {{ Route::is('sstsena.funcionario.unsafe_acts.index') ? 'active' : '' }}">
                                            <i class='bx bx-list-ul icon'></i>
                                            <span class="text nav-text">Lista de Actos Inseguros</span>
                                        </a>
                                    </li>
                                    <li id="sublist-li">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="side-link {{ Route::is('sstsena.funcionario.unsafe_acts.create') ? 'active' : '' }}">
                                            <i class='bx bx-plus icon'></i>
                                            <span class="text nav-text">Reportar Actos Inseguros</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!-- Respuesta de eventos -->
                        <li class="nav-link">
                            <a href="{{ route('events.index') }}" class="side-link {{ Route::is('events.index') ? 'active' : '' }}">
                                <i class='bx bx-hourglass icon'></i>
                                <span class="text nav-text">Respuesta de eventos</span>
                            </a>
                        </li>

                        <!-- Estado de Solicitudes -->
                        <li class="nav-link">
                            <a href="#" class="side-link">
                                <i class='bx bx-hourglass icon'></i>
                                <span class="text nav-text">Estado de Solicitudes</span>
                            </a>
                        </li>

                        <!-- Historial -->
                        <li class="nav-link">
                            <a href="#" class="side-link">
                                <i class='bx bx-history icon'></i>
                                <span class="text nav-text">Historial</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="bottom-content">
                @if (Auth::check())
                    <li class="">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Cerrar Sesión</span>
                        </a>
                    </li>
                @else
                    <li class="">
                        <a href="{{ route('login') }}">
                            <i class='bx bx-lock-open icon'></i>
                            <span class="text nav-text">Iniciar Sesión</span>
                        </a>
                    </li>
                @endif
            </div>
        </div>
    </nav>

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
            const toggleButton = document.querySelector('.toggle');

            // Toggle sidebar on button click
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('close');
                mainContent.classList.toggle('collapsed');
                footer.classList.toggle('collapsed');
            });

            // Toggle sidebar on navbar button
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('close');
                mainContent.classList.toggle('collapsed');
                footer.classList.toggle('collapsed');
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                }
            });

            // Close sidebar on click outside for mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.add('close');
                    sidebar.classList.remove('show');
                    mainContent.classList.remove('collapsed');
                    footer.classList.remove('collapsed');
                }
            });

            // Handle dropdown menus
            const reportLinks = document.querySelectorAll('.nav-link.reports');
            reportLinks.forEach(reportLink => {
                const subList = reportLink.querySelector('.sub-list');
                reportLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (subList.style.display === 'block') {
                        subList.style.display = 'none';
                        reportLink.classList.remove('active');
                    } else {
                        reportLinks.forEach(link => {
                            link.classList.remove('active');
                            link.querySelector('.sub-list').style.display = 'none';
                        });
                        subList.style.display = 'block';
                        reportLink.classList.add('active');
                    }
                });
            });

            // Set active link based on current path
            const currentPath = window.location.pathname;
            document.querySelectorAll('.side-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const parentReport = link.closest('.nav-link.reports');
                    if (parentReport) {
                        parentReport.classList.add('active');
                        const subList = parentReport.querySelector('.sub-list');
                        if (subList) {
                            subList.style.display = 'block';
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>