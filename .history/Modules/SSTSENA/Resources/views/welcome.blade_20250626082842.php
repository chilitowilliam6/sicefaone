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
      <img src="{{ asset('SSTSENA/images/logosena.png') }}" alt="Logo" class="w-12 h-12 md:w-16 md:h-14 object-contain" />
      <h1 class="text-lg md:text-2xl font-bold text-gray-700">Sistema de Gestión SST</h1>
    </div>

    <!-- Botón hamburguesa -->
    <button id="menu-toggle" class="md:hidden text-3xl text-gray-600 focus:outline-none">
      <i class="bi bi-list"></i>
    </button>

    <!-- Menú principal -->
    <nav id="menu" class="hidden md:flex flex-col md:flex-row md:items-center gap-4 md:gap-6 text-sm font-medium text-gray-600 absolute md:static top-20 right-4 bg-white md:bg-transparent shadow md:shadow-none p-4 md:p-0 rounded-md md:rounded-none">
    @auth
          @if (checkRol('sstsena.admin'))
              <li>
                  <a class="hover:text-orange-500 transition" href="{{ route('sstsena.admin.welcome') }}">Administrador</a> 
              </li>
          @endif
          @if (checkRol('sstsena.funcionario'))
              <li>
                  <a class="hover:text-orange-500 transition" href="{{ route('sstsena.funcionario.welcome') }}">Funcionario</a> 
              </li>
          @endif
                          
    @endauth   
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
      <rect fi