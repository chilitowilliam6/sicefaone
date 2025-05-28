@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-4">
    <h1 class="text-white mb-4">Crear Accidente</h1>

    <form action="{{ route('sstsena.funcionario.accidents.store') }}" method="POST" class="bg-dark text-white p-4 rounded shadow">
        @csrf
    
            @endsection