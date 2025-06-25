@extends('sstsena::layouts.master')

@section('content')
<h2>Respuestas para Accidente #{{ $event->id }}</h2>

<div class="text-center mb-4 d-flex justify-content-center gap-3">
    <a href="{{ route('sstsena.accidents.responses.create', $event->id) }}"
       class="btn btn-primary">
        Agregar Respuesta
    </a>
</div>

<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-bordered table-hover rounded shadow-sm" style="background-color: #ffffff;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="color: #34495e; font-weight: 600;">ID</th>
                    <th style="color: #34495e; font-weight: 600;">Respuesta</th>
                    <th style="color: #34495e; font-weight: 600;">Acciones Tomadas</th>
                    <th style="color: #34495e; font-weight: 600;">Gravedad</th>
                    <th style="color: #34495e; font-weight: 600;">Estado</th>
                    <th style="color: #34495e; font-weight: 600;">Fecha de Respuesta</th>
                    <th style="color: #34495e; font-weight: 600;">Creado Por</th>
                    <th style="color: #34495e; font-weight: 600;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($responses as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>{{ Str::limit($response->response, 50) }}</td>
                    <td>{{ Str::limit($response->actions_taken, 50) }}</td>
                    <td>
                        <span class="badge 
                            @if($response->severity == 'minor') bg-success text-white
                            @elseif($response->severity == 'moderate') bg-warning text-dark
                            @elseif($response->severity == 'serious') bg-danger text-white
                            @elseif($response->severity == 'fatal') bg-dark text-white
                            @else bg-secondary text-white
                            @endif"
                            style="padding: 0.5em 1em; border-radius: 0.25rem;">
                            @switch($response->severity)
                                @case('minor') Leve @break
                                @case('moderate') Moderada @break
                                @case('serious') Grave @break
                                @case('fatal') Fatal @break
                                @default No definido
                            @endswitch
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($response->status === 'investigation') bg-primary text-white
                            @else bg-success text-white
                            @endif"
                            style="padding: 0.5em 1em; border-radius: 0.25rem;">
                            {{ $response->status === 'investigation' ? 'Investigación' : 'Finalizado' }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($response->response_date)->format('Y-m-d H:i') }}</td>
                    <td>{{ $response->createdBy->name ?? 'Desconocido' }}</td>
                    <td>
                        <a href="{{ route('sstsena.accidents.responses.edit', [$event->id, $response->id]) }}"
                           class="btn btn-sm btn-outline-success"
                           style="border-color: #28a745; color: #28a745;">Editar</a>
                        <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}"
                              method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted" style="padding: 1.5rem;">
                        No se encontraron respuestas.
                    </td>
                </tr>
                @endforelse

                @if(session('success'))
                <tr>
                    <td colspan="8">
                        <div id="alertaExito"
                             class="alert alert-success text-center p-3 rounded shadow mx-auto"
                             style="max-width: 400px;">
                            <div class="fs-1">✔️</div>
                            <h5 class="mt-2">¡Éxito!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>

                        <script>
                            setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);
                        </script>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection