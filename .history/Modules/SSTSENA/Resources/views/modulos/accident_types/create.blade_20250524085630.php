@extends('sstsena::layouts.master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="card bg-dark text-white shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Crear Tipo de Accidente</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sstsena.admin.accident_types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="btn btn-outline-light">Cancelar</a>
