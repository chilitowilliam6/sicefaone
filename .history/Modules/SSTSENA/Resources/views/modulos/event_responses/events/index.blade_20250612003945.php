@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5 text-white">
    <h1 class="mb-4 fw-bold text-center text-uppercase text-primary">Lista de Eventos SST</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $sections = [
            ['title' => 'Accidentes', 'items' => $accidents, 'route' => 'sstsena.accidents.responses.index'],
            ['title' => 'Incidentes', 'items' => $incidents, 'route' => 'sstsena.incidents.responses.index'],
            ['title' => 'Emergencias', 'items' => $emergencies, 'route' => 'sstsena.emergencies.responses.index'],
            ['title' => 'Actos Inseguros', 'items' => $unsafeActs, 'route' => 'sstsena.unsafe_acts.responses.index'],
        ];
    @endphp

    @foreach ($sections as $section)
        <div class="card bg-dark border-primary shadow mb-5">
            <div class="card-header bg-primary text-white fw-semibold fs-4">
                {{ $section['title'] }}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0">
                        <thead class="text-primary text-uppercase small">
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
                            @forelse ($section['items'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->date_time->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $item->description ?? 'Sin descripción' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($item->severity === 'alta') bg-danger 
                                            @elseif($item->severity === 'media') bg-warning text-dark 
                                            @else bg-success 
                                            @endif">
                                            {{ ucfirst($item->severity) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $item->eventResponses->count() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route($section['route'], $item->id) }}" class="btn btn-outline-primary btn-sm">
                                            Ver Respuestas
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No se encontraron {{ strtolower($section['title']) }}.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
