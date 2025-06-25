@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-white text-center mb-4">Panel de Reportes SST</h1>

    {{-- Sección: Accidentes --}}
    <div class="card mb-5 border-primary">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Accidentes Reportados</h4>
        </div>
        <div class="card-body bg-dark text-white">
            @if($accidentes->isEmpty())
                <p>No hay accidentes registrados.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead class="table-primary text-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Gravedad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accidentes as $accidente)
                                <tr>
                                    <td>{{ $accidente->evento->nombre }}</td>
                                    <td>{{ $accidente->tipoAccidente->nombre }}</td>
                                    <td>{{ $accidente->evento->fecha }}</td>
                                    <td>{{ ucfirst($accidente->evento->gravedad) }}</td>
                                    <td>
                                        <a href="{{ route('accidentes.show', $accidente->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
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

    {{-- Sección: Incidentes --}}
    <div class="card mb-5 border-secondary">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Incidentes Reportados</h4>
        </div>
        <div class="card-body bg-dark text-white">
            @if($incidentes->isEmpty())
                <p>No hay incidentes registrados.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead class="table-secondary text-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Gravedad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidentes as $incidente)
                                <tr>
                                    <td>{{ $incidente->evento->nombre }}</td>
                                    <td>{{ $incidente->tipoIncidente->nombre }}</td>
                                    <td>{{ $incidente->evento->fecha }}</td>
                                    <td>{{ ucfirst($incidente->evento->gravedad) }}</td>
                                    <td>
                                        <a href="{{ route('incidentes.show', $incidente->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
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

    {{-- Sección: Emergencias --}}
    <div class="card mb-5 border-danger">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Emergencias Reportadas</h4>
        </div>
        <div class="card-body bg-dark text-white">
            @if($emergencias->isEmpty())
                <p>No hay emergencias registradas.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead class="table-danger text-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Gravedad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emergencias as $emergencia)
                                <tr>
                                    <td>{{ $emergencia->evento->nombre }}</td>
                                    <td>{{ $emergencia->tipoEmergencia->nombre }}</td>
                                    <td>{{ $emergencia->evento->fecha }}</td>
                                    <td>{{ ucfirst($emergencia->evento->gravedad) }}</td>
                                    <td>
                                        <a href="{{ route('emergencias.show', $emergencia->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                        <a href="{{ route('emergencias.edit', $emergencia->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Sección: Actos Inseguros --}}
    <div class="card mb-5 border-warning">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Actos Inseguros Reportados</h4>
        </div>
        <div class="card-body bg-dark text-white">
            @if($actosInseguros->isEmpty())
                <p>No hay actos inseguros registrados.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead class="table-warning text-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Gravedad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actosInseguros as $acto)
                                <tr>
                                    <td>{{ $acto->evento->nombre }}</td>
                                    <td>{{ Str::limit($acto->descripcion, 30) }}</td>
                                    <td>{{ $acto->evento->fecha }}</td>
                                    <td>{{ ucfirst($acto->evento->gravedad) }}</td>
                                    <td>
                                        <a href="{{ route('actos-inseguros.show', $acto->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                        <a href="{{ route('actos-inseguros.edit', $acto->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
