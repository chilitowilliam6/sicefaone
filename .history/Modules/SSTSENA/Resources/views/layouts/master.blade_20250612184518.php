<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ... (el head se mantiene igual) ... -->
    <style>
        /* Agregar estas nuevas reglas CSS */
        .sidebar-collapsed {
            width: 80px !important;
            overflow: hidden;
        }
        
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar-collapsed .accordion-button::after {
            display: none;
        }
        
        .sidebar-collapsed .nav-link {
            padding: 10px;
            text-align: center;
        }
        
        .sidebar-collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.2rem;
        }
        
        .sidebar-collapsed .accordion-body {
            display: none;
        }
        
        .main-content-expanded {
            margin-left: 80px !important;
        }
        
        /* Ajustar el footer también */
        footer {
            transition: margin-inline-start 0.3s ease;
        }
        
        .footer-collapsed {
            margin-inline-start: 80px !important;
        }
    </style>
</head>
<body>
    <!-- ... (el preloader y navbar se mantienen igual) ... -->

    <!-- Sidebar - Agregar clase para manejar texto -->
    <div class="sidebar" id="sidebar">
        <div class="p-3 text-center border-bottom">
            <a href="#" class="text-white text-decoration-none h5 mb-0 sidebar-text">GDF</a>
        </div>

        <div class="p-3 d-flex align-items-center border-bottom">
            <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="rounded-circle me-2"
                width="40" height="40" alt="Usuario" loading="lazy">
            <span class="text-white sidebar-text">@auth {{ auth()->user()->name }} @endauth</span>
        </div>

        <nav class="nav flex-column p-2">
            <!-- ... (el contenido del sidebar se mantiene igual, pero agregar clase sidebar-text a los textos) ... -->
            <!-- Ejemplo de modificación para un elemento: -->
            <a href="{{ route('events.index')}}" class="nav-link">
                <i class="fas fa-hourglass-half me-2"></i>
                <span class="sidebar-text">Respuesta de eventos</span>
            </a>
            <!-- Repetir para todos los textos que deben ocultarse -->
        </nav>
    </div>

    <!-- ... (el main content y footer se mantienen igual) ... -->

    <script>
        window.addEventListener('load', function() {
            // ... (código existente se mantiene) ...
            
            // Modificar el evento del botón sidebarToggle
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.querySelector('.main-content');
                const footer = document.querySelector('footer');
                
                sidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('main-content-expanded');
                footer.classList.toggle('footer-collapsed');
                
                // Guardar el estado en localStorage
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });
            
            // Verificar estado guardado al cargar la página
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                document.getElementById('sidebar').classList.add('sidebar-collapsed');
                document.querySelector('.main-content').classList.add('main-content-expanded');
                document.querySelector('footer').classList.add('footer-collapsed');
            }
            
            // ... (el resto del código se mantiene igual) ...
        });
    </script>
</body>
</html>