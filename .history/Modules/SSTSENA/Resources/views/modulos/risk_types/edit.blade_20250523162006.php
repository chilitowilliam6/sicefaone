@extends('sstsena::layouts.master')
@section('content')
<h1>Editar Tipo de Riesgo</h1>
<a href="{{ route('sstsena.admin.risk_types.index') }}">Cancelar</a>
<form action="{{ route('sstsena.admin.risk_types.update', $riskType->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ $riskType->name }}" required>
    </div>
    <div>
        <label for="description">Descripción</label>
        <textarea name="description" id="description" required>{{ $riskType->description }}</textarea>
    </div>
    <button type="submit">Actualizar</button>