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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color:rgb(255, 255, 255); /* Púrpura de la imagen */
            --secondary-color: #f5f6f5;
            --text-color: #ffffff;
            --sidebar-bg: #6a0dad;
            --sidebar-hover-bg:rgb(255, 254, 255);
            --navbar-bg: #ffffff;
            --footer-bg: #1a3c6e;
            --sidebar-collapsed-width: 60px;
            --sidebar-full-width: 250px; /* Ajustado para coincidir con la imagen */
            --icon-hover-glow: 0 0 8px rgba(106, 13, 173, 0.5);
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: var(--sidebar-collapsed-width);
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: var(--text-color);
            transition: width 0.3s ease;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar:hover {
            width: var(--sidebar-full-width);
        }

        .main-content {
            margin-left: var(--sidebar-collapsed-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 60px);
        }

        .sidebar:hover ~ .main-content {
            margin-left: var(--sidebar-full-width);
        }

        .navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            z-index: 1100;
        }

        .nav-link {
            color: var(--text-color);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
            text-decoration: none;
        }

        .sidebar:hover .nav-link {
            justify-content: flex-start;
            padding: 10px 15px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
            background-color: var(--sidebar-hover-bg);
            box-shadow: var(--icon-hover-glow);
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .sidebar:not(:hover) .nav-link span {
            display: none;
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

        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--sidebar-hover-bg);
            color: #ffffff;
        }

        .badge {
            background-color: var(--sidebar-hover-bg) !important;
        }

        footer {
            background-color: var(--footer-bg);
            color: #ffffff;
            padding: 15px 0;
            position: relative;
            margin-inline-start: var(--sidebar-collapsed-width);
            transition: margin-inline-start 0.3s ease;
        }

        .sidebar:hover ~ footer {
            margin-inline-start: var(--sidebar-full-width);
        }

        footer a {
            color: var(--sidebar-hover-bg);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-inline-size: 768px) {
            .sidebar {
                margin-inline-start: calc(-1 * var(--sidebar-full-width));
                z-index: 1000;
            }

            .sidebar:hover {
                margin-inline-start: 0;
                width: var(--sidebar-full-width);
            }

            .main-content {
                margin-inline-start: 0;
                padding: 15px;
            }

            footer {
                margin-inline-start: 0;
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
    <div class="sidebar" id="sidebar">
        <div class="p-3 text-center border-bottom">
            <a href="#" class="text-white text-decoration-none h5 mb-0">EVS Electronic voting</a>
        </div>

        <nav class="nav flex-column p-2">
            <a href="#" class="nav-link" data-label="Bienvenido">
                <i class="fas fa-user"></i><span>Bienvenido</span> <i class="fas fa-angle-right ms-auto"></i>
            </a>
            <a href="#" class="nav-link" data-label="Acceso">
                <i class="fas fa-sign-in-alt"></i><span>Acceso</span>
            </a>
            <a href="#" class="nav-link" data-label="Bienvenimvel">
                <i class="fas fa-user"></i><span>Bienvenimvel</span>
            </a>
            <a href="#" class="nav-link" data-label="Acceso">
                <i class="fas fa-sign-in-alt"></i><span>Acceso</span>
            </a>
            <a href="#" class="nav-link" data-label="Volver a Laravel">
                <i class="fas fa-reply"></i><span>Volver a Laravel</span>
            </a>
            <a href="#" class="nav-link" data-label="Votar">
                <i class="fas fa-vote-yea"></i><span>Votar</span>
            </a>
            <a href="#" class="nav-link" data-label="Normativity">
                <i class="fas fa-book"></i><span>Normativity</span>
            </a>
            <a href="#" class="nav-link" data-label="Voting results">
                <i class="fas fa-chart-bar"></i><span>Voting results</span>
            </a>
            <a href="#" class="nav-link" data-label="Developers">
                <i class="fas fa-users"></i><span>Developers</span>
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