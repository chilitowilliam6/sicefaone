@extends ('sstsena::layouts.master')
@section('content')
<h1>Editar Tipo de Accidente</h1>
<a href="{{route('sstsena.admin.accident_types.index')}}">Cancelar</a>
<form action = "{{route('sstsena.admin.accident_types.update', $AccidentType->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ $AccidentType->name }}" required>
    </div>
    <div>
        <label for="description">Descripción</label>
        <textarea name="description" id="description" required>{{ $AccidentType->description }}</textarea>
    </div>
    <button type="submit">Actualizar</button>
