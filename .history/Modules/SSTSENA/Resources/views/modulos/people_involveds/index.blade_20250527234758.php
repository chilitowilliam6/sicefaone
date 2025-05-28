@extends('sstsena.lacyouts.master')
@section('content')
   //                 Route::get('/', [PeopleInvolvedController::class,"index"])->name('sstsena.funcionario.people_involved.index');

   <div class="container mt-5">
        <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Personas Involucradas</h3>
            </div>
            <div class="card-body p-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tipo de Documento</th>
                            <th>Número de Documento</th>
                            <th>nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Género</th>
                            <th>Tipo de Persona</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peopleInvolveds as $peopleInvolved)
                            <tr>
                                <td>{{ $peopleInvolved->document_type }}</td>
                                <td>{{ $peopleInvolved->document_number }}</td>
                                <td>{{ $peopleInvolved->name }}</td>
                                <td>{{ $peopleInvolved->last_name }}</td>
                                <td>{{ $peopleInvolved->birth_date }}</td>
                                <td>{{ $peopleInvolved->birth_date }}</td>
                   