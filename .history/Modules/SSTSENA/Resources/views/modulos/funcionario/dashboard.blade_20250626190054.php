@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4" style="background: linear-gradient(145deg, #ffffff, #f9fbfd); border: none;">
        <div class="card-header py-4" style="background: linear-gradient(to right, #1a3c6e, #2a5298); border-radius: 8px 8px 0 0; border-bottom: none;">
            <h1 class="text-center mb-0" style="color: #ffffff; font-weight: 700; font-size: 1.8rem; letter-spacing: 0.5px;">
                Bienvenido al Panel de Gestión del Funcionario
            </h1>
        </div>
        <div class="card-body p-5" style="color: #2c3e50; font-size: 1.15rem; line-height: 1.6;">
            <p class="mb-4 text-center">
                <strong>Estimado Funcionario o Instructor</ ECONVENCION> del <span style="color: #1a3c6e; font-weight: 600;">Centro de Formación Agroindustrial La Angostura</span>,
            </p>
            <p>
                Nos complace darle la más cordial bienvenida a su plataforma de gestión integral. Desde este panel, usted podrá reportar y administrar de manera ágil y eficiente accidentes, incidentes, emergencias y actos inseguros, desempeñando un rol clave en la promoción de la seguridad y el bienestar de nuestra comunidad educativa. 
            </p>
            <p>
                Su compromiso con el registro oportuno y preciso de estos eventos es esencial para fortalecer un entorno de aprendizaje seguro, productivo y alineado con los más altos estándares de calidad. Le invitamos a utilizar las herramientas disponibles en esta plataforma para cumplir con sus responsabilidades y contribuir al desarrollo continuo de nuestro centro.
            </p>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary px-4 py-2" style="background-color: #1a3c6e; border: none; font-weight: 500; transition: background-color 0.3s;">
                    Comenzar Ahora
                </a>
            </div>
        </div>
    </div>
</div>
@endsection