 //  $table->enum('document_type', ['CC', 'TI', 'CE', 'PAS','OTRO']);
 //            $table->string('document_number');
 //            $table->string('name');
 //            $table->string('last_name');
 //            $table->date('birth_date');
 //            $table->string('gender');
 //            $table->foreignId('person_type_id')->constrained('person_types')->onDelete('cascade');
 //            $table->string('phone')->nullable();
 //            $table->string('address')->nullable();
 //            $table->foreignId('accident_id')->constrained('accidents')->onDelete('cascade');


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
                            <th scope="col">#</th>
                            <th scope="col">Tipo de Documento</th>
                            <th scope="col">Número de Documento</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Género</th>
                            <th scope="col">Tipo de Persona</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Acciones</th>
                            