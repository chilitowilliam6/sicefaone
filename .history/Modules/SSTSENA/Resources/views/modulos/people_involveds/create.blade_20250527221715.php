@extends('sstsena.lacyouts.master')
@section('content')
  $table->enum('document_type', ['CC', 'TI', 'CE', 'PAS','OTRO']);
            $table->string('document_number');
            $table->date('birth_date');
            $table->string('gender');
            $table->foreignId('person_type_id')->constrained('person_types')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('accident_id')->constrained('accidents')->onDelete('cascade');
    <div class="container mt-5">

