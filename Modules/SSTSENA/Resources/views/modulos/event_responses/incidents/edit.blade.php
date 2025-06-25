@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Editar Respuesta para Incidente #{{ $event->id }}</h1>

    <form action="{{ route('sstsena.incidents.responses.update', [$event->id, $response->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="response" class="form-label">Respuesta</label>
            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="5">{{ old('response', $response->response) }}</textarea>
            @error('response')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('sstsena.incidents.responses.index', $event->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection