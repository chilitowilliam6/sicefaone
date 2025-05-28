@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h1 class="text-center" style="color: #1a3c6e; font-weight: 600;">Bienvenido al Dashboard del Funcionario</h1>
        </div>
        <div class="card-body p-4">
            <p style="color: #34495e; font-size: 1.1rem;">
                Estimado Funcionario o Instructor del <strong>Centro de Formación Agroindustrial La Angostura</strong>,<br><br>
                Es un placer darle la bienvenida a su espacio de gestión. Desde este panel, usted podrá reportar y gestionar de manera eficiente accidentes, incidentes, emergencias y actos inseguros, contribuyendo a la seguridad y el bienestar de nuestra comunidad formativa. Su compromiso con la identificación y registro de estos eventos es fundamental para garantizar un entorno de aprendizaje seguro y productivo. Por favor, utilice las herramientas disponibles para cumplir con sus responsabilidades y mantener los estándares de seguridad del centro.
            </p>
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('sstsena.admin.reports.create') }}" class="btn btn-primary px-4" style="background-color: #1a3c6e; border-color: #1a3c6e;">Iniciar Reporte</a>
            </div>
        </div>
    </div>
</div>
@endsection