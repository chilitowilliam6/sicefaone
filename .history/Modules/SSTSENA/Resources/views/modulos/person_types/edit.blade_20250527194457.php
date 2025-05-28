@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Tipo de Persona</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.TypePerson.update', $typePerson->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control border-light-subtle" value="{{ $tipePerson->name }}" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea name="description" id="description" class="form-control border-light-subtle" rows="4">{{ tipePerson->description }}</textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.admin.TypePerson.index') }}" 
                       class="btn btn-outline-secondary px-4" 
                       style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>