@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <h1 class="mb-4" style="color: #1a3c6e; font-weight: 600;">Tipos de personas</h1>
    <a href="{{ route('sstsena.admin.TypePerson.create') }}" 
       class="btn btn-primary mb-4" 
       style="background-color: #1a3c6e; border-color: #1a3c6e;">Crear Tipo de Persona</a>
       






@endsection