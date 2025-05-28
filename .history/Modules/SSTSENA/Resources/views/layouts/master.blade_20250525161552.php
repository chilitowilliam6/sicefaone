<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion SST</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    
    <!-- Font Awesome CDN (más rápido que local) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos mínimos inline -->
    <style>
        :root {
            --primary: #3c8dbc;
            --dark: #343a40;
            --light: #f8f9fa;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .navbar {
            background: var(--dark);
            color: white;
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        .sidebar {
            width: 250px;
            background: var(--dark);
            color: white;
            position: fixed;
            top: 50px;
            bottom: 0;
            overflow-y: auto;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 70px 20px 20px;
            flex: 1;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.5rem 1rem;
            display: block;
            text-decoration: none;
        }
        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .nav-treeview {
            padding-left: 1rem;
            display: none;
        }
        .menu-open .nav-treeview {
            display: block;
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Preloader simple -->
        <div class="preloader">
            <img src="{{ asset('images/images.png') }}" alt="Logo" height="100" loading="lazy">
        </div>

        <!-- Navbar simplificado -->
        <nav class="navbar">
            <div>
                <a href="#" data-widget="pushmenu" style="color: white;"><i class="fas fa-bars"></i></a>
            </div>
            <div>
                <a href="#" data-widget="navbar-search" style="color: white; margin-right: 15px;"><i class="fas fa-search"></i></a>
                <a href="#" data-toggle="dropdown" style="color: white; margin-right: 15px; position: relative;">
                    <i class="far fa-bell"></i>
                    <span style="background: #ffc107; color: #212529; border-radius: 10px; padding: 0.2em 0.4em; font-size: 75%; position: absolute; top: -5px; right: -5px;">15</span>
                </a>
                <div style="display: inline-block; position: relative;">
                    <a href="#" id="navbarDropdown" data-bs-toggle="dropdown" style="color: white;"><i class="fas fa-user"></i></a>
                    <div style="position: absolute; right: 0; background: white; color: #333; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); min-width: 160px; display: none;">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: block; padding: 0.5rem 1rem; color: #333; text-decoration: none;">Cerrar Sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar simplificado -->
        <aside class="sidebar">
            <div style="padding: 1rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <a href="index3.html" style="color: white; text-decoration: none; font-weight: bold;">GDF</a>
            </div>

            <div style="padding: 1rem; display: flex; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 0.5rem;" loading="lazy">
                <div></div>
            </div>

            <nav style="padding: 1rem 0;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <li class="menu-open">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-bone"></i> Lesiones <i class="fas fa-angle-left" style="float: right;"></i>
                                </a>
                                <ul class="nav-treeview" style="list-style: none; padding: 0;">
                                    <li><a href="{{route('sstsena.admin.injury_types.index')}}" class="nav-link"><i class="far fa-circle"></i> Lista de Tipos de Lesiones</a></li>
                                    <li><a href="{{route('sstsena.admin.injury_types.create')}}" class="nav-link"><i class="far fa-circle"></i> Crear Tipos de Lesiones</a></li>
                                </ul>
                            </li>

                            <li class="menu-open">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-biohazard"></i> Riesgos <i class="fas fa-angle-left" style="float: right;"></i>
                                </a>
                                <ul class="nav-treeview" style="list-style: none; padding: 0;">
                                    <li><a href="{{route('sstsena.admin.risk_types.index')}}" class="nav-link"><i class="far fa-circle"></i> Lista de Tipos Riesgos</a></li>
                                    <li><a href="{{route('sstsena.admin.risk_types.create')}}" class="nav-link"><i class="far fa-circle"></i> Crear Tipo de Riesgo</a></li>
                                </ul>
                            </li>

                            <li class="menu-open">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-car-crash"></i> Tipos Accidentes <i class="fas fa-angle-left" style="float: right;"></i>
                                </a>
                                <ul class="nav-treeview" style="list-style: none; padding: 0;">
                                    <li><a href="{{route('sstsena.admin.accident_types.index')}}" class="nav-link"><i class="far fa-circle"></i> Lista de Tipos Accidentes</a></li>
                                    <li><a href="{{route('sstsena.admin.accident_types.create')}}" class="nav-link"><i class="far fa-circle"></i> Crear Tipo de Accidente</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        @if (checkRol('sstsena.funcionario'))
                            <li class="menu-open">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-ambulance"></i> Accidentes <i class="fas fa-angle-left" style="float: right;"></i>
                                </a>
                                <ul class="nav-treeview" style="list-style: none; padding: 0;">
                                    <li><a href="{{route('sstsena.funcionario.accidents.index')}}" class="nav-link"><i class="far fa-circle"></i> Lista de Accidentes</a></li>
                                    <li><a href="{{route('sstsena.funcionario.accidents.create')}}" class="nav-link"><i class="far fa-circle"></i> Reporta Accidentes</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth  

                    <li><a href="#" class="nav-link"><i class="fas fa-hourglass-half"></i> Estado de Solitudes</a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Historial de Solicitudes</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Footer simplificado -->
    <footer style="background: var(--dark); color: white; text-align: center; padding: 1rem;">
        <strong>Copyright © 2023-2025 <a href="#" style="color: var(--primary);">GDF</a>.</strong>
        <span style="float: right;">Versión 3.2.0</span>
    </footer>

    <!-- Scripts esenciales -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Ocultar preloader cuando la página cargue
        window.addEventListener('load', function() {
            document.querySelector('.preloader').style.display = 'none';
            
            // Funcionalidad del menú
            document.querySelectorAll('[data-widget="pushmenu"]').forEach(function(el) {
                el.addEventListener('click', function() {
                    document.querySelector('.sidebar').style.display = 
                        document.querySelector('.sidebar').style.display === 'none' ? 'block' : 'none';
                });
            });
            
            // Funcionalidad dropdown
            document.querySelectorAll('[data-toggle="dropdown"], [data-bs-toggle="dropdown"]').forEach(function(el) {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    const menu = this.nextElementSibling;
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                });
            });
            
            // Cerrar menús al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!e.target.matches('[data-toggle="dropdown"], [data-bs-toggle="dropdown"]')) {
                    document.querySelectorAll('[data-toggle="dropdown"] + div, [data-bs-toggle="dropdown"] + div').forEach(function(el) {
                        el.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>