@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Lista de Eventos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Accidentes -->
    <h2>Accidentes</h2>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Descripción</th>
                <th>Severidad</th>
                <th>Respuestas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accidents as $accident)
                <tr>
                    <td>{{ $accident->id }}</td>
                    <td>{{ $accident->date_time->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $accident->description ?? 'Sin descripción' }}</td>
                    <td>{{ ucfirst($accident->severity) }}</td>
                    <td>{{ $accident->eventResponses->count() }}</td>
                    <td>
                        <a href="{{ route('sstsena.accidents.responses.index', $accident->id) }}" class="btn btn-sm btn-primary">Ver Respuestas</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron accidentes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Incidentes -->
    <h2>Incidentes</h2>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Descripción</th>
                <th>Severidad</th>
                <th>Respuestas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incidents as $incident)
                <tr>
                    <td>{{ $incident->id }}</td>
                    <td>{{ $incident->date_time->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $incident->description ?? 'Sin descripción' }}</td>
                    <td>{{ ucfirst($incident->severity) }}</td>
                    <td>{{ $incident->eventResponses->count() }}</td>
                    <td>
                        <a href="{{ route('sstsena.incidents.responses.index', $incident->id) }}" class="btn btn-sm btn-primary">Ver Respuestas</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron incidentes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Emergencias -->
    <h2>Emergencias</h2>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Descripción</th>
                <th>Severidad</th>
                <th>Respuestas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emergencies as $emergency)
                <tr>
                    <td>{{ $emergency->id }}</td>
                    <td>{{ $emergency->date_time->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $emergency->description ?? 'Sin descripción' }}</td>
                    <td>{{ ucfirst($emergency->severity) }}</td>
                    <td>{{ $emergency->eventResponses->count() }}</td>
                    <td>
                        <a href="{{ route('sstsena.emergencies.responses.index', $emergency->id) }}" class="btn btn-sm btn-primary">Ver Respuestas</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron emergencias.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Actos Inseguros -->
    <h2>Actos Inseguros</h2>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Descripción</th>
                <th>Severidad</th>
                <th>Respuestas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unsafeActs as $unsafeAct)
                <tr>
                    <td>{{ $unsafeAct->id }}</td>
                    <td>{{ $unsafeAct->date_time->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $unsafeAct->description ?? 'Sin descripción' }}</td>
                    <td>{{ ucfirst($unsafeAct->severity) }}</td>
                    <td>{{ $unsafeAct->eventResponses->count() }}</td>
                    <td>
                        <a href="{{ route('sstsena.unsafe_acts.responses.index', $unsafeAct->id) }}" class="btn btn-sm btn-primary">Ver Respuestas</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron actos inseguros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection