@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="text-white">Todas las Respuestas a Eventos</h2>

    <!-- Filtro por fecha -->
    <form method="GET" class="mb-4">
        <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="form-control w-auto d-inline-block" />
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <div class="text-white">
        <h4>Accidentes</h4>
        @foreach ($accidentResponses as $accident)
            <h5>{{ $accident->titulo ?? 'Accidente #' . $accident->id }}</h5>
            @foreach ($accident->eventResponses as $response)
                <p><strong>{{ $response->createdBy->name ?? 'Sin usuario' }}:</strong> {{ $response->response }} ({{ $response->response_date }})</p>
            @endforeach
        @endforeach

        <hr>

        <h4>Incidentes</h4>
        @foreach ($incidentResponses as $incident)
            <h5>{{ $incident->titulo ?? 'Incidente #' . $incident->id }}</h5>
            @foreach ($incident->eventResponses as $response)
                <p><strong>{{ $response->createdBy->name ?? 'Sin usuario' }}:</strong> {{ $response->response }} ({{ $response->response_date }})</p>
            @endforeach
        @endforeach

        <hr>

        <h4>Emergencias</h4>
        @foreach ($emergencyResponses as $emergency)
            <h5>{{ $emergency->titulo ?? 'Emergencia #' . $emergency->id }}</h5>
            @foreach ($emergency->eventResponses as $response)
                <p><strong>{{ $response->createdBy->name ?? 'Sin usuario' }}:</strong> {{ $response->response }} ({{ $response->response_date }})</p>
            @endforeach
        @endforeach

        <hr>

        <h4>Actos Inseguros</h4>
        @foreach ($unsafeActResponses as $unsafeAct)
            <h5>{{ $unsafeAct->titulo ?? 'Acto Inseguro #' . $unsafeAct->id }}</h5>
            @foreach ($unsafeAct->eventResponses as $response)
                <p><strong>{{ $response->createdBy->name ?? 'Sin usuario' }}:</strong> {{ $response->response }} ({{ $response->response_date }})</p>
            @endforeach
        @endforeach
    </div>
</div>
@endsection
