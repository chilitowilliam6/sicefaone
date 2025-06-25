@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Agregar Respuesta a Incidente #{{ $event->id }}</h1>

    <form action="{{ route('sstsena.incidents.responses.store', $event->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="response" class="form-label">Respuesta</label>
            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="5">{{ old('response') }}</textarea>
            @error('response')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ route('sstsena.incidents.responses.index', $event->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection