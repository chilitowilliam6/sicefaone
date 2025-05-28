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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-blue: #0052cc; /* Vibrant professional blue */
            --accent-neon: #00ff88; /* Futuristic neon green */
            --dark-space: #0a1a2f; /* Deep space background */
            --light-surface: #f5f7fa; /* Clean light surface */
            --warning-orange: #ff6f00; /* Bold warning orange */
            --text-primary: #ffffff; /* White text for contrast */
            --text-secondary: #d1d5db; /* Soft gray for secondary text */
            --glow-effect: 0 0 10px rgba(0, 255, 136, 0.5); /* Neon glow */
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(145deg, var(--primary-blue), var(--dark-space));
            color: var(--text-primary);
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
            transition: background 0.5s ease;
        }

        /* Sidebar */
        .sidebar {
            width: 300px;
            height: 100vh;
            position: fixed;
            background: var(--dark-space);
            padding-top: 20px;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.4);
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
            background: linear-gradient(90deg, var(--accent-neon), var(--primary-blue));
            border-bottom: 2px solid var(--accent-neon);
        }

        .sidebar-header h4 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 3px;
            margin: 0;
            text-transform: uppercase;
            color: var(--text-primary);
        }

        .user-info {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--primary-blue);
        }

        .user-info img {
            border: 3px solid var(--accent-neon);
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .user-info img:hover {
            transform: scale(1.1);
        }

        .nav-item {
            position: relative;
            margin: 5px 0;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            padding: 12px 20px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 10px;
        }

        .nav-link i {
            margin-right: 15px;
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-neon);
            color: var(--dark-space) !important;
            box-shadow: var(--glow-effect);
            transform: translateX(5px);
        }

        .nav-link:hover i {
            transform: rotate(10deg);
        }

        .accordion-button {
            background: transparent !important;
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 12px 20px;
            border: none;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .accordion-button::after {
            background: var(--accent-neon);
            border-radius: 50%;
            width: 12px;
            height: 12px;
        }

        .accordion-button:not(.collapsed) {
            background: rgba(0, 255, 136, 0.2) !important;
            color: var(--text-primary) !important;
        }

        .accordion-collapse {
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--primary-blue);
        }

        .accordion-body .nav-link {
            padding-left: 40px;
            font-size: 0.95rem;
            color: var(--text-secondary) !important;
        }

        .accordion-body .nav-link:hover {
            background: rgba(0, 255, 136, 0.3);
            color: var(--text-primary) !important;
        }

        /* Navbar */
        .navbar {
            background: rgba(10, 26, 47, 0.95);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 0.75rem 1rem;
            position: fixed;
            width: calc(100% - 300px);
            z-index: 1100;
            transition: width 0.3s ease;
        }

        .navbar .btn {
            color: var(--text-primary);
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .navbar .btn:hover {
            transform: scale(1.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 300px;
            padding: 80px 20px 20px;
            min-height: 100vh;
            background: var(--light-surface);
            color: var(--dark-space);
            border-radius: 15px 0 0 0;
            transition: margin-left 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-300px);
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
        @keyframes neon-pulse {
            0%, 100% { box-shadow: var(--glow-effect); }
            50% { box-shadow: 0 0 20px rgba(0, 255, 136, 0.8); }
        }

        .nav-link:hover {
            animation: neon-pulse 1s infinite;
        }

        .sidebar-header:hover {
            animation: neon-pulse 1.5s infinite;
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
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" width="50" height="50" alt="Usuario" loading="lazy">
            <span class="d-block mt-2">@auth {{ auth()->user()->name }} @endauth</span>
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
        <div class="container-fluid pt-5 mt-3">
            @yield('content')
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
                    mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '300px';
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

            // Dynamic hover effects
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.animation = 'neon-pulse 1s infinite';
                });
                link.addEventListener('mouseleave', function() {
                    this.style.animation = '';
                });
            });
        });
    </script>
</body>
</html>