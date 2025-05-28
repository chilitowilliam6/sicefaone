<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion SST - Innovación en Seguridad</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-blue: #003087; /* Deep, professional blue */
            --secondary-gray: #4B5EAA; /* Soft gray-blue for accents */
            --light-bg: #F8FAFC; /* Clean, light background */
            --dark-bg: #1A2A44; /* Dark, formal sidebar background */
            --accent-blue: #2563EB; /* Vibrant but professional accent */
            --text-primary: #1F2937; /* Dark text for readability */
            --text-light: #FFFFFF; /* White text for dark backgrounds */
            --border-color: #E5E7EB; /* Subtle border color */
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: var(--text-primary);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--dark-bg);
            padding: 20px 0;
            box-shadow: var(--shadow);
            transition: width 0.3s ease, transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: var(--primary-blue);
            border-bottom: 1px solid var(--accent-blue);
        }

        .sidebar-header h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-light);
            margin: 0;
            letter-spacing: 1px;
        }

        .user-info {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            transition: transform 0.3s ease;
        }

        .user-info img:hover {
            transform: scale(1.05);
        }

        .user-info span {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
            display: block;
            margin-top: 10px;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            color: var(--text-light) !important;
            padding: 12px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background 0.3s ease, padding-left 0.3s ease;
            border-radius: 6px;
            margin: 0 10px;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-blue);
            color: var(--text-light) !important;
            padding-left: 25px;
        }

        .accordion-button {
            background: transparent !important;
            color: var(--text-light) !important;
            font-weight: 500;
            padding: 12px 20px;
            border: none;
            font-size: 0.95rem;
            transition: background 0.3s ease;
        }

        .accordion-button::after {
            filter: brightness(1.5);
        }

        .accordion-button:not(.collapsed) {
            background: rgba(37, 99, 235, 0.1) !important;
            color: var(--text-light) !important;
        }

        .accordion-collapse {
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--accent-blue);
        }

        .accordion-body .nav-link {
            padding-left: 40px;
            font-size: 0.9rem;
        }

        /* Navbar */
        .navbar {
            background: var(--primary-blue);
            box-shadow: var(--shadow);
            padding: 1rem;
            position: fixed;
            width: calc(100% - 280px);
            z-index: 1100;
            transition: width 0.3s ease;
        }

        .navbar .btn {
            color: var(--text-light);
            font-size: 1.3rem;
        }

        .navbar .btn:hover {
            color: var(--accent-blue);
        }

        .navbar-text {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 80px 20px 20px;
            min-height: 100vh;
            background: var(--light-bg);
            transition: margin-left 0.3s ease;
        }

        .content-card {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }
            .sidebar.show {
                transform: translateX(0);
                width: 100%;
            }
            .main-content {
                margin-left: 0;
            }
            .navbar {
                width: 100%;
            }
        }

        /* Animations */
        .nav-link, .accordion-button, .btn {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white" id="sidebarToggle">
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
                                    <i class="fas fa-bone"></i> Lesiones
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Lista de Tipos
                                    </a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link">
                                        <i class="far fa-circle"></i> Crear Tipos
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse" aria-expanded="false" aria-controls="riesgosCollapse">
                                    <i class="fas fa-biohazard"></i> Riesgos
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
                                    <i class="fas fa-car-crash"></i> Tipos Accidentes
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
                                <i class="fas fa-ambulance"></i> Accidentes
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

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebar.classList.toggle('collapsed');
                if (window.innerWidth > 768) {
                    mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '280px';
                } else {
                    mainContent.style.marginLeft = '0';
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