@extends('sstsena::layouts.master')
@section('content')
<h3>Lista de Accidentes</h2>
<div class="container mt-5">
    <table class="table table-bordered table-hover rounded shadow-sm" style="background-color: #ffffff;">
        <thead style="background-color: #f8f9fa;">
            <tr>
                <th style="color: #34495e; font-weight: 600;">#</th>
                <th style="color: #34495e; font-weight: 600;">Fecha y Hora</th>
                <th style="color: #34495e; font-weight: 600;">Ubicacion</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Lesión</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Riesgo</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Accidente</th>
                <th style="color: #34495e; font-weight: 600;">Descripción</th>
                <th style="color: #34495e; font-weight: 600;">Gravedad</th>
                <th style="color: #34495e; font-weight: 600;">Evidencia</th>
                <th style="color: #34495e; font-weight: 600;">Creado por</th>
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
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted" style="padding: 1.5rem;">
                        No hay accidentes registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection