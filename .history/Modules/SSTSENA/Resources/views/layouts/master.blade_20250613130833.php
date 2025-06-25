<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion SST</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary: #1e3a8a;
            --secondary: #f8fafc;
            --accent: #3b82f6;
            --text: #1f2937;
            --sidebar-bg: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            --sidebar-width: 280px;
            --sidebar-collapsed: 64px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--secondary); color: var(--text); }
        .preloader {
            position: fixed; inset: 0; background: #fff; z-index: 9999; display: flex; justify-content: center; align-items: center;
            opacity: 1; transition: opacity 0.5s ease;
        }
        .preloader.loaded { opacity: 0; pointer-events: none; }
        .sidebar {
            width: var(--sidebar-width); height: 100vh; position: fixed; background: var(--sidebar-bg); color: #fff;
            transition: var(--transition); box-shadow: var(--shadow); overflow-y: auto; z-index: 1000;
        }
        .sidebar.collapsed { width: var(--sidebar-collapsed); }
        .main-content {
            margin-left: var(--sidebar-width); padding: 24px; min-height: calc(100vh - 64px); transition: var(--transition);
        }
        .main-content.collapsed { margin-left: var(--sidebar-collapsed); }
        .navbar {
            background: #fff; box-shadow: var(--shadow); padding: 12px 16px; position: fixed; width: 100%; z-index: 1100;
        }
        .sidebar-header {
            padding: 16px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-header a { color: #fff; font-size: 1.5rem; font-weight: 600; text-decoration: none; }
        .user-info {
            padding: 16px; display: flex; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar.collapsed .user-info span, .sidebar.collapsed .sidebar-header a span { display: none; }
        .nav-link {
            color: rgba(255, 255, 255, 0.9); padding: 12px 16px; display: flex; align-items: center; border-radius: 8px;
            margin: 4px 8px; transition: var(--transition); font-size: 0.95rem;
        }
        .nav-link:hover, .nav-link.active { background: var(--accent); color: #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); }
        .sidebar.collapsed .nav-link { justify-content: center; }
        .sidebar.collapsed .nav-link span { display: none; }
        .sidebar.collapsed .nav-link i { margin: 0; font-size: 1.25rem; }
        .accordion-button {
            background: transparent !important; color: #fff !important; padding: 12px 16px; font-weight: 500;
            display: flex; align-items: center; border-radius: 8px; transition: var(--transition);
        }
        .accordion-button:not(.collapsed) { background: var(--accent) !important; }
        .sidebar.collapsed .accordion-button { justify-content: center; }
        .sidebar.collapsed .accordion-button span, .sidebar.collapsed .accordion-body { display: none; }
        .accordion-body .nav-link { padding-left: 32px; font-size: 0.9rem; }
        .sidebar.collapsed .nav-link:hover::after {
            content: attr(data-label); position: absolute; left: calc(var(--sidebar-collapsed) + 12px); background: var(--accent);
            color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; z-index: 1001; white-space: nowrap;
        }
        footer {
            background: var(--primary); color: #fff; padding: 16px; margin-left: var(--sidebar-width); transition: var(--transition);
            text-align: center; font-size: 0.9rem;
        }
        footer.collapsed { margin-left: var(--sidebar-collapsed); }
        @media (max-width: 768px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); }
            .sidebar.show { left: 0; }
            .main-content, footer { margin-left: 0; }
            .main-content.collapsed, footer.collapsed { margin-left: 0; }
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
            <button class="btn btn-link text-dark" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="d-flex align-items-center">
                <!-- Notificaciones -->
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge rounded-pill bg-warning position-absolute top-0 start-100 translate-middle">15</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
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
                    <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="text-decoration-none">GDF</a>
        </div>
        <div class="user-info">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2" width="36" height="36" alt="Usuario" loading="lazy">
            <span>@auth {{ auth()->user()->name }} @endauth</span>
        </div>
        <nav class="nav flex-column p-2">
            @auth
                @if (checkRol('sstsena.admin'))
                    <div class="accordion" id="menuAccordion">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#lesionesCollapse" data-label="Lesiones">
                                    <i class="fas fa-bone me-2"></i><span>Lesiones</span>
                                </button>
                            </h2>
                            <div id="lesionesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="nav-link" data-label="Lista de Tipos"><i class="far fa-circle me-2"></i><span>Lista de Tipos</span></a>
                                    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="nav-link" data-label="Crear Tipos"><i class="far fa-circle me-2"></i><span>Crear Tipos</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#riesgosCollapse" data-label="Riesgos">
                                    <i class="fas fa-biohazard me-2"></i><span>Riesgos</span>
                                </button>
                            </h2>
                            <div id="riesgosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.risk_types.index') }}" class="nav-link" data-label="Lista de Tipos"><i class="far fa-circle me-2"></i><span>Lista de Tipos</span></a>
                                    <a href="{{ route('sstsena.admin.risk_types.create') }}" class="nav-link" data-label="Crear Tipo"><i class="far fa-circle me-2"></i><span>Crear Tipo</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accidentesCollapse" data-label="Tipos Accidentes">
                                    <i class="fas fa-car-crash me-2"></i><span>Tipos Accidentes</span>
                                </button>
                            </h2>
                            <div id="accidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="nav-link" data-label="Lista de Tipos"><i class="far fa-circle me-2"></i><span>Lista de Tipos</span></a>
                                    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="nav-link" data-label="Crear Tipo"><i class="far fa-circle me-2"></i><span>Crear Tipo</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#personasCollapse" data-label="Tipo de persona">
                                    <i class="fas fa-users me-2"></i><span>Tipo de persona</span>
                                </button>
                            </h2>
                            <div id="personasCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.TypePerson.index') }}" class="nav-link" data-label="Lista Personas"><i class="far fa-circle me-2"></i><span>Lista Personas</span></a>
                                    <a href="{{ route('sstsena.admin.TypePerson.create') }}" class="nav-link" data-label="Crear Tipo Persona"><i class="far fa-circle me-2"></i><span>Crear Tipo Persona</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#incidentesCollapse" data-label="Tipo de Incidentes">
                                    <i class="fas fa-exclamation-triangle me-2"></i><span>Tipo de Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.incident_types.index') }}" class="nav-link" data-label="Lista de Incidentes"><i class="far fa-circle me-2"></i><span>Lista de Incidentes</span></a>
                                    <a href="{{ route('sstsena.admin.incident_types.create') }}" class="nav-link" data-label="Crear Tipo de Incidente"><i class="far fa-square me-2"></i><span>Crear Tipo de Incidente</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#emergenciasCollapse" data-label="Tipo de Emergencias">
                                    <i class="fas fa-first-aid me-2"></i><span>Tipo de Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciasCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.emergency_type.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                        <i class="fas fa-first-aid me-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="nav-link" data-label="Crear Tipo de Emergencia">
                                        <i class="fas fa-first-aid me-2"></i><span>Crear Tipo de Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#actosinsegurosCollapse" data-label="Actos Inseguros">
                                    <i class="fas fa-car-crash me-2"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosinsegurosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.index') }}" class="nav-link" data-label="Tipo Actos Inseguros">
                                        <i class="far fa-circle me-2"></i><span>Tipo Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="nav-link" data-label="Crear Tipo">
                                        <i class="far fa-circle me-2"></i><span>Crear Tipo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (checkRol('sstsena.funcionario'))
                    <div class="accordion-item border-0 bg-transparent">
                        <div class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#reportesCollapse" data-label="Accidentes">
                                <i class="fas fa-ambulance me-2"></i><span>Accidentes</span>
                            </button>
                        </h2>
                        <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                            <div class="accordion-body p-0">
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="nav-link" data-label="Lista de Accidentes">
                                    <i class="far fa-circle me-2"></i><span>Lista de Accidentes</span>
                                </a>
                                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="nav-link" data-label="Reportar Accidente">
                                    <i class="far fa-circle me-2"></i><span>Reportar Accidente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#reportesCollapse" data-label="Personas Involucradas">
                                    <i class="fas fa-ambulance me-2"></i><span>Personas Involucradas</span>
                                </button>
                            </h2>
                            <div id="reportesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.personas_involved.index') }}" class="nav-link" data-label="Lista de Personas Involucradas">
                                        <i class="far fa-circle me-2"></i><span>Lista de Personas Involucradas</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.personas_involved.create') }}" class="nav-link" data-label="Crear Personas Involucradas">
                                        <i class="far fa-circle me-2"></i><span>Crear Personas Involucradas</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#incidentsCollapse" data-label="Incidentes">
                                    <i class="fas fa-exclamation-triangle me-2"></i><span>Incidentes</span>
                                </button>
                            </h2>
                            <div id="incidentsCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="nav-link" data-label="Lista de Incidentes">
                                        <i class="far fa-circle me-2"></i><span>Lista de Incidentes</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="nav-link" data-label="Reportar Incidente">
                                        <i class="far fa-circle me-2"></i><span>Reportar Incidente</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#emergenciesCollapse" data-label="Emergencias">
                                    <i class="fas fa-first-aid me-2"></i><span>Emergencias</span>
                                </button>
                            </h2>
                            <div id="emergenciesCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.emergencies.index') }}" class="nav-link" data-label="Lista de Emergencias">
                                        <i class="fas fa-first-aid me-2"></i><span>Lista de Emergencias</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.emergencies.create') }}" class="nav-link" data-label="Reportar Emergencia">
                                        <i class="fas fa-first-aid me-2"></i><span>Reportar Emergencia</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#actosCollapse" data-label="Actos Inseguros">
                                    <i class="fas fa-first-aid me-2"></i><span>Actos Inseguros</span>
                                </button>
                            </h2>
                            <div id="actosCollapse" class="accordion-collapse collapse" data-bs-parent="#menuAccordion">
                                <div class="accordion-body p-0">
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}" class="nav-link" data-label="Lista de Actos Inseguros">
                                        <i class="far fa-circle me-2"></i><span>Lista de Actos Inseguros</span>
                                    </a>
                                    <a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}" class="nav-link" data-label="Reportar Actos Inseguros">
                                        <i class="far fa-circle me-2"></i><span>Reportar Actos Inseguros</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <a href="{{ route('events.index') }}" class="nav-link" data-label="Respuesta de eventos"><i class="fas fa-hourglass-half me-2"></i><span>Respuesta de eventos</span></a>
                <a href="#" class="nav-link" data-label="Estado de Solicitudes"><i class="fas fa-hourglass-half me-2"></i><span>Estado de Solicitudes</span></a>
                <a href="#" class="nav-link" data-label="Historial"><i class="fas fa-clipboard-list me-2"></i><span>Historial</span></a>
            </nav>
        </div>

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="container-fluid pt-5 mt-3">@yield('content')</div>
        </main>

        <!-- Footer -->
        <footer>
            <span>Copyright © 2023-2025 <a href="#" class="text-decoration-none text-primary">GDF</a></span>
            <span class="float-end d-none d-sm-inline">Versión 3.2.0</span>
        </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.addEventListener('load', () => {
                setTimeout(() => document.querySelector('.preloader').classList.add('loaded'), 500);
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.querySelector('.main-content');
                const footer = document.querySelector('footer');
                const sidebarToggle = document.getElementById('sidebarToggle');
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('collapsed');
                    footer.classList.toggle('collapsed');
                });
                document.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle')) {
                        sidebar.classList.remove('show');
                        sidebar.classList.add('collapsed');
                        mainContent.classList.remove('collapsed');
                        footer.classList.remove('collapsed');
                    }
                });
                document.querySelectorAll('.nav-link').forEach(link => {
                    if (link.getAttribute('href') === window.location.pathname) {
                        link.classList.add('active');
                        const accordionBody = link.closest('.accordion-collapse');
                        if (accordionBody) {
                            accordionBody.classList.add('show');
                            const accordionButton = document.querySelector(`button[data-bs-target="#${accordionBody.id}"]`);
                            accordionButton?.classList.remove('collapsed');
                            accordionButton?.setAttribute('aria-expanded', 'true');
                        }
                    }
                });
            });
        </script>
    </body>
</html>