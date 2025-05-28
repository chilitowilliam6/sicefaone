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
    
    <!-- Estilos mínimos personalizados -->
    <style>
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            color: white;
            transition: all 0.3s;
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
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
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
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
    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Botón para mostrar/ocultar sidebar en móviles -->
            <button class="btn btn-link text-white" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Menú derecho -->
            <div class="d-flex">
                <!-- Notificaciones -->
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
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
        <div class="p-3 text-center border-bottom">
            <a href="#" class="text-white text-decoration-none h5 mb-0">GDF</a>
        </div>
        
        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" 
                 class="rounded-circle me-2" width="40" height="40" alt="Usuario" loading="lazy">
            <span class="text-white">@auth {{ auth()->user()->name }} @endauth</span>
        </div>
        
        <nav class="nav flex-column p-2">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <!-- Lesiones -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none" 
                                        type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse">
                                    <i class="fas fa-bone me-2"></i> Lesiones
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{route('sstsena.admin.injury_types.index')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Lista de Tipos
                                    </a>
                                    <a href="{{route('sstsena.admin.injury_types.create')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Crear Tipos
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Riesgos -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none" 
                                        type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse">
                                    <i class="fas fa-biohazard me-2"></i> Riesgos
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{route('sstsena.admin.risk_types.index')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Lista de Tipos
                                    </a>
                                    <a href="{{route('sstsena.admin.risk_types.create')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accidentes -->
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent text-white shadow-none" 
                                        type="button" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse">
                                    <i class="fas fa-car-crash me-2"></i> Tipos Accidentes
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{route('sstsena.admin.accident_types.index')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Lista de Tipos
                                    </a>
                                    <a href="{{route('sstsena.admin.accident_types.create')}}" class="nav-link ps-4">
                                        <i class="far fa-circle me-2"></i>Crear Tipo
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
                                    type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse">
                                <i class="fas fa-ambulance me-2"></i> Accidentes
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{route('sstsena.funcionario.accidents.index')}}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i>Lista de Accidentes
                                </a>
                                <a href="{{route('sstsena.funcionario.accidents.create')}}" class="nav-link ps-4">
                                    <i class="far fa-circle me-2"></i>Reportar Accidente
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
            
            <a href="#" class="nav-link">
                <i class="fas fa-hourglass-half me-2"></i>Estado de Solicitudes
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list me-2"></i>Historial
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
    <footer class="bg-dark text-white text-center p-3 fixed-bottom">
        <div class="container-fluid">
            <span>Copyright © 2023-2025 <a href="#" class="text-primary text-decoration-none">GDF</a></span>
            <span class="float-end d-none d-sm-inline">Versión 3.2.0</span>
        </div>
    </footer>

    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (necesario para algunos plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Scripts personalizados -->
    <script>
        // Ocultar preloader cuando todo cargue
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.preloader').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.preloader').style.display = 'none';
                }, 300);
            }, 500);
            
            // Toggle sidebar en móviles
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('show');
            });
            
            // Cerrar sidebar al hacer clic fuera en móviles
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>