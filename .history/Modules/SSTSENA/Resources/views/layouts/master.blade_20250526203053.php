<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion SST - Sistema de Seguridad</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-navy: #1B263B; /* Deep navy for professionalism */
            --secondary-gray: #6B7280; /* Neutral gray for secondary elements */
            --white-bg: #FFFFFF; /* Clean white background */
            --light-gray: #F3F4F6; /* Subtle light gray for content areas */
            --accent-blue: #3B82F6; /* Professional blue accent */
            --text-dark: #111827; /* Dark text for readability */
            --text-light: #FFFFFF; /* White text for dark backgrounds */
            --border-color: #E5E7EB; /* Light border for separation */
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--light-gray);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--primary-navy);
            padding: 20px 0;
            box-shadow: var(--shadow);
            transition: width 0.3s ease, transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 15px 20px;
            text-align: center;
            background: var(--primary-navy);
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-header h4 {
            font-size: 1.4rem;
            font-weight: 500;
            color: var(--text-light);
            margin: 0;
            letter-spacing: 0.5px;
        }

        .user-info {
            padding: 15px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            margin-bottom: 10px;
        }

        .user-info span {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            color: var(--text-light) !important;
            padding: 10px 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
            border-radius: 4px;
            margin: 0 10px;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-blue);
            color: var(--text-light) !important;
        }

        .accordion-button {
            background: transparent !important;
            color: var(--text-light) !important;
            font-weight: 400;
            font-size: 0.9rem;
            padding: 10px 20px;
            border: none;
            transition: background 0.2s ease;
        }

        .accordion-button::after {
            filter: brightness(1.2);
        }

        .accordion-button:not(.collapsed) {
            background: rgba(59, 130, 246, 0.1) !important;
            color: var(--text-light) !important;
        }

        .accordion-collapse {
            background: rgba(255, 255, 255, 0.05);
        }

        .accordion-body .nav-link {
            padding-left: 40px;
            font-size: 0.85rem;
        }

        /* Navbar */
        .navbar {
            background: var(--white-bg);
            box-shadow: var(--shadow);
            padding: 0.75rem 1rem;
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            z-index: 1100;
            transition: left 0.3s ease, width 0.3s ease;
        }

        .navbar.collapsed {
            left: 70px;
            width: calc(100% - 70px);
        }

        .navbar .btn {
            color: var(--text-dark);
            font-size: 1.2rem;
        }

        .navbar .btn:hover {
            color: var(--accent-blue);
        }

        .navbar-text {
            color: var(--text-dark);
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 80px 20px 20px;
            min-height: 100vh;
            background: var(--light-gray);
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 70px;
        }

        .content-card {
            background: var(--white-bg);
            border-radius: 6px;
            box-shadow: var(--shadow);
            padding: 20px;
            margin-bottom: 20px;
        }

        .content-card h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
                width: 250px;
            }
            .main-content {
                margin-left: 0;
            }
            .navbar {
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-auto">
                <span class="navbar-text">Bienvenido, @auth {{ auth()->user()->name }} @endauth</span>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>Gestion SST</h4>
        </div>
        <div class="user-info">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" alt="Usuario" loading="lazy">
            <span>@auth {{ auth()->user()->name }} @endauth</span>
        </div>
        <nav class="nav flex-column">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse" aria-expanded="false" aria-controls="lesionesCollapse">
                                    <i class="fas fa-bone"></i> Gestión de Lesiones
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse" aria-expanded="false" aria-controls="riesgosCollapse">
                                    <i class="fas fa-biohazard"></i> Gestión de Riesgos
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse" aria-expanded="false" aria-controls="accidentesCollapse">
                                    <i class="fas fa-car-crash"></i> Gestión de Accidentes
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if (checkRol('sstsena.funcionario'))
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reportesCollapse" aria-expanded="false" aria-controls="reportesCollapse">
                                <i class="fas fa-ambulance"></i> Reporte de Accidentes
                            </button>
                            </h2>
                            <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Accidentes
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Reportar Accidente
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                
                <a href="#" class="nav-link">
                    <i class="fas fa-hourglass-half"></i> Estado de Solicitudes
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-list"></i> Historial
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container-fluid pt-4">
                <div class="content-card">
                    <h2>Panel de Control</h2>
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Custom Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarToggle = document.getElementById('sidebarToggle');
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.querySelector('.main-content');
                const navbar = document.querySelector('.navbar');

                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    sidebar.classList.toggle('show');
                    if (window.innerWidth > 768) {
                        mainContent.classList.toggle('collapsed');
                        navbar.classList.toggle('collapsed');
                    } else {
                        mainContent.style.marginLeft = '0';
                        navbar.style.left = '0';
                        navbar.style.width = '100%';
                    }
                });

                // Highlight active link
                const currentPath = window.location.pathname;
                document.querySelectorAll('.nav-link').forEach(link => {
                    if (link.getAttribute('href') === currentPath) {
                        link.classList.add('active');
                        const accordionBody = link.closest('.accordion-collapse');
                        if (accordionBody) {
                            accordionBody.classList.add('show');
                            const accordionButton = document.querySelector(`button[data-bs-target="#${accordionBody.id}"]`);
                            if (accordionButton) {
                                accordionButton.classList.remove('collapsed');
                                accordionButton.setAttribute('aria-expanded', 'true');
                            }
                        }
                    }
                });

                // Smooth scroll for sidebar
                sidebar.addEventListener('wheel', function(e) {
                    if (this.scrollHeight > this.clientHeight) {
                        e.preventDefault();
                        this.scrollTop += e.deltaY;
                    }
                });
            });
        </script>
    </body>
</html>