<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Forzar HTTPS en los recursos -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestion SST</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
        }
        .main-header, .main-sidebar, .content-wrapper {
            background-color: #ffffff;
        }
        .main-sidebar {
            border-right: 1px solid #dee2e6;
        }
        .nav-link {
            color: rgb(10, 70, 134);
        }
        .nav-link.active {
            background-color: #cce5ff;
            color: #004085;
        }
        .nav-icon {
            color: #004085;
        }
        .navbar-white {
            background-color: rgb(94, 113, 133);
        }
        .sidebar-success-green {
            background-color: rgb(252, 252, 252);
        }
        .dropdown-menu-end {
            background-color: #b8daff;
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
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
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notificaciones</span>
                    <a href="#" class="dropdown-item"><i class="fas fa-envelope me-2"></i>4 nuevos mensajes</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-users me-2"></i>8 solicitudes</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-file me-2"></i>3 reportes nuevos</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Ver todas</a>
                </div>
            </li>
            <!-- Usuario -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ auth()->user()->name ?? 'Usuario' }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-success-green elevation-4">
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="Usuario" loading="lazy">
                </div>
                <div class="info">
                    <a href="#" class="d-block text-dark">@auth {{ auth()->user()->name }} @endauth</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <!-- Lesiones -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-bone"></i>
                                    <p>Lesiones <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Crear Tipos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-biohazard"></i>
                                    <p>Riesgos <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-car-crash"></i>
                                    <p>Tipos Accidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Lista de Tipos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Crear Tipo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (checkRol('sstsena.funcionario'))
                            <!-- Accidentes (Funcionario) -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-ambulance"></i>
                                    <p>Accidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Lista de Accidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Reportar Accidente</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <!-- Ítems simples -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hourglass-half"></i>
                                <p>Estado de Solicitudes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Historial</p>
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Versión</b> 3.2.0
        </div>
        <strong>Copyright © 2023-2025 <a href="#" class="text-primary">GDF</a>.</strong> Todos los derechos reservados.
    </footer>

    <!-- Sidebar de control (opcional) -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Scripts necesarios -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/demo.js"></script>
    <script src="/js/app.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para preloader -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.preloader').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.preloader').style.display = 'none';
                }, 300);
            }, 500);
        });
    </script>
</body>
</html>