@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">

    @if (session('success'))
        <div id="alertaExito"
             class="bg-white border border-success text-center p-3 rounded shadow mx-auto mb-4"
             style="max-width: 400px;">
            <div class="text-success fs-1">✔️</div>
            <h5 class="mt-2 text-success">¡Éxito!</h5>
            <p class="mb-0 text-muted">{{ session('success') }}</p>
        </div>

        <script>
            setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);
        </script>
    @endif

    @php
        $sections = [
            ['title' => 'Accidentes', 'items' => $accidents, 'route_prefix' => 'accidents'],
            ['title' => 'Incidentes', 'items' => $incidents, 'route_prefix' => 'incidents'],
            ['title' => 'Emergencias', 'items' => $emergencies, 'route_prefix' => 'emergencies'],
            ['title' => 'Actos Inseguros', 'items' => $unsafeActs, 'route_prefix' => 'unsafe_acts'],
        ];
    @endphp

    @foreach ($sections as $section)
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover" style="background-color: #ffffff; border: 1px solid #dee2e6;">
                <thead>
                    {{-- Título de la sección --}}
                    <tr style="background-color: #e9ecef;">
                        <th colspan="6" class="text-center" style="font-size: 24px; color: #1a3c6e; font-weight: bold;">
                            {{ $section['title'] }}
                        </th>
                    </tr>

                    {{-- Encabezados --}}
                    <tr style="background-color: #f8f9fa; color: #34495e;">
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
                                @switch($item->severity)
                                    @case('minor') <span class="badge bg-success">Leve</span> @break
                                    @case('moderate') <span class="badge bg-warning text-dark">Moderada</span> @break
                                    @case('serious') <span class="badge bg-danger">Grave</span> @break
                                    @case('fatal') <span class="badge bg-dark">Fatal</span> @break
                                    @default <span class="badge bg-secondary">Desconocida</span>
                                @endswitch
                            </td>
                            <td>{{ $item->eventResponses->count() }}</td>
                            <td>
                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                   class="btn btn-sm"
                                   style="background-color: #1a3c6e; color: #ffffff;">
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
    @endforeach

</div>
@endsection
