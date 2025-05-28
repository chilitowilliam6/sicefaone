@extends('sstsena::layouts.master')
@section('content')
<table class="table table-dark table-bordered table-hover rounded shadow">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Fecha y Hora</th>
            <th>Ambiente</th>
            <th>Tipo de Lesión</th>
            <th>Tipo de Riesgo</th>
            <th>Tipo de Accidente</th>
            <th>Descripción</th>
            <th>Gravedad</th>
            <th>Evidencia</th>
            <th>Creado por</th>
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
                        @if($accident->severity == 'minor') bg-success
                        @elseif($accident->severity == 'moderate') bg-warning
                        @elseif($accident->severity == 'serious') bg-danger
                        @elseif($accident->severity == 'fatal') bg-dark
                        @endif">
                        {{ ucfirst($accident->severity) }}
                    </span>
                </td>
                <td>
                    @if ($accident->evidence)
                        <a href="{{ asset('storage/' . $accident->evidence) }}" class="btn btn-sm btn-info" target="_blank">
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
                <td colspan="10" class="text-center text-muted">No hay accidentes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
