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

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #f5f6f5;
            --accent-color: #2a6cff;
            --text-color: #333333;
            --sidebar-collapsed-width: 60px;
            --sidebar-full-width: 260px;
            --icon-hover-glow: 0 0 8px rgba(42, 108, 255, 0.5);
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .main-sidebar {
            width: var(--sidebar-full-width);
            height: 100vh;
            position: fixed;
            background-color:rgb(255, 137, 41);
            transition: width 0.3s ease, transform 0.3s ease;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            z-index: 1000;
        }

        .main-sidebar.collapsed {
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
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
        }

        .nav-sidebar .nav-link {
            color:rgb(0, 95, 168);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
        }

        .nav-sidebar .nav-link:hover,
        .nav-sidebar .nav-link.active {
            color:rgb(173, 0, 0);
            background-color: var(--accent-color);
            box-shadow: var(--icon-hover-glow);
        }

        .nav-treeview .nav-link {
            padding-left: 30px;
            font-size: 0.9rem;
        }

        .main-sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .main-sidebar.collapsed .nav-link p,
        .main-sidebar.collapsed .brand-text,
        .main-sidebar.collapsed .user-panel .info,
        .main-sidebar.collapsed .nav-treeview {
            display: none;
        }

        .main-sidebar.collapsed .nav-link i.nav-icon,
        .main-sidebar.collapsed .brand-image {
            margin-right: 0;
            font-size: 1.3rem;
            transition: transform 0.2s ease;
        }

        .main-sidebar.collapsed .nav-link:hover i.nav-icon {
            transform: scale(1.2);
        }

        .main-sidebar.collapsed .nav-link:hover::after {
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

        .main-sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
            transform: translateX(0);
        }

        .brand-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .brand-image {
            margin-right: 10px;
            width: 30px;
            height: 30px;
        }

        .user-panel {
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .user-panel .image img {
            width: 30px;
            height: 30px;
        }

        .nav-icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .right {
            margin-left: auto;
        }

        .nav-treeview {
            display: none;
        }

        .nav-item.has-treeview.menu-open > .nav-treeview {
            display: block;
        }

        .nav-item.has-treeview.menu-open > .nav-link .right {
            transform: rotate(-90deg);
        }

        .nav-link .right {
            transition: transform 0.3s ease;
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
            background-color: var(--primary-color);
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

        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(calc(-1 * var(--sidebar-full-width)));
                width: var(--sidebar-full-width);
            }

            .main-sidebar.show {
                transform: translateX(0);
            }

            .main-sidebar.collapsed {
                transform: translateX(calc(-1 * var(--sidebar-full-width)));
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
    <aside class="main-sidebar sidebar-light-purple elevation-4" id="sidebar">
        <!-- Brand Logo -->
        <div class="p-3 text-center border-bottom">
            <a href="#" class="brand-link text-decoration-none">
                <img src="{{ asset('images/Favicon2.png') }}" alt="GDF Logo" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light">GDF</span>
            </a>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-2 mb-2 d-flex border-bottom">
                <div class="image">
                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="Usuario" width="40" height="40" loading="lazy">
                </div>
                <div class="info">
                    <span class="d-block text-dark">@auth {{ auth()->user()->name }} @endauth</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <!-- Lesiones -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Lesiones">
                                    <i class="nav-icon fas fa-bone"></i>
                                    <p>Lesiones<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link" data-label="Crear Tipos">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Riesgos">
                                    <i class="nav-icon fas fa-biohazard"></i>
                                    <p>Riesgos<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipos Accidentes">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Tipos Accidentes<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipo de persona -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de persona">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Tipo de persona<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link" data-label="Lista Personas">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista Personas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link" data-label="Crear Tipo Persona">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo Persona</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de Incidentes">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Tipo de Incidentes<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link" data-label="Lista de Incidentes">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Incidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link" data-label="Crear Tipo de Incidente">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo de Incidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de Emergencias">
                                    <i class="nav-icon fas fa-first-aid"></i>
                                    <p>Tipo de Emergencias<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Emergencias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link" data-label="Crear Tipo de Emergencia">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo de Emergencia</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Actos Inseguros">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Actos Inseguros<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link" data-label="Tipo Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tipo Actos Inseguros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (checkRol('sstsena.funcionario'))
                            <!-- Accidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Accidentes">
                                    <i class="nav-icon fas fa-ambulance"></i>
                                    <p>Accidentes<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link" data-label="Lista de Accidentes">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Accidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link" data-label="Reportar Accidente">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reportar Accidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Personas Involucradas -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Personas Involucradas">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Personas Involucradas<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link" data-label="Lista de Personas Involucradas">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Personas Involucradas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.people_involved.create') }}" class="nav-link" data-label="Agregar Persona Involucrada">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Agregar Persona Involucrada</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Incidentes">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Incidentes<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link" data-label="Lista de Incidentes">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Incidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link" data-label="Reportar Incidente">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reportar Incidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Emergencias">
                                    <i class="nav-icon fas fa-first-aid"></i>
                                    <p>Emergencias<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Emergencias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link" data-label="Reportar Emergencia">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reportar Emergencia</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Actos Inseguros">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Actos Inseguros<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link" data-label="Lista de Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Actos Inseguros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link" data-label="Reportar Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reportar Actos Inseguros</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth

                    <!-- Other Links -->
                    <li class="nav-item">
                        <a href="{{ route('events.index') }}" class="nav-link" data-label="Respuesta de eventos">
                            <i class="nav-icon fas fa-hourglass-half"></i>
                            <p>Respuesta de eventos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-label="Estado de Solicitudes">
                            <i class="nav-icon fas fa-hourglass-half"></i>
                            <p>Estado de Solicitudes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-label="Historial">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Historial</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

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

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts personalizados -->
    <script>
        window.addEventListener('load', function() {
            // Preloader
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

            // Sidebar toggle
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
                footer.classList.toggle('collapsed');
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                }
            });

            // Close sidebar on click outside for mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    sidebar.classList.remove('show');
                    sidebar.classList.add('collapsed');
                    mainContent.classList.remove('collapsed');
                    footer.classList.remove('collapsed');
                }
            });

            // Initialize AdminLTE treeview
            $('.nav-sidebar .has-treeview > .nav-link').on('click', function(e) {
                if ($(this).parent().hasClass('menu-open')) {
                    $(this).parent().removeClass('menu-open');
                    $(this).next('.nav-treeview').slideUp(200);
                } else {
                    $(this).closest('.nav-sidebar').find('.has-treeview.menu-open').removeClass('menu-open');
                    $(this).closest('.nav-sidebar').find('.nav-treeview').slideUp(200);
                    $(this).parent().addClass('menu-open');
                    $(this).next('.nav-treeview').slideDown(200);
                }
            });

            // Highlight active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const treeview = link.closest('.nav-treeview');
                    if (treeview) {
                        const parent = treeview.closest('.has-treeview');
                        parent.classList.add('menu-open');
                        treeview.style.display = 'block';
                    }
                }
            });
        });
    </script>
</body>

</html>