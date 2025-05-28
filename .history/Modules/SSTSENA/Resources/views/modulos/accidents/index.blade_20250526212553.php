@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h2 style="color: #1a3c6e; font-weight: 600;">Lista de Accidentes</h2>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover rounded shadow-sm" style="background-color: #ffffff;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="color: #34495e; font-weight: 600;">#</th>
                    <th style="color: #34495e; font-weight: 600;">Fecha y Hora</th>
                    <th style="color: #34495e; font-weight: 600;">Ubicación</th>
                    <th style="color: #34495e; font-weight: 600;">Tipo de Lesión</th>
                    <th style="color: #34495e; font-weight: 600;">Tipo de Riesgo</th>
                    <th style="color: #34495e; font-weight: 600;">Tipo de Accidente</th>
                    <th style="color: #34495e; font-weight: 600;">Descripción</th>
                    <th style="color: #34495e; font-weight: 600;">Gravedad</th>
                    <th style="color: #34495e; font-weight: 600;">Evidencia</th>
                    <th style="color: #34495e; font-weight: 600;">Creado por</th>
                    <th style="color: #34495e; font-weight: 600;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidents as $accident)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $accident->date_time }}</td>
                    <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->description }}</td>
                    <td>
                        <span class="badge 
                            @if($accident->severity == 'minor') bg-success text-white
                            @elseif($accident->severity == 'moderate') bg-warning text-dark
                            @elseif($accident->severity == 'serious') bg-danger text-white
                            @elseif($accident->severity == 'fatal') bg-dark text-white
                            @endif" 
                            style="padding: 0.5em 1em; border-radius: 0.25rem;">
                            {{ ucfirst($accident->severity) }}
                        </span>
                    </td>
                    <td>
                        @if ($accident->evidence)
                            <a href="{{ asset('storage/' . $accident->evidence) }}" 
                               class="btn btn-sm btn-primary" 
                               style="background-color: #1a3c6e; border-color: #1a3c6e;" 
                               target="_blank">
                                Ver archivo
                            </a>
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td>{{ $accident->created_by ?? 'Desconocido' }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.accidents.edit', $accident->id) }}" 
                           class="btn btn-sm btn-outline-warning px-3" 
                           style="border-color: #ffc107; color: #34495e;">Editar</a>
                        <form action="{{ route('sstsena.admin.accidents.destroy', $accident->id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-outline-danger px-3" 
                                    style="border-color: #dc3545; color: #34495e;" 
                                    onclick="return confirm('¿Estás seguro de eliminar este accidente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted" style="padding: 1.5rem;">
                        No hay accidentes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection