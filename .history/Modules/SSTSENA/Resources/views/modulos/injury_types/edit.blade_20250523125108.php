@extends('sstsena::layouts.master')
@section('content')
<h1>Editar Tipo de Lesion</h1>
<a href="{{route('sstsena.admin.injury_types.index')}}">Cancelar</a>
<form action = "{{route('sstsena.admin.injury_types.update', $injurytype->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ $injurytype->name }}" required>
    </div>
    <div>
        <label for="description">Descripción</label>
        <textarea name="description" id="description" required>{{ injuryType->description }}</textarea>
    </div>
    <button type="submit">Actualizar</button>
@endsection