<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800">

<!-- Header fijo -->
<header class="fixed top-0 w-full bg-white shadow z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="{{ asset('images/logosena.png') }}" alt="Logo" class="w-12 h-12 md:w-16 md:h-14 object-contain" />
      <h1 class="text-lg md:text-2xl font-bold text-gray-700">Sistema de Gestión SST</h1>
    </div>

    <!-- Botón hamburguesa -->
    <button id="menu-toggle" class="md:hidden text-3xl text-gray-600 focus:outline-none">
      <i class="bi bi-list"></i>
    </button>

    <!-- Menú principal -->
    <nav id="menu" class="hidden md:flex flex-col md:flex-row md:items-center gap-4 md:gap-6 text-sm font-medium text-gray-600 absolute md:static top-20 right-4 bg-white md:bg-transparent shadow md:shadow-none p-4 md:p-0 rounded-md md:rounded-none">
      @if (Route::has('login'))
        <a class="hover:text-orange-500 transition" href="{{ route('login') }}">{{ __('Login') }}</a>
      @endif
      <a href="#" class="hover:text-orange-500 transition">Reportes</a>
      <a href="#" class="hover:text-orange-500 transition">Contacto</a>
    </nav>
  </div>
</header>

<!-- Script para abrir/cerrar menú -->
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('menu');

  menuToggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>

<!-- CONTENIDO PRINCIPAL -->
<main class="relative pt-32 pb-24 bg-gradient-to-br from-white via-gray-100 to-white">
  <div class="absolute inset-0 pointer-events-none">
    <svg class="absolute top-0 left-0 w-80 h-80 opacity-10" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
      <circle fill="#fb923c" cx="100" cy="100" r="100"/>
    </svg>
    <svg class="absolute bottom-0 right-0 w-64 h-64 opacity-10" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
      <rect fill="#60a5fa" width="200" height="200"/>
    </svg>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center z-10">
    <!-- Texto -->
    <div class="space-y-6 text-center md:text-left">
      <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
        Protección laboral con <span class="text-orange-500">tecnología e innovación</span>
      </h2>
      <p class="text-lg text-gray-600">
        Transformamos datos en estrategias para un entorno de trabajo más seguro, saludable y productivo. Bienvenido al futuro de la gestión en SST.
      </p>
      <div class="flex flex-col sm:flex-row flex-wrap justify-center md:justify-start gap-4">
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition">
          <i class="bi bi-bar-chart-line-fill"></i> Ver Reportes
        </a>
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 border border-orange-500 text-orange-600 rounded-lg font-semibold hover:bg-orange-100 transition">
          <i class="bi bi-info-circle-fill"></i> Saber más
        </a>
      </div>
    </div>

    <!-- Imagen -->
    <div class="relative">
      <div class="rounded-3xl shadow-xl ring-2 ring-orange-200 overflow-hidden transform hover:scale-105 transition duration-500">
        <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo" class="w-full h-full object-cover" />
      </div>
      <div class="absolute bottom-4 left-4 bg-white/90 text-gray-700 px-4 py-2 rounded-xl shadow backdrop-blur-sm text-sm">
        Innovando en prevención y bienestar laboral en el SENA.
      </div>
    </div>
  </div>
</main>

<!-- SECCIÓN DE MÉTRICAS -->
<section class="bg-white py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
    <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">
      Indicadores clave del sistema SST
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <div class="flex flex-col items-center">
        <i class="bi bi-file-earmark-text-fill text-5xl text-orange-500 mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+3.200</h4>
        <p class="text-gray-600 mt-2">Reportes registrados</p>
      </div>

      <div class="flex flex-col items-center">
        <i class="bi bi-graph-up-arrow text-5xl text-orange-500 mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+1.500</h4>
        <p class="text-gray-600 mt-2">Análisis completados</p>
      </div>

      <div class="flex flex-col items-center">
        <i class="bi bi-person-badge-fill text-5xl text-orange-500 mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+20</h4>
        <p class="text-gray-600 mt-2">Roles activos en el sistema</p>
      </div>
    </div>
  </div>
</section>

<!-- Botón de chat flotante -->
<div class="fixed bottom-24 right-6 z-50">
  <button class="bg-blue-600 hover:bg-black text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition">
    <i class="bi bi-chat-dots fs-4 text-white"></i>
  </button>
</div>

<!-- Footer -->
<footer class="bg-white shadow fixed bottom-0 w-full py-3 border-t z-40">
  <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-600">
    &copy; {{ date('Y') }} SST. Todos los derechos reservados.
  </div>
</footer>

</body>
</html>
