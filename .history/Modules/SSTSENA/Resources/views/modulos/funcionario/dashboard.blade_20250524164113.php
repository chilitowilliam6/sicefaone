@extends('sstsena::layouts.master')
@section('content')
<h1>Funcionario</h1>
<div class="container mt-4">
    <h1 class="text-white mb-4">Dashboard Funcionario</h1>

    <div class="bg-dark text-white p-4 rounded shadow">
        <p>Bienvenido al dashboard del funcionario. Aquí puedes gestionar tus tareas y responsabilidades.</p>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ route('sstsena.admin.dashboard') }}" class="btn btn-outline-light">Volver al Dashboard</a>
    </div>