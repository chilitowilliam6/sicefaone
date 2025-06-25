@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-white">Panel de Seguridad y Salud en el Trabajo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active text-white">Eventos registrados</li>
    </ol>

    {{-- Estadísticas globales --}}
    <div class="row mb-4">
        @foreach([
            ['title' => 'Total Accidentes', 'count' => $totalAccidentes, 'color' => 'primary'],
            ['title' => 'Total Incidentes', 'count' => $totalIncidentes, 'color' => 'warning'],
            ['title' => 'Total Emergencias', 'count' => $totalEmergencias, 'color' => 'danger'],
            ['title' => 'Total Actos Inseguros', 'count' => $totalActosInseguros, 'color' => 'info'],
        ] as $stat)
            <div class="col-xl-3 col-md-6">
                <div class="card bg-{{ $stat['color'] }} text-white mb-4">
                    <div class="card-body fs-5 fw-bold">{{ $stat['title'] }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="fs-4">{{ $stat['count'] }}</span>
                        <i class="fas fa-chart-bar fs-4 text-white"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Tabla de Accidentes --}}
    <div class="card bg-dark text-white mb-4">
        <div class="card-header border-bottom border-primary d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-user-injured me-2 text-primary"></i>Accidentes Registrados</h5>
        </div>
        <div class="card-body">
            @if($accidentes->isEmpty())
                <div class="alert alert-info">No hay accidentes registrados.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-bordered">
                        <thead class="table-primary text-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Lugar</th>
                                <th>Descripción</th>
                                <th>Personas Involucradas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accidentes as $accidente)
                                <tr>
                                    <td>{{ $accidente->id }}</td>
                                    <td>{{ $accidente->evento->fecha }}</td>
                                    <td>{{ $accidente->evento->lugar }}</td>
                                    <td>{{ $accidente->evento->descripcion }}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($accidente->evento->personasInvolucradas as $persona)
                                                <li>{{ $persona->nombre }} ({{ $persona->rol }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('accidentes.show', $accidente->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('accidentes.edit', $accidente->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Tabla de Incidentes --}}
    <div class="card bg-dark text-white mb-4">
        <div class="card-header border-bottom border-warning d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Incidentes Registrados</h5>
        </div>
        <div class="card-body">
            @if($incidentes->isEmpty())
                <div class="alert alert-info">No hay incidentes registrados.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-bordered">
                        <thead class="table-warning text-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Lugar</th>
                                <th>Descripción</th>
                                <th>Personas Involucradas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidentes as $incidente)
                                <tr>
                                    <td>{{ $incidente->id }}</td>
                                    <td>{{ $incidente->evento->fecha }}</td>
                                    <td>{{ $incidente->evento->lugar }}</td>
                                    <td>{{ $incidente->evento->descripcion }}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($incidente->evento->personasInvolucradas as $persona)
                                                <li>{{ $persona->nombre }} ({{ $persona->rol }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('incidentes.show', $incidente->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('incidentes.edit', $incidente->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Tablas de Emergencias y Actos Inseguros pueden ir abajo siguiendo misma estructura --}}
</div>
@endsection