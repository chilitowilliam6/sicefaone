@extends('sstsena.lacyouts.master')
@section('content')
                    Route::get('/', [PeopleInvolvedController::class,"index"])->name('sstsena.funcionario.people_involved.index');