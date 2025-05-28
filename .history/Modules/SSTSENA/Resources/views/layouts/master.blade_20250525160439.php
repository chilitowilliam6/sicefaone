<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestion SST</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" as="style">
    
    <!-- Google Font: Source Sans Pro - Load with font-display: swap -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" media="print" onload="this.media='all'">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" media="print" onload="this.media='all'">
    
    <!-- overlayScrollbars - Load only when needed -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" media="print" onload="this.media='all'">

    <!-- Defer non-critical scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Simplified preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('images/images.png') }}" alt="AdminLTELogo" height="100" width="150" loading="lazy">
        </div>

        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Simplified search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                </li>

                <!-- Notifications Dropdown Menu - Loaded on interaction -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                
                <!-- User dropdown -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8" loading="lazy">
                <span class="brand-text font-weight-light">GDF</span>
            </a>

            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2" alt="User Image" loading="lazy">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"></a>
                    </div>
                </div>

                <!-- Sidebar menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @auth
                            @if (checkRol('sstsena.admin'))
                                <li class="nav-item menu-open">
                                    <a href="" class="nav-link active">
                                        <i class="nav-icon "></i>
                                        <p>
                                            <i class="right fas fa-angle-left"></i>
                                            Lesiones
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.injury_types.index')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Lista de Tipos de Lesiones</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.injury_types.create')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Tipos de Lesiones</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item menu-open">
                                    <a href="" class="nav-link active">
                                        <i class="nav-icon "></i>
                                        <p>
                                            <i class="right fas fa-angle-left"></i>
                                            Riesgos
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.risk_types.index')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Lista de Tipos Riesgos</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.risk_types.create')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Tipo de Riesgo</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item menu-open">
                                    <a href="" class="nav-link active">
                                        <i class="nav-icon "></i>
                                        <p>
                                            <i class="right fas fa-angle-left"></i>
                                            Tipos Accidentes
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.accident_types.index')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Lista de Tipos Accidentes</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.admin.accident_types.create')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Tipo de Accidente</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            
                            @if (checkRol('sstsena.funcionario'))
                                <li class="nav-item menu-open">
                                    <a href="" class="nav-link active">
                                        <i class="nav-icon "></i>
                                        <p>
                                            <i class="right fas fa-angle-left"></i>
                                            Accidentes
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.funcionario.accidents.index')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Lista de Accidentes</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('sstsena.funcionario.accidents.create')}}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Reporta Accidentes</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endauth  

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hourglass-half"></i>
                                <p>Estado de Solitudes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Historial de Solicitudes</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Simplified footer -->
        <footer class="main-footer">
            <strong>Copyright © 2023-2025
                <a href="#" style="color: #3c8dbc;">GDF</a>.
            </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <!-- Load scripts at the end of body -->
    <script>
        // Load non-critical scripts dynamically
        function loadScript(src, callback) {
            var script = document.createElement('script');
            script.src = src;
            script.onload = callback;
            document.body.appendChild(script);
        }
        
        // Critical JS
        loadScript("{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}", function() {
            loadScript("{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}", function() {
                loadScript("{{ asset('AdminLTE/dist/js/adminlte.js') }}");
            });
        });
        
        // Non-critical JS
        window.addEventListener('load', function() {
            loadScript("{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}");
            loadScript("{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}");
        });
    </script>
</body>
</html>