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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #f5f6f5;
            --accent-color: #2a6cff;
            --text-color: #333333;
            --sidebar-bg: linear-gradient(180deg,rgb(233, 233, 233) 0%, #2a3a5a 100%);
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-width: 260px;
            --sidebar-close-width: 78px;
            --icon-hover-glow: 0 0 8px rgba(42, 108, 255, 0.5);
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: #ffffff;
            transition: all 0.5s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.close {
            width: var(--sidebar-close-width);
        }

        .sidebar .logo-details {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .logo-details .icon {
            font-size: 2rem;
            color: #fff;
        }

        .sidebar .logo-details .logo_name {
            font-size: 20px;
            font-weight: 600;
            margin-left: 10px;
            transition: all 0.5s ease;
        }

        .sidebar.close .logo-details .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar .nav-links {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar .nav-links li {
            position: relative;
            margin: 8px 0;
        }

        .sidebar .nav-links li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-links li a:hover,
        .sidebar .nav-links li a.active {
            background: var(--accent-color);
            box-shadow: var(--icon-hover-glow);
        }

        .sidebar .nav-links li i {
            min-width: 45px;
            text-align: center;
            font-size: 1.3rem;
        }

        .sidebar .nav-links li .sub-menu {
            display: none;
            list-style: none;
            padding: 0;
            margin: 0;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 0 0 6px 6px;
        }

        .sidebar .nav-links li .sub-menu li a {
            padding-left: 60px;
            font-size: 0.9rem;
        }

        .sidebar .nav-links li.showMenu .sub-menu {
            display: block;
        }

        .sidebar .nav-links li .sub-menu li a:hover {
            background: var(--accent-color);
        }

        .sidebar.close .nav-links li .sub-menu {
            position: absolute;
            left: 100%;
            top: -10px;
            margin-top: 0;
            padding: 10px 0;
            border-radius: 0 6px 6px 0;
            opacity: 0;
            display: block;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .sidebar.close .nav-links li:hover .sub-menu {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar.close .nav-links li .nav-text,
        .sidebar.close .nav-links li .arrow {
            display: none;
        }

        .sidebar .nav-links li .arrow {
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .sidebar .nav-links li.showMenu .arrow {
            transform: rotate(-180deg);
        }

        .sidebar.close .nav-links li a {
            justify-content: center;
            padding: 12px;
        }

        .sidebar.close .nav-links li i {
            font-size: 1.5rem;
        }

        .sidebar .profile-details {
            position: relative;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .sidebar .profile-details img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .sidebar .profile-details .name {
            font-size: 1rem;
            font-weight: 500;
        }

        .sidebar.close .profile-details .name {
            display: none;
        }

        .toggle {
            position: absolute;
            top: 20px;
            right: -20px;
            transform: translateY(-50%) rotate(180deg);
            height: 35px;
            width: 35px;
            background: var(--accent-color);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .sidebar.close .toggle {
            transform: translateY(-50%) rotate(0deg);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.5s ease;
            min-height: calc(100vh - 60px);
        }

        .main-content.close {
            margin-left: var(--sidebar-close-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
            position: fixed;
            width: 100%;
            top: 0;
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

        footer {
            background-color: var(--footer-bg);
            color: #ffffff;
            padding: 15px 0;
            position: relative;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.5s ease;
        }

        footer.close {
            margin-left: var(--sidebar-close-width);
        }

        footer a {
            color: var(--accent-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.close {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.close {
                margin-left: 0;
            }

            footer {
                margin-left: 0;
            }

            footer.close {
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
    <nav class="sidebar" id="sidebar">
        <header>
            <div class="logo-details">
                <i class='bx bx-shield-alt-2 icon'></i>
                <div class="logo_name">GDF</div>
            </div>
            <i class='bx bx-chevron-right toggle' id="sidebarToggleBtn"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="nav-links">
                    @auth
                        @if (checkRol('sstsena.admin'))
                            <!-- Lesiones -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-bone icon'></i>
                                    <span class="nav-text">Lesiones</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.injury_types.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Tipos</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.injury_types.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipos</span></a></li>
                                </ul>
                            </li>

                            <!-- Riesgos -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-biohazard icon'></i>
                                    <span class="nav-text">Riesgos</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.risk_types.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Tipos</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.risk_types.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo</span></a></li>
                                </ul>
                            </li>

                            <!-- Accidentes -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-car icon'></i>
                                    <span class="nav-text">Tipos Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.accident_types.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Tipos</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.accident_types.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo</span></a></li>
                                </ul>
                            </li>

                            <!-- Tipo de persona -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-group icon'></i>
                                    <span class="nav-text">Tipo de persona</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.TypePerson.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista Personas</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.TypePerson.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo Persona</span></a></li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-error icon'></i>
                                    <span class="nav-text">Tipo de Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.incident_types.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Incidentes</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.incident_types.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo de Incidente</span></a></li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="nav-text">Tipo de Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.emergency_type.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Emergencias</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.emergency_type.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo de Emergencia</span></a></li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.admin.unsafe_act_types.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Tipo Actos Inseguros</span></a></li>
                                    <li><a href="{{ route('sstsena.admin.unsafe_act_types.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Crear Tipo</span></a></li>
                                </ul>
                            </li>
                        @endif

                        @if (checkRol('sstsena.funcionario'))
                            <!-- Accidentes -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-ambulance icon'></i>
                                    <span class="nav-text">Accidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.funcionario.accidents.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Accidentes</span></a></li>
                                    <li><a href="{{ route('sstsena.funcionario.accidents.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Reportar Accidente</span></a></li>
                                </ul>
                            </li>

                            <!-- Personas Involucradas -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-user-check icon'></i>
                                    <span class="nav-text">Personas Involucradas</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.funcionario.people_involved.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Personas Involucradas</span></a></li>
                                    <li><a href="{{ route('sstsena.funcionario.people_involved.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Agregar Persona Involucrada</span></a></li>
                                </ul>
                            </li>

                            <!-- Incidentes -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-error-circle icon'></i>
                                    <span class="nav-text">Incidentes</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.funcionario.incidents.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Incidentes</span></a></li>
                                    <li><a href="{{ route('sstsena.funcionario.incidents.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Reportar Incidente</span></a></li>
                                </ul>
                            </li>

                            <!-- Emergencias -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-first-aid icon'></i>
                                    <span class="nav-text">Emergencias</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.funcionario.emergencies.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Emergencias</span></a></li>
                                    <li><a href="{{ route('sstsena.funcionario.emergencies.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Reportar Emergencia</span></a></li>
                                </ul>
                            </li>

                            <!-- Actos Inseguros -->
                            <li class="nav-link">
                                <a href="#" class="side-link">
                                    <i class='bx bx-shield-x icon'></i>
                                    <span class="nav-text">Actos Inseguros</span>
                                    <i class='bx bx-chevron-down arrow icon'></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}"><i class='bx bx-list-ul icon'></i><span class="nav-text">Lista de Actos Inseguros</span></a></li>
                                    <li><a href="{{ route('sstsena.funcionario.unsafe_acts.create') }}"><i class='bx bx-plus icon'></i><span class="nav-text">Reportar Actos Inseguros</span></a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth

                    <!-- Links generales -->
                    <li class="nav-link">
                        <a href="{{ route('events.index') }}" class="side-link">
                            <i class='bx bx-time-five icon'></i>
                            <span class="nav-text">Respuesta de eventos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#" class="side-link">
                            <i class='bx bx-hourglass icon'></i>
                            <span class="nav-text">Estado de Solicitudes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#" class="side-link">
                            <i class='bx bx-history icon'></i>
                            <span class="nav-text">Historial</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <div class="profile-details">
                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" alt="Usuario" loading="lazy">
                    <span class="name">@auth {{ auth()->user()->name }} @endauth</span>
                </div>
            </div>
        </div>
    </nav>

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
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

            // Toggle sidebar
            const toggleSidebar = () => {
                sidebar.classList.toggle('close');
                mainContent.classList.toggle('close');
                footer.classList.toggle('close');
            };

            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarToggleBtn.addEventListener('click', toggleSidebar);

            // Close sidebar on click outside for mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && !e.target.closest('#sidebar') && !e.target.closest('#sidebarToggle') && !e.target.closest('#sidebarToggleBtn')) {
                    sidebar.classList.add('close');
                    mainContent.classList.add('close');
                    footer.classList.add('close');
                }
            });

            // Sub-menu toggle
            document.querySelectorAll('.nav-link .side-link').forEach(link => {
                if (link.nextElementSibling && link.nextElementSibling.classList.contains('sub-menu')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const parentLi = link.parentElement;
                        parentLi.classList.toggle('showMenu');

                        // Close other open sub-menus
                        document.querySelectorAll('.nav-link.showMenu').forEach(item => {
                            if (item !== parentLi) {
                                item.classList.remove('showMenu');
                            }
                        });
                    });
                }
            });

            // Highlight active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-links a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    const parentSubMenu = link.closest('.sub-menu');
                    if (parentSubMenu) {
                        const parentLi = parentSubMenu.parentElement;
                        parentLi.classList.add('showMenu');
                        parentLi.querySelector('.side-link').classList.add('active');
                    }
                }
            });
        });
    </script>
</body>

</html>