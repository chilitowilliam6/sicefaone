@extends('sstsena::layouts.master')
@section('content')
<h1>crear tipo de lesion</h1>
<a href="{{route('sstsena.admin.injury_types.index')}}">Cancelar</a>
<form action="{{route('sstsena.admin.injury_types.store')}}" method="POST">
    @csrf
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Descripción</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <button type="submit">Crear</button>
@endsection
