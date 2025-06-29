@extends('sstsena::layouts.master')

@section('content')
    <h1>Lista de Todas las Respuestas</h1>

    <!-- Filtro por fecha -->
    <form method="GET" action="{{ route('sstsena.responses.all.index') }}">
        <div class="form-group">
            <label for="date_filter">Filtrar por fecha:</label>
            <input type="date" name="date_filter" id="date_filter" value="{{ request('date_filter') }}"
                   class="form-control">
        </div>
        <!-- Filtro por tipo de evento (opcional) -->
        <div class="form-group">
            <label for="event_type">Filtrar por tipo de evento:</label>
            <select name="event_type" id="event_type" class="form-control">
                <option value="">Todos</option>
                <option value="Modules\SSTSENA\Entities\Accident" {{ request('event_type') == 'Modules\SSTSENA\Entities\Accident' ? 'selected' : '' }}>Accidentes</option>
                <option value="Modules\SSTSENA\Entities\Incidents" {{ request('event_type') == 'Modules\SSTSENA\Entities\Incidents' ? 'selected' : '' }}>Incidentes</option>
                <option value="Modules\SSTSENA\Entities\Emergency" {{ request('event_type') == 'Modules\SSTSENA\Entities\Emergency' ? 'selected' : '' }}>Emergencias</option>
                <option value="Modules\SSTSENA\Entities\UnsafeAct" {{ request('event_type') == 'Modules\SSTSENA\Entities\UnsafeAct' ? 'selected' : '' }}>Actos Inseguros</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <!-- Tabla de respuestas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo de Evento</th>
                <th>Evento</th>
                <th>Respuesta</th>
                <th>Acciones Tomadas</th>
                <th>Estado</th>
                <th>Severidad</th>
                <th>Respondido por</th>
                <th>Fecha de Respuesta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($responses as $response)
                <tr>
                    <td>{{ class_basename($response->eventable_type) }}</td>
                    <td>
                        @if($response->eventable)
                            <a href="{{ route('sstsena.' . strtolower(class_basename($response->eventable_type)) . '.responses.index', $response->eventable_id) }}">
                                {{ $response->eventable->title ?? 'Evento #' . $response->eventable_id }}
                            </a>
                        @else
                            Evento no disponible
                        @endif
                    </td>
                    <td>{{ $response->response }}</td>
                    <td>{{ $response->actions_taken }}</td>
                    <td>{{ $response->status ?? 'N/A' }}</td>
                    <td>{{ $response->severity ?? 'N/A' }}</td>
                    <td>{{ $response->createdBy->name ?? 'Desconocido' }}</td>
                    <td>{{ $response->response_date->format('d/m/Y H:i') }}</td>
                    <td>
                        <!-- Enlaces para editar o eliminar -->
                        <a href="{{ route('sstsena.' . strtolower(class_basename($response->eventable_type)) . '.responses.edit', [$response->eventable_id, $response->id]) }}"
                           class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('sstsena.' . strtolower(class_basename($response->eventable_type)) . '.responses.destroy', [$response->eventable_id, $response->id]) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar esta respuesta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $responses->links() }}
@endsection