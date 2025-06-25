<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Forzar HTTPS en los recursos -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Gestion SST</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #f5f6f5;
            --accent-color: #2a6cff;
            --text-color: #333333;
            --sidebar-bg: linear-gradient(180deg, #1f2a44 0%, #2a3a5a 100%);
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
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
            background: var(--sidebar-bg);
            color: #ffffff;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
        }

        .main-header {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            background-color: var(--secondary-color);
            min-height: calc(100vh - 60px);
            padding: 20px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff !important;
            background-color: var(--accent-color);
            box-shadow: var(--icon-hover-glow);
        }

        .nav-treeview .nav-link {
            padding-left: 30px;
            font-size: 0.9rem;
        }

        .nav-icon {
            margin-right: 10px;
        }

        .nav-item.has-treeview > .nav-link > .right {
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .nav-item.has-treeview.menu-open > .nav-link > .right {
            transform: rotate(-90deg);
        }

        .sidebar-collapse .nav-link span,
        .sidebar-collapse .brand-text,
        .sidebar-collapse .user-panel .info {
            display: none;
        }

        .sidebar-collapse .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .sidebar-collapse .nav-icon {
            margin-right: 0;
            font-size: 1.3rem;
        }

        .sidebar-collapse .nav-link:hover .nav-icon {
            transform: scale(1.2);
        }

        /* Tooltip-like label on hover in collapsed state */
        .sidebar-collapse .nav-link:hover::after {
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

        .sidebar-collapse .nav-link:hover::after {
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

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            background-color: #b8daff;
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
        }

        footer a {
            color: var(--accent-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .user-panel img {
            transition: all 0.3s ease;
        }

        .sidebar-collapse .user-panel img {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-100%);
            }

            .sidebar-open .main-sidebar {
                transform: translateX(0);
            }

            .content-wrapper,
            footer {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('images/images.png') }}" alt="Logo" height="80" loading="lazy">
    </div>

    <!-- Barra de navegación superior -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Notificaciones -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <h6 class="dropdown-header">15 Notificaciones</h6>
                    <a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>4 nuevos mensajes</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i>8 solicitudes</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-file me-2"></i>3 reportes nuevos</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="#">Ver todas</a>
                </div>
            </li>
            <!-- Usuario -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">GDF</span>
        </a>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom">
            <div class="image">
                <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="Usuario" loading="lazy">
            </div>
            <div class="info">
                <span class="d-block text-white">@auth {{ auth()->user()->name }} @endauth</span>
            </div>
        </div>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <!-- Lesiones -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Lesiones">
                                    <i class="nav-icon fas fa-bone"></i>
                                    <p>Lesiones <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link" data-label="Crear Tipos">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Riesgos">
                                    <i class="nav-icon fas fa-biohazard"></i>
                                    <p>Riesgos <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipos Accidentes">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Tipos Accidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link" data-label="Lista de Tipos">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipo de persona -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de persona">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Tipo de persona <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link" data-label="Lista Personas">
                                            <i class="far fa-circle nav-icon"></i><p>Lista Personas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link" data-label="Crear Tipo Persona">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipo Persona</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de Incidentes">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Tipo de Incidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link" data-label="Lista de Incidentes">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Incidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link" data-label="Crear Tipo de Incidente">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipo de Incidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Tipo de Emergencias">
                                    <i class="nav-icon fas fa-first-aid"></i>
                                    <p>Tipo de Emergencias <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                            <i class="fas fa-first-aid nav-icon"></i><p>Lista de Emergencias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link" data-label="Crear Tipo de Emergencia">
                                            <i class="fas fa-first-aid nav-icon"></i><p>Crear Tipo de Emergencia</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Actos Inseguros">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Actos Inseguros <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link" data-label="Tipo Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i><p>Tipo Actos Inseguros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                            <i class="far fa-circle nav-icon"></i><p>Crear Tipo</p>
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
                                    <p>Accidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link" data-label="Lista de Accidentes">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Accidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link" data-label="Reportar Accidente">
                                            <i class="far fa-circle nav-icon"></i><p>Reportar Accidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Personas Involucradas -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Personas Involucradas">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Personas Involucradas <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="nav-link" data-label="Lista de Personas Involucradas">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Personas Involucradas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.people_involved.create') }}" class="nav-link" data-label="Agregar Persona Involucrada">
                                            <i class="far fa-circle nav-icon"></i><p>Agregar Persona Involucrada</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Incidentes">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Incidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link" data-label="Lista de Incidentes">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Incidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link" data-label="Reportar Incidente">
                                            <i class="far fa-circle nav-icon"></i><p>Reportar Incidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Emergencias">
                                    <i class="nav-icon fas fa-first-aid"></i>
                                    <p>Emergencias <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Emergencias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link" data-label="Reportar Emergencia">
                                            <i class="far fa-circle nav-icon"></i><p>Reportar Emergencia</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link" data-label="Actos Inseguros">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Actos Inseguros <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link" data-label="Lista de Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i><p>Lista de Actos Inseguros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link" data-label="Reportar Actos Inseguros">
                                            <i class="far fa-circle nav-icon"></i><p>Reportar Actos Inseguros</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                    <!-- Ítems simples -->
                    <li class="nav-item">
                        <a href="{{ route('events.index') }}" class="nav-link" data-label="Respuesta de eventos">
                            <i class="nav-icon fas fa-hourglass-half"></i><p>Respuesta de eventos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-label="Estado de Solicitudes">
                            <i class="nav-icon fas fa-hourglass-half"></i><p>Estado de Solicitudes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-label="Historial">
                            <i class="nav-icon fas fa-clipboard-list"></i><p>Historial</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="content-wrapper">
        <div class="container-fluid pt-5 mt-3">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container-fluid">
            <span>Copyright © 2023-2025 <a href="#" class="text-primary text-decoration-none">GDF</a></span>
            <span class="float-right d-none d-sm-inline-block">Versión 3.2.0</span>
        </div>
    </footer>

    <!-- Scripts necesarios -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
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

            // Activar enlace actual
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const parentTreeview = link.closest('.nav-treeview');
                    if (parentTreeview) {
                        const parentItem = parentTreeview.closest('.nav-item.has-treeview');
                        if (parentItem) {
                            parentItem.classList.add('menu-open');
                            const parentLink = parentItem.querySelector('.nav-link');
                            if (parentLink) {
                                parentLink.classList.add('active');
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>