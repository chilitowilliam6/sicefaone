@extends ('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Accidente</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.accidents.update', $Accident->id) }}" method="POST">
                @csrf
                @method('PUT')
                //fecha_hora
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                    <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control border-light-subtle" value="{{ $Accident->fecha_hora }}" required>
                </div>
                  <div class="mb-4">
                    <label for="fecha_hora" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                    <input type="datetime-local" name="environment" id="" class="form-control border-light-subtle" value="{{ $Accident->fecha_hora }}" required>
                </div>
                



@endsection