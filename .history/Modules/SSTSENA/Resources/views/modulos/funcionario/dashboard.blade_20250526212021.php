@extends('sstsena::layouts.master')

@section('content')
<style>
    /* Custom styles for a modern, dynamic look */
    .welcome-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .welcome-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
    .btn-primary {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #14315a !important;
        transform: scale(1.05);
    }
    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .highlight-text {
        color: #1a3c6e;
        font-weight: 600;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm rounded-3 welcome-card" style="background-color: #ffffff;">
        <div class="card-header text-center" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h1 class="display-5" style="color: #1a3c6e; font-weight: 600;">Bienvenido al Dashboard del Funcionario</h1>
            <p class="text-muted mb-0" style="font-size: 1.1rem;">Centro de Formación Agroindustrial La Angostura</p>
        </div>
        <div class="card-body p-5 fade-in">
            <p style="color: #34495e; font-size: 1.2rem; line-height: 1.6;">
                Estimado/a Funcionario/a o Instructor/a,<br><br>
                Nos complace darle la bienvenida al <strong class="highlight-text">Sistema de Gestión de Seguridad</strong> del <strong class="highlight-text">Centro de Formación Agroindustrial La Angostura</strong>. Este panel ha sido diseñado para empoderarlo/a en su rol crítico de garantizar un entorno seguro y productivo. Desde aquí, usted podrá reportar y gestionar <strong>accidentes, incidentes, emergencias y actos inseguros</strong> con precisión y eficiencia, contribuyendo directamente a la seguridad y excelencia operativa de nuestro centro.<br><br>
                Su compromiso con la vigilancia y el registro oportuno de eventos es esencial para fomentar una cultura de prevención y mejora continua. Utilice las herramientas avanzadas de este sistema para cumplir con sus responsabilidades y elevar los estándares de seguridad que nos distinguen. ¡Juntos, construyamos un futuro más seguro!
            </p>
            <div class="d-flex justify-content-center gap-3 mt-5">
                <a href="" class="btn btn-primary px-5 py-2" style="background-color: #1a3c6e; border-color: #1a3c6e; font-size: 1.1rem;">Iniciar Reporte</a>
                <a href="" class="btn btn-outline-secondary px-5 py-2" style="border-color: #6c757d; color: #34495e;">Explorar Funciones</a>
            </div>
        </div>
    </div>
</div>
@endsection